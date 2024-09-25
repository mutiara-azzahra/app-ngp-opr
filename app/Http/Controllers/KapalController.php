<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisKapal;
use App\Models\Kapal;

class KapalController extends Controller
{
    public function index()
    {

        $jenis_kapal = Kapal::all();
        $no = 1;

        return view('kapal.index', compact('kapal', 'no'));
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'KODE_KAPAL'            => 'required',
                'NAMA_KAPAL'            => 'required',
                'CALLSIGN'              => 'required',
                'JENIS_KAPAL'           => 'required',
                'KODE_BENDERA'          => 'required',
                'PANJANG'               => 'required|regex:/^-?\d*(\.\d+)?$/',
                'LEBAR'                 => 'required|regex:/^-?\d*(\.\d+)?$/',
                'TINGGI'                => 'required|regex:/^-?\d*(\.\d+)?$/',
                'DRAFT'                 => 'required|regex:/^-?\d*(\.\d+)?$/',
                'GROSS_TON'             => 'required|regex:/^-?\d*(\.\d+)?$/',
                'DEAD_TON'              => 'required|regex:/^-?\d*(\.\d+)?$/',
                'DISPLACEMENT'          => 'required|regex:/^-?\d*(\.\d+)?$/',
                'JENIS_MESIN'           => 'required',
                'DAYA_MESIN'            => 'required',
                'KECEPATAN_MAX'         => 'required',
                'KAPASITAS_KARGO'       => 'required',
                'KAPASITAS_PENUMPANG'   => 'required',
                'TAHUN_PEMBUATAN'       => 'required',
                'GALANGAN_KAPAL'        => 'required',
                'KLASIFIKASI'           => 'required',
            ],
            [
                'required'  => 'Data :attribute belum diisi',
                'regex'  => 'Data :attribute hanya memuat angka dan "."'
            ]
        );

        $data = Kapal::where('KODE_KAPAL', $request->kode_kapal)->first();
        $lastest_data = Kapal::orderBy('FLAG_IDX', 'desc')->first();

        if (!$data) {

            $input['KODE_KAPAL']            = $request->kode_kapal;
            $input['NAMA_KAPAL']            = $request->nama_kapal;
            $input['CALLSIGN']              = $request->callsign;
            $input['JENIS_KAPAL']           = $request->jenis_kapal;
            $input['KODE_BENDERA']          = $request->kode_bendera;
            $input['PANJANG']               = $request->panjang;
            $input['LEBAR']                 = $request->lebar;
            $input['DRAFT']                 = $request->draft;
            $input['TINGGI']                = $request->tinggi;
            $input['GROSS_TON']             = $request->gross_ton;
            $input['DEAD_TON']              = $request->dead_ton;
            $input['DISPLACEMENT']          = $request->displacement;
            $input['JENIS_MESIN']           = $request->jenis_mesin;
            $input['DAYA_MESIN']            = $request->daya_mesin;
            $input['KECEPATAN_MAX']         = $request->kecepatan_max;
            $input['KAPASITAS_KARGO']       = $request->kapasitas_kargo;
            $input['KAPASITAS_PENUMPANG']   = $request->kapasitas_penumpang;
            $input['TAHUN_PEMBUATAN']       = $request->tahun_pembuatan;
            $input['GALANGAN_KAPAL']        = $request->galangan_kapal;
            $input['KLASIFIKASI']           = $request->klasifikasi;
            $input['NOTE']                  = $request->note;
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

                return redirect()->route('kapal.create')->with('danger', 'Maaf! ada data yang belum terisi');
            }
        } else {

            return redirect()->route('kapal.create')->with('danger', 'Kode kapal sudah ada!');
        }
    }

    public function update(Request $request)
    {

        Kapal::where('KODE_KAPAL', $request->kode_kapal)->update([
            'NAMA_KAPAL'            => $request->nama_kapal,
            'CALLSIGN'              => $request->callsign,
            'JENIS_KAPAL'           => $request->jenis_kapal,
            'KODE_BENDERA'          => $request->kode_bendera,
            'PANJANG'               => $request->panjang,
            'LEBAR'                 => $request->lebar,
            'TINGGI'                => $request->tinggi,
            'DRAFT'                 => $request->draft,
            'GROSS_TON'             => $request->gross_ton,
            'DEAD_TON'              => $request->dead_ton,
            'DISPLACEMENT'          => $request->displacement,
            'JENIS_MESIN'           => $request->jenis_mesin,
            'DAYA_MESIN'            => $request->daya_mesin,
            'KECEPATAN_MAX'         => $request->kecepatan_max,
            'KAPASITAS_KARGO'       => $request->kapasitas_kargo,
            'KAPASITAS_PENUMPANG'   => $request->kapasitas_penumpang,
            'TAHUN_PEMBUATAN'       => $request->tahun_pembuatan,
            'GALANGAN_KAPAL'        => $request->galangan_kapal,
            'KLASIFIKASI'           => $request->klasifikasi,
            'NOTE'                  => $request->note,
            'LOG_EDIT_NAME'         => Auth::user()->USERNAME,
            'LOG_EDIT_DATE'         => Carbon::now(),
        ]);

        return redirect()->route('kapal.index')->with('danger', 'Kode kapal sudah ada!');
    }

    public function destroy(Request $request)
    {

        $checkedValue = $request->input('id');

        Kapal::whereIn('FLAG_IDX', $checkedValue)->delete();
    }
}
