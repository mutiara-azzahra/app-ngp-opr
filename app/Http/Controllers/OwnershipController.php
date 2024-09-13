<?php

namespace App\Http\Controllers;

use Auth;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Kapal;
use App\Models\JenisKapal;
use App\Models\Bendera;
use App\Models\Ownership;

class OwnershipController extends Controller
{
    public function index(){

        $data = Ownership::paginate(20);
        
        return view('ownership.index', compact('data'));
    }

    public function create(){
        
        $kapal = Kapal::where('FLAG_STATUS', 1)->get();
        $bendera = Bendera::where('FLAG_STATUS', 1)->get();

        return view('ownership.create', compact('kapal', 'bendera'));
    }

    public function store(Request $request){

        $data = Ownership::where('KODE_OS', $request->kode_os)->first();
        $lastest_data = Ownership::where('KODE_OS', $request->kode_os)->get();

        $request->validate([
            'kode_os'                 => 'required',
            'kode_kapal'              => 'required',
            'class'                   => 'required',
            'nama_pemilik_terdaftar'  => 'required',
            'nama_pemilik_manfaat'    => 'required',
            'operator_kapal'          => 'required',
            'operator_pihak_ketiga'   => 'required',
            'manajer_teknis'          => 'required',
            'manajer_komersial'       => 'required',
            'npwp'                    => 'required|min:15|max:16',
            'email'                   => 'required', 
            'fax'                     => 'required',
            'telpon'                  => 'required',
            'alamat'                  => 'required',
        ],
        [
            'required'         => 'Data :attribute belum diisi',
            'min'              => 'NPWP minimal 15 digit angka',
            'max'              => 'NPWP maksimal 16 digit angka'
        ]);

        if(!$data){

            $input['KODE_OS']                   = $request->kode_os;
            $input['KODE_KAPAL']                = $request->kode_kapal;
            $input['CLASS']                     = $request->class;
            $input['NAMA_PEMILIK_TERDAFTAR']    = $request->nama_pemilik_terdaftar;
            $input['NAMA_PEMILIK_MANFAAT']      = $request->nama_pemilik_manfaat;
            $input['OPERATOR_KAPAL']            = $request->operator_kapal;
            $input['OPERATOR_PIHAK_KETIGA']     = $request->operator_pihak_ketiga;
            $input['MANAJER_TEKNIS']            = $request->manajer_teknis;
            $input['MANAJER_KOMERSIAL']         = $request->manajer_komersial;
            $input['NPWP']                      = $request->npwp;
            $input['EMAIL']                     = $request->email;
            $input['FAX']                       = $request->fax;
            $input['TELPON']                    = $request->telpon;
            $input['ALAMAT']                    = $request->alamat;
            if(!$lastest_data){
                $input['FLAG_IDX']              = $lastest_data->FLAG_IDX + 1;
            } else {
                $input['FLAG_IDX']              = 1;
            }
            $input['FLAG_STATUS1_NAME']         = Auth::user()->USERNAME;
            $input['FLAG_STATUS1_DATE']         = NOW();

            $created    = Ownership::create($input);
            
            return redirect()->route('ownership.index')->with('success','Data kode ownership baru berhasil ditambahkan!');

            if($created){
                
                return redirect()->route('ownership.index')->with('success','Data kode ownership baru berhasil ditambahkan!');

            } else {
                
                return redirect()->route('ownership.create')->with('danger','Maaf! ada data yang belum terisi');

            }

        } else {

            return redirect()->route('ownership.create')->with('danger','Data kode ownership sudah ada!');

        }

    }

    public function show($id){

        $data        = Ownership::where('KODE_KAPAL', $id)->first();

        return view('ownership.show', compact('data'));

    }
    
    public function edit($id){

        $data        = Ownership::where('KODE_KAPAL', $id)->first();
        $jenis_kapal = JenisKapal::where('FLAG_STATUS', 1)->get();
        $bendera     = Bendera::where('FLAG_STATUS', 1)->get();

        return view('ownership.edit', compact('data', 'jenis_kapal', 'bendera'));
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

            Ownership::where('KODE_KAPAL', $id)->update([
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

            return redirect()->route('ownership.index')->with('success', 'Data ownership berhasil diubah!');

        } catch (\Exception $e) {

            return redirect()->route('ownership.edit', $id)->with('danger', 'Terjadi kesalahan saat mengubah data ownership.');
        }

        
    }

    public function destroy(Request $request){

        $selectedItems = $request->input('selected_items', []);

        try {
                $data = Ownership::whereIn('KODE_KAPAL', $selectedItems)->delete();

            return redirect()->route('ownership.index')->with('success', 'Data Master Ownership berhasil dihapus!');

        } catch (Throwable $e) {

            return redirect()->route('ownership.index')->with('danger', 'Terjadi kesalahan saat menghapus data Master Ownership.');
        }
        
    }

    public function cetak(Request $request)
    {

        $selectedItems = $request->input('selected_items', []);

        if($request->pilih_cetak == 1){

            return Excel::download(new MasterKapalExport($selectedItems), 'data-ownership.xlsx');

        } else {

            $data   = Ownership::where('KODE_KAPAL', $selectedItems)->get();
            $pdf    = PDF::loadView('reports.ownership', ['data'=>$data]);
            $pdf->setPaper('a4', 'potrait');

            return $pdf->stream('data-ownership.pdf');
        }

    }
}
