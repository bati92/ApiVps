<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{    protected $fillable = ['section_id', 'name', 'status','note','type','basic_price', 'price','image','image_url'];

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_id');
    }

  
    public function users()
    {
        return $this->belongsToMany(User::class, 'service_orders','user_id', 'service_id');
    }
    public function orders()
    {
        return $this->hasMany(ServiceOrder::class, 'service_id');
    }
    
}
