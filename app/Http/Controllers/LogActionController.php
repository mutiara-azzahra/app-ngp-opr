<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogAction;

class LogActionController extends Controller
{

    protected $connection = 'mysql';
    
    public function index(){

        return view('action.index');
    }

    public function store(Request $request){

        $request -> validate([
            'bulan'         => 'required', 
            'tahun'         => 'required',
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        return redirect()->route('action.view', ['bulan' => $bulan, 'tahun' => $tahun]);

    }

    public function view($bulan, $tahun){

        $data = LogAction::whereYear('LOGTIME', '=', $tahun)
                ->whereMonth('LOGTIME', '=', $bulan)
                ->paginate(30);

        return view('action.log', compact('data'));

    }
}
