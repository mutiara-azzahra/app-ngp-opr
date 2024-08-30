<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactPersonController extends Controller
{
    public function index(){

        $data = Ownership::paginate(20);
        
        return view('ownership.index', compact('data'));
    }
}
