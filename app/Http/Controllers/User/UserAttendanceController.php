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

        if ($attendance->time_in) {
            return redirect()->back()->with('error', 'You have already checked in.');
        }

        $attendance->time_in = Carbon::now(); 
        $attendance->save();

        return redirect()->route('user.dashboard')->with('success', 'Checked in successfully!');
    }

    public function markCheckOut(Request $request)
    {
        $attendance = Attendance::findOrFail($request->attendance_id);

        if ($attendance->time_out) {
            return redirect()->back()->with('error', 'You have already checked out.');
        }

        $attendance->time_out = Carbon::now(); 
        $attendance->save();

        return redirect()->route('user.dashboard')->with('success', 'Checked out successfully!');
    }
}
