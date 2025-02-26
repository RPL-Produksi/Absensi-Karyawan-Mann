<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAttendaceController extends Controller
{
    public function timeIn(Request $request)
    {
        $user = $request->user();
    }
}
