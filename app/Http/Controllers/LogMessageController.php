<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogMessage;

class LogMessageController extends Controller
{

    protected $connection = 'mysql';
    
    public function index(){

        return view('message.index');
    }

    public function store(Request $request){

        $request -> validate([
            'bulan'         => 'required', 
            'tahun'         => 'required',
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        return redirect()->route('message.view', ['bulan' => $bulan, 'tahun' => $tahun]);

    }

    public function view($bulan, $tahun){

        $data = LogMessage::whereYear('LOGTIME', '=', $tahun)
                ->whereMonth('LOGTIME', '=', $bulan)
                ->paginate(30);

        return view('message.log', compact('data'));

    }
}
