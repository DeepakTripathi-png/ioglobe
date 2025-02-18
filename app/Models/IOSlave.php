<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IOSlave extends Model
{
    use HasFactory;

    protected $fillable = [
             'master_device_id',
             'slave_device_id',
             'io_slave_name', 
             'io_device_status', 
             'created_ip_address',
             'modified_ip_address',
             'created_by',
             'modified_by',
             'status',
    ];


      // Relationship with DeviceMaster
      public function masterDevice()
      {
          return $this->belongsTo(DeviceMaster::class, 'master_device_id');
      }
  
      // Relationship with SlaveDeviceMaster
      public function slaveDevice()
      {
          return $this->belongsTo(SlaveDeviceMaster::class, 'slave_device_id');
      }

}
