<?php

namespace App\Http\Controllers\Frontend\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('pages.users.home');
    }
}
