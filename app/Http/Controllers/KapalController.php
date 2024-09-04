<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kapal;
use App\Models\JenisKapal;
use App\Models\Bendera;

class KapalController extends Controller
{
    public function index(){

        $data = Kapal::paginate(20);
        
        return view('kapal.index', compact('data'));
    }

    public function create(){

        $jenis_kapal = JenisKapal::where('FLAG_STATUS', 1)->get();
        $bendera = Bendera::where('FLAG_STATUS', 1)->get();

        return view('kapal.create', compact('jenis_kapal'));
    }

    public function store(Request $request){

        $data = Kapal::where('KODE_KAPAL', $request->kode_kapal)->first();

        // dd($request->all());

        $request->validate([
            'kode_kapal'          => 'required',
            'nama_kapal'          => 'required',
            'callsign'            => 'required',
            'kode_bendera'        => 'required',
            'jenis_kapal'         => 'required',
            'panjang'             => 'required',
            'lebar'               => 'required',
            'draft'               => 'required',
            'tinggi'              => 'required',
            'gross_ton'           => 'required',
            'dead_ton'            => 'required', 
            'displacement'        => 'required',
            'jenis_mesin'         => 'required',
            'daya_mesin'          => 'required',
            'kecepatan_max'       => 'required',
            'kapasitas_kargo'     => 'required',
            'kapasitas_penumpang' => 'required',
            'tahun_pembuatan'     => 'required',
            'galangan_kapal'      => 'required',
            'klasifikasi'         => 'required',
        ],
        [
            'required'  => 'Data :attribute belum diisi',
            'unique'    => ':attribute sudah ada'
        ]
    
    );    

        if($data === null){

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

            $created    = Kapal::create($input);
            
            return redirect()->route('kapal.index')->with('success','Data kode kapal baru berhasil ditambahkan!');

            if($created){
                
                return redirect()->route('kapal.index')->with('success','Data kode kapal baru berhasil ditambahkan!');

            } else {
                
                return redirect()->route('kapal.create')->with('danger','Maaf! ada data yang belum terisi');

            }

        } else {

            dd('test');

            return redirect()->route('kapal.create')->with('danger','Data kode kapal sudah ada!');

        }

    }
    
    public function edit($id){

        $data = Kapal::where('KODE_KAPAL', $id)->first();

        return view('kapal.edit', compact('data'));
    }

    public function update($id){

        
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
}
