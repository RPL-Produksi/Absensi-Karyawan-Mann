<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserAttendanceController extends Controller
{
    public function markCheckIn(Request $request)
    {
        $attendance = Attendance::findOrFail($request->attendance_id);

        // Check if the user already checked in today
        if ($attendance->time_in) {
            return redirect()->back()->with('error', 'You have already checked in.');
        }

        $attendance->time_in = Carbon::now();  // Set current time for check-in
        $attendance->save();

        return redirect()->route('user.dashboard')->with('success', 'Checked in successfully!');
    }

    // Mark Check-out (POST)
    public function markCheckOut(Request $request)
    {
        $attendance = Attendance::findOrFail($request->attendance_id);

        // Check if the user already checked out today
        if ($attendance->time_out) {
            return redirect()->back()->with('error', 'You have already checked out.');
        }

        $attendance->time_out = Carbon::now();  // Set current time for check-out
        $attendance->save();

        return redirect()->route('user.dashboard')->with('success', 'Checked out successfully!');
    }
}
