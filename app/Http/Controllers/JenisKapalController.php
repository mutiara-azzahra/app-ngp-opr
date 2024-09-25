<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisKapal;

class JenisKapalController extends Controller
{
    public function index()
    {

        $jenis_kapal = JenisKapal::all();
        $no = 1;

        return view('jenis-kapal.index', compact('jenis_kapal', 'no'));
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'jenis_kapal'   => 'required',
                'g1'            => 'required',
            ],
            [
                'required'  => 'Data :attribute belum diisi'
            ]
        );

        $data = JenisKapal::where('KODE_BENDERA', $request->kode_bendera)->first();
        $lastest_data = JenisKapal::orderBy('FLAG_IDX', 'desc')->first();

        if (!$data) {

            $input['JENIS_KAPAL']          = $request->jenis_kapal;
            $input['G1']                   = $request->g1;
            $input['NOTE']                 = $request->note;
            if (!$lastest_data) {
                $input['FLAG_IDX']         = 1;
            } else {
                $input['FLAG_IDX']         = $lastest_data->FLAG_IDX + 1;
            }
            $input['LOG_ENTRY_NAME']       = Auth::user()->USERNAME;
            $input['LOG_ENTRY_DATE']       = NOW();


            $created    = JenisKapal::create($input);

            if ($created) {

                return redirect()->route('jenis-kapal.index')->with('success', 'Data jenis-kapal kapal baru berhasil ditambahkan!');
            } else {

                return redirect()->route('jenis-kapal.create')->with('danger', 'Maaf! ada data yang belum terisi');
            }
        } else {

            return redirect()->route('jenis-kapal.create')->with('danger', 'Kode jenis-kapal sudah ada!');
        }
    }

    public function update(Request $request)
    {

        $jenis_kapal = $request->input('jenis_kapal');
        $g1 = $request->input('g1');

        JenisKapal::where('JENIS_KAPAL', $jenis_kapal)->update([
            'JENIS_KAPAL'   => $jenis_kapal,
            'G1'            => $g1,
            'LOG_EDIT_NAME' => Auth::user()->USERNAME,
            'LOG_EDIT_DATE' => Carbon::now(),
        ]);

        return redirect()->route('jenis-kapal.index')->with('danger', 'Kode jenis-kapal sudah ada!');
    }

    public function destroy(Request $request)
    {

        $checkedValue = $request->input('id');

        JenisKapal::whereIn('FLAG_IDX', $checkedValue)->delete();
    }
}
