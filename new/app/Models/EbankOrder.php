<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EbankOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'ebank_id',
       
        'count',
        'price',
        'mobile',
        'note',
        'status'
    ];
    public function profits()
    {
        return $this->morphMany(Profit::class, 'profitable');
    }
}
