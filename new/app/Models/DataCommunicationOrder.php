<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataCommunicationOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_communication_id',
        'user_id',
        'player_no',
        'count',
        'price',
        'note',
        'status'
    ];
    public function profits()
    {
        return $this->morphMany(Profit::class, 'profitable');
    }
}
