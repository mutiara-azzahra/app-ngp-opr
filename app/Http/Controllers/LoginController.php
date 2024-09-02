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

    public function formLogin(){

        if (Auth::check()) {

            return redirect()->route('dashboard.index');
        }

        return view('login');
    }

    public function login(Request $request){

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            
            $request->session()->regenerate();

            return redirect()->route('dashboard.index');
        }

        return back()->with('danger','Username atau password salah!');
        
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.formLogin')->with('success','Anda berhasil keluar!');
    }

}
