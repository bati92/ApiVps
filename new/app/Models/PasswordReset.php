<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
        // تحديد الأعمدة التي يمكن ملؤها (fillable)
        protected $fillable = [
            'email',
            'token',
            'created_at',
        ];
    
        // إلغاء خاصية التوقيت التلقائي لأن الجدول لا يحتوي على updated_at
        public $timestamps = false;
}
