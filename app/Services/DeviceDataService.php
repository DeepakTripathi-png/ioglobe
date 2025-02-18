<?php

namespace App\Services;

use App\Models\Alarm;
use App\Models\IOSlave;
use App\Models\DeviceMaster;
use App\Models\SlaveDeviceMaster;
use Illuminate\Support\Facades\Http;
use App\Models\ControllerDevicePort;


class DeviceDataService
{
        public function handleDeviceData($rawData)
        {
            if ($rawData && str_starts_with($rawData, '*')) {
                $data = $this->parsePayload($rawData);
    
                if ($data) {
                    $pocessedResult=$this->processIncomingData($data);
                    return ['status' => 'success', 'data' => $pocessedResult];
                }
            }
    
            return ['status' => 'error', 'message' => 'Invalid data'];
        }

        private function parsePayload($payload)
        {
            $dataParts = explode(',', $payload);
            $parsedData = [
                'start_of_frame' => $dataParts[0] ?? null,
                'imei' => $dataParts[1] ?? null,
                'firmware_version' => $dataParts[2] ?? null,
                'rtc_time' => $dataParts[3] ?? null,
                'gps_time' => $dataParts[4] ?? null,
                'gnss_status' => $dataParts[5] ?? null,
                'latitude' => $dataParts[6] ?? null,
                'latitude_cardinal' => $dataParts[7] ?? null,
                'longitude' => $dataParts[8] ?? null,
                'longitude_cardinal' => $dataParts[9] ?? null,
                'gnss_speed' => $dataParts[10] ?? null,
                'gnss_course' => $dataParts[11] ?? null,
                'reserved' => $dataParts[12] ?? null,
                'rssi' => $dataParts[13] ?? null,
                'bit_error_rate' => $dataParts[14] ?? null,
                'adc0_val' => $dataParts[15] ?? null,
                'digital_input' => [
                    'di1_val' => $dataParts[17] ?? null,
                    'di2_val' => $dataParts[18] ?? null,
                ],
                'analog_input' => [
                    'adc1_val' => $dataParts[20] ?? null,
                    'adc2_val' => $dataParts[21] ?? null,
                ],
                'modbus_data' => $this->extractModbusData($dataParts),
                'ble_data' => $this->extractBLEData($dataParts),
                'counter' => $dataParts[array_key_last($dataParts) - 1] ?? null,
                'end_of_frame' => $dataParts[array_key_last($dataParts)] ?? null,
            ];
    
            return $parsedData;
        }

        private function extractModbusData($dataParts)
        {
            $modbusStartIndex = array_search('MS', $dataParts);
            $separatorIndex = array_search('|', $dataParts, $modbusStartIndex + 1);
    
            if ($modbusStartIndex === false || $separatorIndex === false) {
                return [];
            }
    
            $modbusData = array_slice($dataParts, $modbusStartIndex + 2, $separatorIndex - $modbusStartIndex - 2);
            $parsedModbus = [];
    
            $parsedModbus['slave_id'] = array_shift($modbusData);
    
            foreach ($modbusData as $index => $value) {
                $registerAddress = sprintf("0x%04X", $index);
                $parsedModbus[$registerAddress] = $value;
            }
    
            return $parsedModbus;
        }

        private function extractBLEData($dataParts)
        {
            $bleStartIndex = array_search('L', $dataParts);
            $endOfBleIndex = array_search('E', $dataParts);
    
            if ($bleStartIndex === false || $endOfBleIndex === false) {
                return [];
            }
    
            $bleData = array_slice($dataParts, $bleStartIndex + 1, $endOfBleIndex - $bleStartIndex - 1);
            return $bleData;
        }

     
                
                
            private function processIncomingData($parsedData)
            {
                $masterDeviceIMEI = $parsedData['imei'] ?? null;
            
                if (!empty($masterDeviceIMEI)) {
                    $masterDevice = DeviceMaster::where('device_id', $masterDeviceIMEI)->first();
            
                    if ($masterDevice) {
                        $listOfAllPorts = ControllerDevicePort::where('controller_device_id', $masterDevice->controller_type_id)
                                                              ->where('status', 'active')
                                                              ->pluck('port')
                                                              ->toArray();
            
                        $ioSlaveList = IOSlave::where('status', 'active')->where('master_device_id', $masterDevice->id)->get();
            
                        if ($ioSlaveList) {
                            foreach ($ioSlaveList as $ioSlave) {
                                if (strpos($ioSlave->io_slave_name, 'di') === 0) {
                                    $diKey = $ioSlave->io_slave_name . '_val';
                                    if (($parsedData['digital_input'][$diKey] ?? 0) == 1) {
                                        $this->updateSlaveDeviceStatus($parsedData,$ioSlave, 'alarm');
                                    } else {
                                        $this->updateSlaveDeviceStatus($parsedData,$ioSlave, 'normal');
                                    }
                                }
        
                                if (strpos($ioSlave->io_slave_name, 'ai') === 0) {
                                    $aiKey = str_replace('ai', 'adc', $ioSlave->io_slave_name) . '_val';
                                    if (!empty($parsedData['analog_input'][$aiKey])) {
                                        $this->updateSlaveDeviceStatus($parsedData,$ioSlave, $parsedData['analog_input'][$aiKey]);
                                    }
                                }
            
                                if (strpos($ioSlave->io_slave_name, 'slave') === 0) {
                                    if (($parsedData['modbus_data']['0x0009'] ?? '') === "0xFFFF") {
                                        $this->updateSlaveDeviceStatus($parsedData,$ioSlave, 'alarm');
                                    } else {
                                        $this->updateSlaveDeviceStatus($parsedData,$ioSlave, 'normal');
                                    }
                                }
                            }
                        }
                    }
            
                    return $masterDevice;
                }
            
                return null;
            }
                
           
            
            // private function updateSlaveDeviceStatus($parsedData, $ioSlave, $status)
            // {
            //     if (!empty($ioSlave->slave_device_id)) {
            //         IOSlave::where('slave_device_id', $ioSlave->slave_device_id)
            //             ->update(['io_device_status' => $status]);
                        
            //         $slaveDeviceDetails = SlaveDeviceMaster::find($ioSlave->slave_device_id);
            
            //         if ($status == "alarm"){
                        
            //             $lastAlarmTime = Alarm::where('ioslave_id', $ioSlave->id)
            //                                   ->latest('created_at')  
            //                                   ->value('created_at');
            
            //             $timeThreshold = now()->subSeconds(30);
            
            //             if (!$lastAlarmTime || $lastAlarmTime < $timeThreshold) {
            //                 $message = $this->generateAlarmMessage($parsedData, $slaveDeviceDetails);
            //                 $input = [
            //                     'ioslave_id' => $ioSlave->id,
            //                     'message'    => $message,
            //                 ];
            //                 Alarm::create($input);  
            //             }
            //         }
            //     }
            // }



                private function updateSlaveDeviceStatus($parsedData, $ioSlave, $status)
                {
                    if (!empty($ioSlave->slave_device_id)) {
                        IOSlave::where('slave_device_id', $ioSlave->slave_device_id)
                            ->update(['io_device_status' => $status]);
                
                        $slaveDeviceDetails = SlaveDeviceMaster::find($ioSlave->slave_device_id);
                
                        if ($status == "alarm") {
                            $alarmData = [
                                'ioslave_id' => $ioSlave->id,
                                'message'    => $this->generateAlarmMessage($parsedData, $slaveDeviceDetails),
                            ];
                
                            $existingAlarm = Alarm::where('ioslave_id', $ioSlave->id)
                                ->where('alarm_status', 'active')
                                ->first();
                
                            if ($existingAlarm) {
                                if (now()->diffInSeconds($existingAlarm->last_triggered_at) >= 10) {
                                    $existingAlarm->update([
                                        'last_triggered_at' => now(),
                                        'occurrences' => $existingAlarm->occurrences + 1,
                                        'updated_at' => now(),
                                    ]);
                                }
                            } else {
                                Alarm::create([
                                    'ioslave_id' => $ioSlave->id,
                                    'message' => $alarmData['message'],
                                    'last_triggered_at' => now(),
                                    'alarm_status' => 'active',
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]);
                            }
                        } 
                    }
                }



                
              
                private function generateAlarmMessage($parsedData, $slaveDeviceDetails)
                {
                    $locationMessage = '';
                    if (!empty($parsedData['latitude']) && !empty($parsedData['longitude'])) {
                        $address = $this->reverseGeocode($parsedData['latitude'], $parsedData['longitude']);
                        $locationMessage = !empty($address) ? " Location: $address" : '';
                    }
                    return ucwords(strtolower(($slaveDeviceDetails->slave_device_name ?? "Unknown device") . " has detected an alarm!" . $locationMessage));
                }



        
    
                function reverseGeocode($latitude, $longitude)
                {
                    if (is_null($latitude) || is_null($longitude)) {
                        return null; 
                    }
                
                    $geocodingUrl = "http://address.markongps.in/nominatim/reverse?format=json&lat={$latitude}&lon={$longitude}";
                
                    try {
                        $response = Http::get($geocodingUrl);
                        $responseData = json_decode($response->body(), true);
                        $displayName = $responseData['display_name'] ?? null; 
                        return $displayName;
                    } catch (\Exception $e) {
                        \Log::error('Error in reverse geocoding:', ['exception' => $e]);
                        return null;
                    }
                }
}
