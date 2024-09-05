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
    //    $credentials = $request->only('username', 'password');

    //     if (Auth::attempt($credentials)) {
            
    //         return redirect()->route('dashboard.index'); 
    //     }

    //     return back()->with('error', 'Username or password is incorrect.');
    // }

    public function login(Request $request)
    {
       $credentials = $request->only('username', 'password');

       $user = User::where('username', $request->username)->first();
       $pw2 = md5($request->password);

       if($user){

            if(($request->password === $user->password)){

                if($pw2 == $user->PASSWORD2){

                    if (Auth::attempt($credentials)) {
                
                        return redirect()->route('dashboard.index');

                    } else {

                        return back()->with('danger', 'Username atau password salah');
                    }

                } else {

                    //bypass without auth
                    return back()->with('danger', 'Ada yang salah');
                }

            } elseif ($request->password !== null && $user->password == '') {

                    if($pw2 == $user->PASSWORD2){

                        if (Auth::attempt($credentials)) {
                    
                            return redirect()->route('dashboard.index');

                        } else {

                            return back()->with('danger', 'Username atau password salah');
                        }

                    } else {

                        return back()->with('danger', 'Username atau password salah!');
                    }

            } else {

                return back()->with('danger', 'Ada yang salah');

            } 

        }

        return back()->with('danger', 'Username anda tidak terdaftar');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.formLogin')->with('success','Anda berhasil keluar!');
    }

}
