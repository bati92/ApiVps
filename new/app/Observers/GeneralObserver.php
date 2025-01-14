<?php

namespace App\Observers;

use App\Notifications\RecordAddedNotification;
use App\Models\User;

class GeneralObserver
{
    public function created($model)
    {
        $admin = User::where('role', 1)->first();
        if ($admin) {
            // بناء الرسالة باستخدام مترجم الجداول
            $translatedTableName = $this->translateTableName($model->getTable());
            $message = "طلب جديد: {$translatedTableName}";
            
            $admin->notify(new RecordAddedNotification($message));
        }
    }

    private function translateTableName($tableName)
    {
        // ترجمة الجداول
        $tableNamesInArabic = [
            'app_orders' => 'التطبيقات',
            'data_communication_orders' => 'اتصالات البيانات',
            'game_orders' => 'الألعاب',
            'ecard_orders' => 'البطاقات الإلكترونية',
            'program_orders' => 'البرامج',
            'card_orders' => 'بطاقاتنا',
            'transfer_orders' => 'نقل رصيد',
            'transfer_money_firm_orders' => 'اضافة رصيد',
        ];

        return $tableNamesInArabic[$tableName] ?? $tableName;
    }
}
