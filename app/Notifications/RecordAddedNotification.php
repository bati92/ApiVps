<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class RecordAddedNotification extends Notification
{
    use Queueable;

    protected $tableName;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    public function via($notifiable)
    {
        return ['database']; // تخزين الإشعار في قاعدة البيانات
    }

    public function toDatabase($notifiable)
    {
        // قائمة أسماء الجداول وترجمتها إلى العربية
        $tableNamesInArabic = [
            'app_orders' => 'التطبيقات',
            'data_communication_orders' => 'اتصالات البيانات',
            'game_orders' => 'الألعاب',
            'ecard_orders' => 'البطاقات الإلكترونية',
            'program_orders' => 'البرامج',
            'card_orders' => 'بطاقاتنا',
            'transfer_orders' => 'نقل رصيد ',
            'transfer_money_firm_orders' => 'اضافة رصيد',
        ];

        // اختيار الاسم العربي إذا كان موجوداً، وإلا استخدام الاسم الافتراضي
        $translatedTableName = $tableNamesInArabic[$this->tableName] ?? $this->tableName;

        return [
            'message' => "طلب جديد: {$translatedTableName}",
        ];
    }
}
