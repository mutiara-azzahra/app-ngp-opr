<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogEtc;

class LogEtcController extends Controller
{
    
    public function index(){

        return view('etc.index');
    }

    public function store(Request $request){

        $request -> validate([
            'bulan'         => 'required', 
            'tahun'         => 'required',
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        return redirect()->route('etc.view', ['bulan' => $bulan, 'tahun' => $tahun]);

    }

    public function view($bulan, $tahun){

        $data = LogEtc::whereYear('LOGTIME', '=', $tahun)
                ->whereMonth('LOGTIME', '=', $bulan)
                ->paginate(30);

        return view('etc.log', compact('data'));

    }
}
