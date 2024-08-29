<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ownership;

class OwnershipController extends Controller
{
    public function index(){

        $data = Ownership::paginate(20);
        
        return view('ownership.index', compact('data'));
    }
}
