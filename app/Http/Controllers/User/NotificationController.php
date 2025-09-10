<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(15);

        Auth::user()->unreadNotifications->markAsRead();

        return view('pages.app.notifications.index', compact('notifications'));
    }
}
