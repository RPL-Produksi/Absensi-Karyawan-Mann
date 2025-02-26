<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function indexLogin(Request $request)
    {
        $data['isAdmin'] = $request->has('admin');

        return view('pages.auth.login')->with($data);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $user = User::where($loginType, $request->login)->first();

        if (!$user) {
            return redirect()->back()->with('error', $loginType == 'email' ? 'Email' : 'Username ' . 'atau Password Salah');
        }

        $isAdmin = $request->has('admin');
        if ($user->role === 'admin' && !$isAdmin) {
            return redirect()->back()->with('error', $loginType == 'email' ? 'Email' : 'Username ' . 'atau Password Salah');
        }

        if (Auth::attempt([$loginType => $request->login, 'password' => $request->password])) {
            if ($isAdmin) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('user.dashboard');
        }

        return redirect()->back()->with('error', $loginType == 'email' ? 'Email' : 'Username ' . 'atau Password Salah');
    }
}
