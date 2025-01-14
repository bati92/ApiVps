<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'section_id',
        'name',
        'image', 
      'user_id_game',
        'image_url',
        'basic_price',
        'price',
        'status',
        'amount',
        'note',
    ];
 
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'game_orders','user_id', 'game_id');
    }
    
    public function gameSection(): BelongsTo
    {
        return $this->belongsTo(GameSection::class, 'section_id');
    }
    public function orders()
{
    return $this->hasMany(GameOrder::class, 'game_id');
}






}
