<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return view('notification.index', [
            'notifications' => auth()->user()->notifications()->latest()->paginate(10)
        ]);
    }
}
