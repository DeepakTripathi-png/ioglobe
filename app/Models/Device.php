<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'device_type_id',
        'device_id',
        'device_name',
        'description',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status', 
   ];


   public function site()
   {
       return $this->belongsTo(SiteMaster::class);  
   }

   
   public function deviceType()
   {
       return $this->belongsTo(DeviceMaster::class,'device_id','id');  
   }


}
