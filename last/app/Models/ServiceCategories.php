<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategories extends Model
{
    protected $fillable = ['name', 'description','image','image_url'];

    public function services()
    {
        return $this->hasMany(Service::class, 'section_id');
    }
}
