<?php

namespace App\Services;

use App\Models\Device;
use App\Models\Customer;
use App\Mail\DeviceAlertMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DeviceAlertNotification;
use Twilio\Rest\Client as TwilioClient;

class DeviceService
{
    protected $twilioClient;

    public function __construct(TwilioClient $twilioClient)
    {
        $this->twilioClient = $twilioClient;
    }

    public function processDeviceData($imei, $parsedData)
    {
        // Find device based on IMEI
        $device = Device::where('imei', $imei)->first();

        if (!$device) {
            // Device not found, log or handle as needed
            return;
        }

        // Find the customer associated with the device
        $customer = Customer::find($device->customer_id);

        if ($customer) {
            // Send SMS
            $this->sendSms($customer->phone_number, "Alert! Data received from your device: $imei");

            // Send Email
            Mail::to($customer->email)->send(new DeviceAlertMail($device, $parsedData));

            // Store data in database for future reports
            $this->storeDeviceData($device, $parsedData);
        }
    }

    protected function sendSms($phoneNumber, $message)
    {
        // Use Twilio to send SMS (replace with actual Twilio setup)
        $this->twilioClient->messages->create($phoneNumber, [
            'from' => 'YOUR_TWILIO_PHONE_NUMBER',
            'body' => $message,
        ]);
    }

    protected function storeDeviceData($device, $parsedData)
    {
        // Save the parsed data for future reports
        $deviceData = new DeviceData(); // Assuming you have a DeviceData model
        $deviceData->device_id = $device->id;
        $deviceData->data = json_encode($parsedData);
        $deviceData->save();
    }
}
