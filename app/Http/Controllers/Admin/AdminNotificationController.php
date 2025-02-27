<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminNotificationController extends Controller
{
    public function index()
    {
        $data['notifications'] = Notification::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('pages.admin.notification.index')->with($data);
    }

    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)->where('user_id', Auth::user()->id)->first();
        if ($notification) {
            $notification->update(['is_read' => true]);
        }

        return redirect()->back();
    }

    public function markAllAsRead()
    {
        Notification::where('user_id', auth()->id())->where('is_read', false)->update(['is_read' => true]);

        return back()->with('success', 'Semua notifikasi telah dibaca.');
    }
}
