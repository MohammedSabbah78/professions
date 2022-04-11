<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //



    public function index(Request $request)
    {
        $request->user()->notifications->markAsRead();
        $notifications =  $request->user()->notifications;
        return response()->view('notifications.index', ['notifications' => $notifications]);
    }
}
