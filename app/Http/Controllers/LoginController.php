<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
// use App\Models\LogLogin;

class LoginController extends Controller
{

    public function username()
    {
        return 'USERNAME';
    }

    public function formLogin(){

        if (Auth::check()) {

            return redirect()->route('dashboard.index');
        }

        return view('login');
    }

    // public function login(Request $request)
    // {
    //     $credentials = $request->only('USERNAME', 'PASSWORD3');

    //     if (Auth::attempt([
    //         'username' => $credentials['USERNAME'],
    //         'password' => $credentials['PASSWORD3']
    //     ])) {

    //         // $request->session()->regenerate();
            
    //         return redirect()->route('dashboard.index'); 
    //     }

    //     return back()->with('error', 'Username or password is incorrect.');
    // }

    public function login(Request $request)
    {
       $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {

            // $request->session()->regenerate();
            
            return redirect()->route('dashboard.index'); 
        }

        return back()->with('error', 'Username or password is incorrect.');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.formLogin')->with('success','Anda berhasil keluar!');
    }

}
