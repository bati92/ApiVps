<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class App extends Model
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'name',
        'price',
        'image',
        'image_url',
        'note',
        'status',
        'section_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'app_orders', 'app_id', 'user_id');
    }
    
    public function appSection(): BelongsTo
    {
        return $this->belongsTo(AppSection::class, 'section_id');
    }
    public function favorites()
    { 
        return $this->morphMany(Favorite::class, 'favoritable');
    }
    public function orders()
    {
        return $this->hasMany(AppOrder::class, 'app_id');
    }
}
