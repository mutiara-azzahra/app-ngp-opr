<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ownership;
use App\Models\Kapal;
use App\Models\Bendera;

class OwnershipController extends Controller
{
    public function index()
    {

        $ownership = Ownership::where('FLAG_STATUS', 1)->get();
        $no = 1;

        return view('ownership.index', compact('ownership', 'no'));
    }

    // public function show(Request $request)
    // {

    //     $flag_idx = $request->input('id');

    //     $data = Kapal::where('FLAG_IDX', $flag_idx)->first();

    //     if (!$data) {
    //         return response()->json(['error' => 'Data Kapal tidak ditemukan'], 404);
    //     }

    //     return response()->json($data);
    // }

    // public function edit(Request $request)
    // {

    //     $flag_idx = $request->input('id');

    //     $data = Kapal::where('FLAG_IDX', $flag_idx)->first();

    //     if (!$data) {
    //         return response()->json(['error' => 'Data Kapal tidak ditemukan'], 404);
    //     }

    //     return response()->json($data);
    // }

    // public function store(Request $request)
    // {

    //     $request->validate(
    //         [
    //             'kode_kapal'            => 'required',
    //             'nama_kapal'            => 'required',
    //             'jenis_kapal'           => 'required',
    //             'panjang'               => 'required',
    //             'lebar'                 => 'required',
    //             'tinggi'                => 'required',
    //             'draft'                 => 'required',
    //             'gross_ton'             => 'required',
    //             'dead_ton'              => 'required',
    //             'jenis_mesin'           => 'required',

    //         ],
    //         [
    //             'required'  => 'Data :attribute belum diisi',
    //         ]
    //     );

    //     $data = Kapal::where('KODE_KAPAL', strtoupper($request->kode_kapal))->first();
    //     $lastest_data = Kapal::orderBy('FLAG_IDX', 'desc')->first();

    //     if (!$data) {

    //         $input['KODE_KAPAL']            = strtoupper($request->kode_kapal);
    //         $input['NAMA_KAPAL']            = strtoupper($request->nama_kapal);
    //         $input['CALLSIGN']              = strtoupper($request->callsign);
    //         $input['JENIS_KAPAL']           = strtoupper($request->jenis_kapal);
    //         $input['KODE_BENDERA']          = strtoupper($request->kode_bendera);
    //         $input['PANJANG']               = $request->panjang;
    //         $input['LEBAR']                 = $request->lebar;
    //         $input['DRAFT']                 = $request->draft;
    //         $input['TINGGI']                = $request->tinggi;
    //         $input['GROSS_TON']             = $request->gross_ton;
    //         $input['DEAD_TON']              = $request->dead_ton;
    //         $input['DISPLACEMENT']          = $request->displacement;
    //         $input['JENIS_MESIN']           = strtoupper($request->jenis_mesin);
    //         $input['DAYA_MESIN']            = $request->daya_mesin;
    //         $input['KECEPATAN_MAX']         = $request->kecepatan_max;
    //         $input['KAPASITAS_KARGO']       = $request->kapasitas_kargo;
    //         $input['KAPASITAS_PENUMPANG']   = $request->kapasitas_penumpang;
    //         $input['TAHUN_PEMBUATAN']       = $request->tahun_pembuatan;
    //         $input['GALANGAN_KAPAL']        = $request->galangan_kapal;
    //         $input['KLASIFIKASI']           = $request->klasifikasi;
    //         if (!$lastest_data) {
    //             $input['FLAG_IDX']         = 1;
    //         } else {
    //             $input['FLAG_IDX']         = $lastest_data->FLAG_IDX + 1;
    //         }
    //         $input['LOG_ENTRY_NAME']       = Auth::user()->USERNAME;
    //         $input['LOG_ENTRY_DATE']       = NOW();

    //         $created    = Kapal::create($input);

    //         if ($created) {

    //             return redirect()->route('kapal.index')->with('success', 'Data kapal kapal baru berhasil ditambahkan!');
    //         } else {

    //             return redirect()->route('kapal.index')->with('danger', 'Maaf! ada data yang belum terisi');
    //         }
    //     } else {

    //         return redirect()->route('kapal.index')->with('danger', 'Kode kapal sudah ada!');
    //     }
    // }

    // public function update(Request $request)
    // {

    //     $update = Kapal::where('KODE_KAPAL', $request->kode_kapal)->update([
    //         'NAMA_KAPAL'            => strtoupper($request->nama_kapal),
    //         'CALLSIGN'              => strtoupper($request->callsign),
    //         'JENIS_KAPAL'           => strtoupper($request->jenis_kapal),
    //         'KODE_BENDERA'          => strtoupper($request->kode_bendera),
    //         'PANJANG'               => $request->panjang,
    //         'LEBAR'                 => $request->lebar,
    //         'TINGGI'                => $request->tinggi,
    //         'DRAFT'                 => $request->draft,
    //         'GROSS_TON'             => $request->gross_ton,
    //         'DEAD_TON'              => $request->dead_ton,
    //         'DISPLACEMENT'          => $request->displacement,
    //         'JENIS_MESIN'           => strtoupper($request->jenis_mesin),
    //         'DAYA_MESIN'            => $request->daya_mesin,
    //         'KECEPATAN_MAX'         => $request->kecepatan_max,
    //         'KAPASITAS_KARGO'       => $request->kapasitas_kargo,
    //         'KAPASITAS_PENUMPANG'   => $request->kapasitas_penumpang,
    //         'TAHUN_PEMBUATAN'       => $request->tahun_pembuatan,
    //         'GALANGAN_KAPAL'        => $request->galangan_kapal,
    //         'KLASIFIKASI'           => $request->klasifikasi,
    //         'LOG_EDIT_NAME'         => Auth::user()->USERNAME,
    //         'LOG_EDIT_DATE'         => Carbon::now(),
    //     ]);

    //     if (!$update) {
    //         return response()->json(['error' => 'Data Kapal tidak ditemukan'], 404);
    //     }

    //     return redirect()->route('kapal.index')->with('success', 'Data kapal kapal baru berhasil ditambahkan!');
    // }

    // public function destroy(Request $request)
    // {

    //     $checkedValue = $request->hapus_data;

    //     Kapal::whereIn('FLAG_IDX', $checkedValue)->delete();

    //     return redirect()->route('bendera.index')->with('success', 'Data bendera berhasil dihapus!');
    // }
}
