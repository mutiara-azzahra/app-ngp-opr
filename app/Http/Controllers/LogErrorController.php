<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogError;

class LogErrorController extends Controller
{
    protected $connection = 'mysql';
    
    public function index(){

        return view('error.index');
    }

    public function store(Request $request){

        $request -> validate([
            'bulan'         => 'required', 
            'tahun'         => 'required',
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        return redirect()->route('error.view', ['bulan' => $bulan, 'tahun' => $tahun]);

    }

    public function view($bulan, $tahun){

        $data = LogError::whereYear('LOGTIME', '=', $tahun)
                ->whereMonth('LOGTIME', '=', $bulan)
                ->paginate(30);

        return view('error.log', compact('data'));

    }
}
