<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'controller_type_id',
        'device_id',
        'device_name',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status', 
    ];


    public function ioSlaves()
    {
        return $this->hasMany(IOSlave::class, 'master_device_id');
    }

    public function controllerDevice()
    {
        return $this->belongsTo(ControllerDevice::class, 'controller_type_id');
    }


}
