<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $data['attendances'] = Attendance::select(
            'user_id',
            DB::raw('COUNT(*) as total_kehadiran'),
            DB::raw('MAX(time_in) as time_in'),
            DB::raw('MAX(time_out) as time_out'),
            DB::raw('MAX(date) as date')
        )->groupBy('user_id')->with('user')->get();

        return view('pages.admin.dashboard')->with($data);
    }
}
