<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogForm;

class LogFormController extends Controller
{
    protected $connection = 'mysql';
    
    public function index(){

        return view('form.index');
    }

    public function store(Request $request){

        $request -> validate([
            'bulan'         => 'required', 
            'tahun'         => 'required',
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        return redirect()->route('form.view', ['bulan' => $bulan, 'tahun' => $tahun]);

    }

    public function view($bulan, $tahun){

        $data = LogForm::whereYear('LOGTIME', '=', $tahun)
                ->whereMonth('LOGTIME', '=', $bulan)
                ->paginate(30);

        return view('form.log', compact('data'));

    }
}
