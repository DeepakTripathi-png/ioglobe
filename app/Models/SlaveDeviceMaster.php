<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlaveDeviceMaster extends Model
{
    use HasFactory;

    protected $fillable = [
           'slave_device_name',
           'slave_device_image_path',
           'slave_device_image_name',
           'created_ip_address',
           'modified_ip_address',
           'created_by',
           'modified_by',
           'status', 
    ];

    public function ioSlaves()
    {
        return $this->hasMany(IOSlave::class, 'slave_device_id');
    }
}
