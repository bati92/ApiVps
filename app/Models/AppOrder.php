<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class AppOrder extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'app_id',
        'user_id',
        'player_no',
        'count',
        'price',
        'note',
        'status'
    ];
    public function app()
{
    return $this->belongsTo(App::class, 'app_id');
}
public function profits()
{
    return $this->morphMany(Profit::class, 'profitable');
}
}
