<?php

namespace App\Http\Controllers\Backend\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        
    }

    public function login(Request $request)
    {

    }

    public function logout(Request $request)
    {
        if ($request->wantsJson()) {
            $request->user()->token()->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Logged out successfully'
            ], 200);
        }

        Auth::logout();
        // return redirect()->route('login');
        return true;
    }
}
