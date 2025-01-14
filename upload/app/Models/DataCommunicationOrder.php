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
        'price',
        'count',
        'note',
        'mobile',
        'status'
    ];
    public function profits()
    {
        return $this->morphMany(Profit::class, 'profitable');
    }
}
