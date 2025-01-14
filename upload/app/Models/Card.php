<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Card extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'image_url',
        'price',
        'note',
        'status',
    ];
  
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'card_orders', 'card_id', 'user_id');
    }
    public function orders()
    {
        return $this->hasMany(CardOrder::class, 'card_id');
    }
    
}
