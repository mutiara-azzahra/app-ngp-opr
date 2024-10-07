<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisKapal;
use App\Models\Kapal;
use App\Models\Bendera;


class KapalController extends Controller
{
    public function index()
    {

        $kapal = Kapal::where('FLAG_STATUS', 1)->get();
        $jenis_kapal = JenisKapal::where('FLAG_STATUS', 1)->get();
        $bendera = Bendera::where('FLAG_STATUS', 1)->get();
        $no = 1;

        return view('kapal.index', compact('kapal', 'no', 'jenis_kapal', 'bendera'));
    }

    public function show(Request $request)
    {

        $flag_idx = $request->input('id');
        $data = Kapal::where('FLAG_IDX', $flag_idx)->first();

        if (!$data) {
            return response()->json(['error' => 'Data Kapal tidak ditemukan'], 404);
        }

        return response()->json($data);
    }

    public function edit($id)
    {

        $data = Kapal::where('FLAG_IDX', $id)->first();
        $jenis_kapal = JenisKapal::where('FLAG_STATUS', 1)->get();
        $bendera = Bendera::where('FLAG_STATUS', 1)->get();

        return view('kapal.edit', compact('data', 'jenis_kapal', 'bendera'));
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'kode_kapal'            => 'required',
                'nama_kapal'            => 'required',
                'jenis_kapal'           => 'required',
                'panjang'               => 'required|regex:/^\d*(\.\d*)?$/',
                'lebar'                 => 'required|regex:/^\d*(\.\d*)?$/',
                'tinggi'                => 'required|regex:/^\d*(\.\d*)?$/',
                'draft'                 => 'required|regex:/^\d*(\.\d*)?$/',
                'gross_ton'             => 'required|regex:/^\d*(\.\d*)?$/',
                'dead_ton'              => 'required|regex:/^\d*(\.\d*)?$/',
                'jenis_mesin'           => 'required',
            ],
            [
                'required'  => 'Data :attribute belum diisi',
                'regex'  => 'Data :attribute harus angka dan menggunakan titik "." desimal',
            ]
        );

        $data = Kapal::where('KODE_KAPAL', strtoupper($request->kode_kapal))->first();
        $lastest_data = Kapal::orderBy('FLAG_IDX', 'desc')->first();

        if (!$data) {

            $input['KODE_KAPAL']            = strtoupper($request->kode_kapal);
            $input['NAMA_KAPAL']            = strtoupper($request->nama_kapal);
            $input['CALLSIGN']              = strtoupper($request->callsign);
            $input['JENIS_KAPAL']           = strtoupper($request->jenis_kapal);
            $input['KODE_BENDERA']          = strtoupper($request->kode_bendera);
            $input['PANJANG']               = $request->panjang;
            $input['LEBAR']                 = $request->lebar;
            $input['DRAFT']                 = $request->draft;
            $input['TINGGI']                = $request->tinggi;
            $input['GROSS_TON']             = $request->gross_ton;
            $input['DEAD_TON']              = $request->dead_ton;
            $input['DISPLACEMENT']          = $request->displacement;
            $input['JENIS_MESIN']           = strtoupper($request->jenis_mesin);
            $input['DAYA_MESIN']            = $request->daya_mesin;
            $input['KECEPATAN_MAX']         = $request->kecepatan_maksimal;
            $input['KAPASITAS_KARGO']       = $request->kapasitas_kargo;
            $input['KAPASITAS_PENUMPANG']   = $request->kapasitas_penumpang;
            $input['TAHUN_PEMBUATAN']       = $request->tahun_pembuatan;
            $input['GALANGAN_KAPAL']        = strtoupper($request->galangan_kapal);
            $input['KLASIFIKASI']           = strtoupper($request->klasifikasi);
            if (!$lastest_data) {
                $input['FLAG_IDX']         = 1;
            } else {
                $input['FLAG_IDX']         = $lastest_data->FLAG_IDX + 1;
            }
            $input['LOG_ENTRY_NAME']       = Auth::user()->USERNAME;
            $input['LOG_ENTRY_DATE']       = NOW();

            $created    = Kapal::create($input);

            if ($created) {

                return redirect()->route('kapal.index')->with('success', 'Data kapal kapal baru berhasil ditambahkan!');
            } else {

                return redirect()->route('kapal.index')->with('danger', 'Maaf! ada data yang belum terisi');
            }
        } else {

            return redirect()->route('kapal.index')->with('danger', 'Kode kapal sudah ada!');
        }
    }

    public function update(Request $request)
    {

        // dd($request->all());

        $request->validate(
            [
                'kode_kapal'            => 'required',
                'nama_kapal'            => 'required',
                'jenis_kapal'           => 'required',
                'panjang'               => 'required|regex:/^\d*(\.\d*)?$/',
                'lebar'                 => 'required|regex:/^\d*(\.\d*)?$/',
                'tinggi'                => 'required|regex:/^\d*(\.\d*)?$/',
                'draft'                 => 'required|regex:/^\d*(\.\d*)?$/',
                'gross_ton'             => 'required|regex:/^\d*(\.\d*)?$/',
                'dead_ton'              => 'required|regex:/^\d*(\.\d*)?$/',
                'jenis_mesin'           => 'required',
            ],
            [
                'required'  => 'Data :attribute belum diisi',
                'regex'  => 'Data :attribute harus angka dan menggunakan titik "." desimal',
            ]
        );

        $update = Kapal::where('KODE_KAPAL', $request->kode_kapal)->update([
            'KODE_KAPAL'            => strtoupper($request->kode_kapal),
            'NAMA_KAPAL'            => strtoupper($request->nama_kapal),
            'CALLSIGN'              => strtoupper($request->callsign),
            'JENIS_KAPAL'           => strtoupper($request->jenis_kapal),
            'KODE_BENDERA'          => strtoupper($request->kode_bendera),
            'PANJANG'               => $request->panjang,
            'LEBAR'                 => $request->lebar,
            'TINGGI'                => $request->tinggi,
            'DRAFT'                 => $request->draft,
            'GROSS_TON'             => $request->gross_ton,
            'DEAD_TON'              => $request->dead_ton,
            'DISPLACEMENT'          => $request->displacement,
            'JENIS_MESIN'           => strtoupper($request->jenis_mesin),
            'DAYA_MESIN'            => $request->daya_mesin,
            'KECEPATAN_MAX'         => $request->kecepatan_max,
            'KAPASITAS_KARGO'       => $request->kapasitas_kargo,
            'KAPASITAS_PENUMPANG'   => $request->kapasitas_penumpang,
            'TAHUN_PEMBUATAN'       => $request->tahun_pembuatan,
            'GALANGAN_KAPAL'        => strtoupper($request->galangan_kapal),
            'KLASIFIKASI'           => strtoupper($request->klasifikasi),
            'LOG_EDIT_NAME'         => Auth::user()->USERNAME,
            'LOG_EDIT_DATE'         => Carbon::now(),
        ]);

        if (!$update) {
            return redirect()->route('kapal.index')->with('danger', 'Data kapal kapal baru gagal diubah');
        }

        return redirect()->route('kapal.index')->with('success', 'Data kapal kapal baru berhasil diubah!');
    }

    public function destroy(Request $request)
    {

        $checkedValue = $request->checked_data;

        try {

            Kapal::whereIn('FLAG_IDX', $checkedValue)->delete();

            return response()->json([
                'message' => 'Data terpilih berhasil dihapus',
            ], 200);
        } catch (\Throwable $e) {

            return response()->json(['error' => 'Gagal hapus data'], 500);
        }
    }

    public function print(Request $request)
    {

        $jenis_cetak = $request->jenis_cetak;
        $cetak_data =  $request->checked_data;

        if ($jenis_cetak == 'PDF') {

            try {

                $data = Kapal::whereIn('FLAG_IDX', $cetak_data)->get();

                $pdf = Pdf::loadView('reports.kapal', ['data' => $data]);

                $pdf->setPaper('a4', 'landscape');

                return $pdf->stream('invoice.pdf');

                return response()->json(['message' => 'Berhasil cetak data'], 200);
            } catch (\Throwable $e) {

                return response()->json(['error' => 'Gagal cetak data'], 500);
            }
        }
    }
}
