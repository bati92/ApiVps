<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class AppSection extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'id',
        'name',
        'image',
        'image_url',
        'status',
    ];
    
    public function apps(): HasMany
    {
        return $this->hasMany(App::class, 'section_id');
    }
 
}
