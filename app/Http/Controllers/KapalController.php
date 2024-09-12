<?php

namespace App\Http\Controllers;

use Auth;
use PDF;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Exports\MasterKapalExport;
use App\Models\Kapal;
use App\Models\JenisKapal;
use App\Models\Bendera;



class KapalController extends Controller
{
    public function index(){

        $data = Kapal::paginate(20);
        $user = Auth::user()->USERNAME;
        
        return view('kapal.index', compact('data', 'user'));
    }

    public function create(){

        $jenis_kapal = JenisKapal::where('FLAG_STATUS', 1)->get();
        $bendera = Bendera::where('FLAG_STATUS', 1)->get();

        return view('kapal.create', compact('jenis_kapal', 'bendera'));
    }

    public function store(Request $request){

        $data = Kapal::where('KODE_KAPAL', $request->kode_kapal)->first();

        $request->validate([
            'kode_kapal'          => 'required',
            'nama_kapal'          => 'required',
            'callsign'            => 'required',
            'kode_bendera'        => 'required',
            'jenis_kapal'         => 'required',
            'panjang'             => 'required|regex:/^\d*(\.\d*)?$/',
            'lebar'               => 'required|regex:/^\d*(\.\d*)?$/',
            'draft'               => 'required|regex:/^\d*(\.\d*)?$/',
            'tinggi'              => 'required|regex:/^\d*(\.\d*)?$/',
            'gross_ton'           => 'required|regex:/^\d*(\.\d*)?$/',
            'dead_ton'            => 'required|regex:/^\d*(\.\d*)?$/', 
            'displacement'        => 'required|regex:/^\d*(\.\d*)?$/',
            'jenis_mesin'         => 'required|regex:/^\d*(\.\d*)?$/',
            'daya_mesin'          => 'required|regex:/^\d*(\.\d*)?$/',
            'kecepatan_max'       => 'required|regex:/^\d*(\.\d*)?$/',
            'kapasitas_kargo'     => 'required|regex:/^\d*(\.\d*)?$/',
            'kapasitas_penumpang' => 'required|regex:/^\d*(\.\d*)?$/',
            'galangan_kapal'      => 'required',
            'klasifikasi'         => 'required',
            'tahun_pembuatan'     => 'required',
        ],
        [
            'required'                  => 'Data :attribute belum diisi',
            'unique'                    => ':attribute sudah ada',
            'panjang.regex'             => 'Format :attribute tidak valid',
            'lebar.regex'               => 'Format :attribute tidak valid',
            'tinggi.regex'              => 'Format :attribute tidak valid',
            'gross_ton.regex'           => 'Format :attribute tidak valid',
            'dead_ton.regex'            => 'Format :attribute tidak valid',
            'displacement.regex'        => 'Format :attribute tidak valid',
            'jenis_mesin.regex'         => 'Format :attribute tidak valid',
            'daya_mesin.regex'          => 'Format :attribute tidak valid',
            'kecepatan_max.regex'       => 'Format :attribute tidak valid',
            'kapasitas_kargo.regex'     => 'Format :attribute tidak valid',
            'kapasitas_penumpang.regex' => 'Format :attribute tidak valid'
        ]
    
    );

        if(!$data){

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
            $input['GALANGAN_KAPAL']        = $request->galangan_kapal;
            $input['KLASIFIKASI']           = $request->klasifikasi;
            $input['TAHUN_PEMBUATAN']       = $request->tahun_pembuatan;

            $created    = Kapal::create($input);
            
            return redirect()->route('kapal.index')->with('success','Data kode kapal baru berhasil ditambahkan!');

            if($created){
                
                return redirect()->route('kapal.index')->with('success','Data kode kapal baru berhasil ditambahkan!');

            } else {
                
                return redirect()->route('kapal.create')->with('danger','Maaf! ada data yang belum terisi');

            }

        } else {

            return redirect()->route('kapal.create')->with('danger','Data kode kapal sudah ada!');

        }

    }

    public function show($id){

        $data        = Kapal::where('KODE_KAPAL', $id)->first();

        return view('kapal.show', compact('data'));

    }
    
    public function edit($id){

        $data        = Kapal::where('KODE_KAPAL', $id)->first();
        $jenis_kapal = JenisKapal::where('FLAG_STATUS', 1)->get();
        $bendera     = Bendera::where('FLAG_STATUS', 1)->get();

        return view('kapal.edit', compact('data', 'jenis_kapal', 'bendera'));
    }

    public function update(Request $request, $id){

        $request->validate([
            'kode_kapal'          => 'required',
            'nama_kapal'          => 'required',
            'callsign'            => 'required',
            'kode_bendera'        => 'required',
            'jenis_kapal'         => 'required',
            'panjang'             => 'required|regex:/^\d*(\.\d*)?$/',
            'lebar'               => 'required|regex:/^\d*(\.\d*)?$/',
            'draft'               => 'required|regex:/^\d*(\.\d*)?$/',
            'tinggi'              => 'required|regex:/^\d*(\.\d*)?$/',
            'gross_ton'           => 'required|regex:/^\d*(\.\d*)?$/',
            'dead_ton'            => 'required|regex:/^\d*(\.\d*)?$/', 
            'displacement'        => 'required|regex:/^\d*(\.\d*)?$/',
            'jenis_mesin'         => 'required|regex:/^\d*(\.\d*)?$/',
            'daya_mesin'          => 'required|regex:/^\d*(\.\d*)?$/',
            'kecepatan_max'       => 'required|regex:/^\d*(\.\d*)?$/',
            'kapasitas_kargo'     => 'required|regex:/^\d*(\.\d*)?$/',
            'kapasitas_penumpang' => 'required|regex:/^\d*(\.\d*)?$/',
            'galangan_kapal'      => 'required',
            'klasifikasi'         => 'required',
            'tahun_pembuatan'     => 'required',
        ],
        [
            'required'                  => 'Data :attribute belum diisi',
            'unique'                    => ':attribute sudah ada',
            'panjang.regex'             => 'Format :attribute tidak valid',
            'lebar.regex'               => 'Format :attribute tidak valid',
            'tinggi.regex'              => 'Format :attribute tidak valid',
            'gross_ton.regex'           => 'Format :attribute tidak valid',
            'dead_ton.regex'            => 'Format :attribute tidak valid',
            'displacement.regex'        => 'Format :attribute tidak valid',
            'jenis_mesin.regex'         => 'Format :attribute tidak valid',
            'daya_mesin.regex'          => 'Format :attribute tidak valid',
            'kecepatan_max.regex'       => 'Format :attribute tidak valid',
            'kapasitas_kargo.regex'     => 'Format :attribute tidak valid',
            'kapasitas_penumpang.regex' => 'Format :attribute tidak valid'
        ]
    
    );

        try {

            Kapal::where('KODE_KAPAL', $id)->update([
                'NAMA_KAPAL'          => $request->nama_kapal,
                'CALLSIGN'            => $request->callsign,
                'JENIS_KAPAL'         => $request->jenis_kapal,
                'KODE_BENDERA'        => $request->kode_bendera,
                'PANJANG'             => $request->panjang,
                'LEBAR'               => $request->lebar,
                'DRAFT'               => $request->draft,
                'TINGGI'              => $request->tinggi,
                'GROSS_TON'           => $request->gross_ton,
                'DEAD_TON'            => $request->dead_ton,
                'DISPLACEMENT'        => $request->displacement,
                'JENIS_MESIN'         => $request->jenis_mesin,
                'DAYA_MESIN'          => $request->daya_mesin,
                'KECEPATAN_MAX'       => $request->kecepatan_max,
                'KAPASITAS_KARGO'     => $request->kapasitas_kargo,
                'KAPASITAS_PENUMPANG' => $request->kapasitas_penumpang,
                'TAHUN_PEMBUATAN'     => $request->tahun_pembuatan,
                'GALANGAN_KAPAL'      => $request->galangan_kapal,
                'KLASIFIKASI'         => $request->klasifikasi,
            ]);

            return redirect()->route('kapal.index')->with('success', 'Data kapal berhasil diubah!');

        } catch (\Exception $e) {

            return redirect()->route('kapal.edit', $id)->with('danger', 'Terjadi kesalahan saat mengubah data kapal.');
        }

        
    }

    public function destroy(Request $request){

        $selectedItems = $request->input('selected_items', []);

        try {
                $data = Kapal::whereIn('KODE_KAPAL', $selectedItems)->delete();

            return redirect()->route('kapal.index')->with('success', 'Data Master Kapal berhasil dihapus!');

        } catch (Throwable $e) {

            return redirect()->route('kapal.index')->with('danger', 'Terjadi kesalahan saat menghapus data Master Kapal.');
        }
        
    }

    public function cetak(Request $request)
    {

        $selectedItems = $request->input('selected_items', []);

        if($request->pilih_cetak == 1){

            return Excel::download(new MasterKapalExport($selectedItems), 'data-kapal.xlsx');

        } else {

            $data   = Kapal::where('KODE_KAPAL', $selectedItems)->get();
            $pdf    = PDF::loadView('reports.kapal', ['data'=>$data]);
            $pdf->setPaper('a4', 'potrait');

            return $pdf->stream('data-kapal.pdf');
        }

    }

}
