<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $data['attedances'] = Attendance::all();

        return view('pages.admin.dashboard')->with($data);
    }
}
