<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class GameSection extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'name',
        'image',
        'image_url',
        'status',
    ];

    public function games(): HasMany
    {
        return $this->hasMany(Game::class, 'section_id');
    }
}
