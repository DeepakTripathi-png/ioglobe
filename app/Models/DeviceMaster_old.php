<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceMaster extends Model
{
    use HasFactory;

    protected $fillable = [
            'device_type',
            'created_ip_address',
            'modified_ip_address',
            'created_by',
            'modified_by',
            'status', 
    ];
}
