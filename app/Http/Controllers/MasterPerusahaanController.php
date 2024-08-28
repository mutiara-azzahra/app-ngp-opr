<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perusahaan;

class MasterPerusahaanController extends Controller
{
    
    public function index(){

        $data = Perusahaan::paginate(10);
        
        return view('master-perusahaan.index', compact('data'));
    }

}
