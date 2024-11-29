<?php

namespace App\Observers;

use App\Notifications\RecordAddedNotification;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GeneralObserver
{
    public function created($model)
    {
        $admin = User::where('role', 1)->first();
        if ($admin) {
            $tableName = $model->getTable();
            $admin->notify(new RecordAddedNotification($tableName));
        }
    }
}

