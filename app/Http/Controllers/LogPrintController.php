<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogPrint;

class LogPrintController extends Controller
{

    protected $connection = 'mysql';
    
    public function index(){

        return view('print.index');
    }

    public function store(Request $request){

        $request -> validate([
            'bulan'         => 'required', 
            'tahun'         => 'required',
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        return redirect()->route('print.view', ['bulan' => $bulan, 'tahun' => $tahun]);

    }

    public function view($bulan, $tahun){

        $data = LogPrint::whereYear('LOGTIME', '=', $tahun)
                ->whereMonth('LOGTIME', '=', $bulan)
                ->paginate(30);

        return view('print.log', compact('data'));

    }
}
