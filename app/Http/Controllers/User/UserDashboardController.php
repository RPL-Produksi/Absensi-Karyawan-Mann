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
        return view('pages.users.dashboard', compact('attendances'));
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make([
            'fullname' => ['required'],
            'username' => ['required', 'unique:users,username,' . $user->id],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'password' => ['required', 'min:6', 'confirmed'],
            'address' => ['required'],
            'phone_number' => ['required'],
            'position' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
    }
}
