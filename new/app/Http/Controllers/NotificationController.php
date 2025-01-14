<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getUnreadNotifications()
    {
        $admin = auth()->user();
        if ($admin) {
            return response()->json($admin->unreadNotifications);
    
        return response()->json([]);
    }
}
}