<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $attendances = Attendance::where('user_id', $user->id)->get();
        $attendances->map(function ($attendance) {
            $attendance->day = date('l', strtotime($attendance->date));
        });
        return view('pages.users.dashboard', compact('attendances'));
    }
}
