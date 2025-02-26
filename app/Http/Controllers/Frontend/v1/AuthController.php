<?php

namespace App\Http\Controllers\Frontend\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register()
    {
        return view('pages.auth.register');
    }
    
    public function login()
    {
        return view('pages.auth.login');
    }
}
