<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class LoginController extends Controller
{

    public function formLogin()
    {

        if (Auth::check()) {

            return redirect()->route('dashboard.index');
        }

        return view('login');
    }

    public function login(Request $request)
    {

        $username = strtoupper($request->username);
        // $credentials = $request->only('username', 'password');

        if (Auth::attempt(['username' => $username, 'password' => $request->password])) {

            return redirect()->route('dashboard.index');
        }

        return back()->with('error', 'Username dan Password');
    }
}
