<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogCuser;

class LogCuserController extends Controller
{

    protected $connection = 'mysql';
    
    public function index(){

        return view('cuser.index');
    }

    public function store(Request $request){

        $request -> validate([
            'bulan'         => 'required', 
            'tahun'         => 'required',
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        return redirect()->route('cuser.view', ['bulan' => $bulan, 'tahun' => $tahun]);

    }

    public function view($bulan, $tahun){

        $data = LogCuser::whereYear('LOGTIME', '=', $tahun)
                ->whereMonth('LOGTIME', '=', $bulan)
                ->paginate(30);

        return view('cuser.log', compact('data'));

    }
}
