<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $attendances = Attendance::where('user_id', $user->id)->get();
        $attendances->map(function ($attendance) {
            $attendance->day = date('l', strtotime($attendance->date));
        });
        $dataAttendances = [
            $attendances->whereNotNull('time_in')->count(),
            $attendances->whereNull('time_in')->count()
        ];
        return view('pages.users.dashboard', compact('attendances', 'dataAttendances'));
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'fullname' => ['required'],
            'username' => ['required', 'unique:users,username,' . $user->id],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'address' => ['required'],
            'phone_number' => ['required'],
            'position' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $validateEmail = filter_var($request->email, FILTER_VALIDATE_EMAIL);
        if (!$validateEmail) {
            return redirect()->back()->withErrors(['error' => 'Email is not valid']);
        }

        $data = $request->all();
        $user->update($data);

        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard')->with(['message' => 'Profile updated Successfully']);
        }
        return redirect()->route('user.dashboard')->with(['message' => 'Profile updated Successfully']);
    }
}
