<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'card_id',
        'user_id',
        'price',
        'count',
        'note',
        'status'
    ];
    public function profits()
    {
        return $this->morphMany(Profit::class, 'profitable');
    }
}
