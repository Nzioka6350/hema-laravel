<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function notifications(Request $request)
    {
        return auth()->user()->notifications;
    }

    public function unreadNotifications(Request $request)
    {
        return auth()->user()->unreadNotifications;
    }

    public function show($id)
    {
        return auth()->user()->notifications->find($id);
    }

    public function markNotificationAsRead($id)
    {
        auth()->user()->notifications->find($id)->markAsRead();
        return response(status: 200);
    }

    public function deleteNotification($id)
    {
        auth()->user()->notifications->find($id)->delete();
        return response(status: 204);
    }

    public function markAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return response(status: 200);
    }

    public function deleteRead()
    {
        foreach (auth()->user()->notifications as $notification) {
            if ($notification->read_at !== null) {
                $notification->delete();
            }
        }
        return response(status: 200);
    }
}
