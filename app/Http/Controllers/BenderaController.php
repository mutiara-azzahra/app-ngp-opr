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
        );

        $kode_bendera = $request->input('kode_bendera');
        $asal_negara = $request->input('asal_negara');

        $data = Bendera::where('KODE_BENDERA', $kode_bendera)->first();
        $lastest_data = Bendera::orderBy('FLAG_IDX', 'desc')->first();

        if (!$data) {

            $input['KODE_BENDERA']          = strtoupper($kode_bendera);
            $input['ASAL_NEGARA']           = strtoupper($asal_negara);
            $input['NOTE']                  = $request->note;
            if (!$lastest_data) {
                $input['FLAG_IDX']           = 1;
            } else {
                $input['FLAG_IDX']           = $lastest_data->FLAG_IDX + 1;
            }
            $input['LOG_ENTRY_NAME']         = Auth::user()->USERNAME;
            $input['LOG_ENTRY_DATE']         = NOW();

            $created    = Bendera::create($input);

            return response()->json([
                'message' => 'Data berhasil ditambahkan',
                'data' => $created
            ]);
        }
    }

    public function edit(Request $request)
    {

        $flag_idx = $request->input('id');

        $data = Bendera::where('FLAG_IDX', $flag_idx)->first();

        if (!$data) {
            return response()->json(['error' => 'Data Bendera tidak ditemukan'], 404);
        }

        return response()->json($data);
    }

    //2
    public function show(Request $request)
    {

        if ($request->session()->token() == $request->input('_token')) {

            $flag_idx = $request->input('id');

            $data = Bendera::where('FLAG_IDX', $flag_idx)->first();

            if (!$data) {
                return response()->json(['error' => 'Data Bendera tidak ditemukan'], 404);
            }

            return response()->json($data);
        } else {

            //disini
        }
    }

    public function update(Request $request, Bendera $bendera)
    {
        $request->validate([
            'kode_bendera' => 'required',
            'asal_negara' => 'required'
        ]);

        $id = $request->input('id');
        $kode_bendera = $request->input('kode_bendera');
        $asal_negara = $request->input('asal_negara');

        try {

            Bendera::where('FLAG_IDX', $id)->update([
                'KODE_BENDERA' => $kode_bendera,
                'ASAL_NEGARA' => $asal_negara,
            ]);

            return response()->json([
                'message' => 'Data berhasil diubah',
                'data' => [
                    'id' => $id,
                    'kode_bendera' => $kode_bendera,
                    'asal_negara' => $asal_negara
                ]
            ], 200);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Gagal ubah kode bendera'], 500);
        }
    }

    public function destroy(Request $request)
    {

        $checkedValue = $request->hapus_data;

        Bendera::whereIn('FLAG_IDX', $checkedValue)->delete();
    }

    public function print(Request $request)
    {

        $checkedValue = $request->checked_data;

        $pdf   = PDF::loadView('reports.bendera', ['data' => $checkedValue]);
        $pdf->setPaper('letter', 'potrait');

        return $pdf->stream('bendera.pdf');

        return response()->json([
            'message' => 'Data berhasil dicetak',
            'data'    => $checkedValue
        ], 200);
    }
}
