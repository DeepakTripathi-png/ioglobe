<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Master_admin;

class AssignDevice extends Model
{
    use HasFactory;

    protected $fillable = [
         'customer_id',
         'site_id',
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

   
   public function customer()
   {
       return $this->belongsTo(Master_admin::class);  
   }
}
