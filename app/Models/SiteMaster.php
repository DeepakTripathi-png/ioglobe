<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteMaster extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'site_name',
        'site_address',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status', 
   ];
}
