<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_user_id',      // المرسل
        'to_user_id',        // المستلم
        'amount', 
        'payment_done',
        'note',       // المبلغ
    ];

    /**
     * علاقة مع المستخدم المرسل (from_user_id)
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    /**
     * علاقة مع المستخدم المستلم (to_user_id)
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

   
}
