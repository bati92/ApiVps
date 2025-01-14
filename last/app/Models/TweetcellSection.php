<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class TweetcellSection extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'name',
        'image',
        'type',
        'image_url',
        'status',
    ];

    public function tweetcells(): HasMany
    {
        return $this->hasMany(Tweetcell::class, 'section_id');
    }
}
