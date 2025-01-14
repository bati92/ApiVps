<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
   

    protected $fillable = ['user_id', 'service_id', 'price', 'status', 'requested_at','mobile','email','password','ime'];
   public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function profits()
    {
        return $this->morphMany(Profit::class, 'profitable');
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
