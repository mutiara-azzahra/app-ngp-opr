<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $user = Auth::user()->USERNAME;

        return view('welcome', compact('user'));
    }
}
