<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Bendera;

class BenderaController extends Controller
{
    public function index()
    {

        $bendera = Bendera::all();
        $no = 1;

        return view('bendera.index', compact('bendera', 'no'));
    }

    public function create()
    {

        return view('bendera.create');
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'kode_bendera'        => 'required',
                'asal_negara'         => 'required',
            ],
            [
                'required'  => 'Data :attribute belum diisi'
            ]
        );

        $data = Bendera::where('KODE_BENDERA', $request->kode_bendera)->first();
        $lastest_data = Bendera::orderBy('FLAG_IDX', 'desc')->first();

        if (!$data) {

            $input['KODE_BENDERA']          = strtoupper($request->kode_bendera);
            $input['ASAL_NEGARA']           = strtoupper($request->asal_negara);
            $input['NOTE']                  = $request->note;
            if (!$lastest_data) {
                $input['FLAG_IDX']           = 1;
            } else {
                $input['FLAG_IDX']           = $lastest_data->FLAG_IDX + 1;
            }
            $input['LOG_ENTRY_NAME']         = Auth::user()->USERNAME;
            $input['LOG_ENTRY_DATE']         = NOW();


            $created    = Bendera::create($input);

            if ($created) {

                return redirect()->route('bendera.index')->with('success', 'Data bendera kapal baru berhasil ditambahkan!');
            } else {

                return redirect()->route('bendera.create')->with('danger', 'Maaf! ada data yang belum terisi');
            }
        } else {

            return redirect()->route('bendera.create')->with('danger', 'Kode bendera sudah ada!');
        }
    }

    public function edit($id)
    {

        $data = Bendera::where('KODE_BENDERA', $id)->first();

        return view('bendera.edit', compact('data'));
    }

    public function show(Request $request)
    {

        $flag_idx = $request->input('id');

        $data = Bendera::where('FLAG_IDX', $flag_idx)->first();

        if (!$data) {
            return response()->json(['error' => 'Data Bendera tidak ditemukan'], 404);
        }

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $kode_bendera = $request->input('kode_bendera');

        $data = Bendera::where('KODE_BENDERA', $kode_bendera)->first();

        dd($data);
    }

    public function destroy(Request $request)
    {

        $checkedValue = $request->hapus_data;

        Bendera::whereIn('FLAG_IDX', $checkedValue)->delete();
    }
}
