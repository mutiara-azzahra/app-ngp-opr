<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogReindex;

class LogReindexController extends Controller
{
    
    public function index(){

        return view('reindex.index');
    }

    public function store(Request $request){

        $request -> validate([
            'bulan'         => 'required', 
            'tahun'         => 'required',
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        return redirect()->route('reindex.view', ['bulan' => $bulan, 'tahun' => $tahun]);

    }

    public function view($bulan, $tahun){

        $data = LogReindex::whereYear('LOGTIME', '=', $tahun)
                ->whereMonth('LOGTIME', '=', $bulan)
                ->paginate(30);

        return view('reindex.log', compact('data'));

    }
}
