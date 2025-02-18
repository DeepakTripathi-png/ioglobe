<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControllerDevice extends Model
{
    use HasFactory;

    protected $fillable = [
       'controller_name', 
       'created_ip_address',
       'modified_ip_address',
       'created_by',
       'modified_by',
       'status',
   ];
}
