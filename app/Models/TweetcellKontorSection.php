<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class TweetcellKontorSection extends Model
{
    protected $fillable = [
        
        'mobile',
        'price',
        'note',
        'image',
       'image_url',
        'status',
      
    ];

    public function tweetcellKontors(): HasMany
    {
        return $this->hasMany(TweetcellKontor::class, 'section_id');
    }
}
