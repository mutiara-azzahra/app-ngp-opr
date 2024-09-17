<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepairListController extends Controller
{
    public function index(){

        $data = RepairList::paginate(20);
        
        return view('repair-list.index', compact('data'));
    }

    public function create(){
        
        $kapal   = Kapal::where('FLAG_STATUS', 1)->where('KODE_OS', null)->get();
        $bendera = Bendera::where('FLAG_STATUS', 1)->get();

        return view('repair-list.create', compact('kapal', 'bendera'));
    }

    public function store(Request $request){

        $data = RepairList::where('KODE_OS', $request->kode_os)->first();
        $lastest_data = RepairList::where('KODE_OS', $request->kode_os)->get();

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

            $created    = RepairList::create($input);
            
            return redirect()->route('repair-list.index')->with('success','Data kode repair-list baru berhasil ditambahkan!');

            if($created){
                return redirect()->route('repair-list.index')->with('success','Data kode repair-list baru berhasil ditambahkan!');
            } else {
                return redirect()->route('repair-list.create')->with('danger','Maaf! ada data yang belum terisi');
            }
        } else {
            return redirect()->route('repair-list.create')->with('danger','Data kode repair-list sudah ada!');
        }

    }

    public function show($id){

        $data        = RepairList::where('KODE_KAPAL', $id)->first();

        return view('repair-list.show', compact('data'));

    }
    
    public function edit($id){

        $data  = RepairList::where('FLAG_IDX', $id)->first();
        $kapal = Kapal::where('FLAG_STATUS', 1)->get();

        return view('repair-list.edit', compact('data', 'kapal'));
    }

    public function update(Request $request, $id){

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

        try {

            RepairList::where('FLAG_IDX', $id)->update([
                'KODE_OS'                   => $request->kode_os,
                'KODE_KAPAL'                => $request->kode_kapal,
                'CLASS'                     => $request->class,
                'NAMA_PEMILIK_TERDAFTAR'    => $request->nama_pemilik_terdaftar,
                'NAMA_PEMILIK_MANFAAT'      => $request->nama_pemilik_manfaat,
                'OPERATOR_KAPAL'            => $request->operator_kapal,
                'OPERATOR_PIHAK_KETIGA'     => $request->operator_pihak_ketiga,
                'MANAJER_TEKNIS'            => $request->manajer_teknis,
                'MANAJER_KOMERSIAL'         => $request->manajer_komersial,
                'NPWP'                      => $request->npwp,
                'EMAIL'                     => $request->email,
                'FAX'                       => $request->fax,
                'TELPON'                    => $request->telpon,
                'ALAMAT'                    => $request->alamat,
                'LOG_EDIT_NAME'           => Auth::user()->USERNAME,
                'LOG_EDIT_DATE'           => NOW(),
            ]);

            return redirect()->route('repair-list.index')->with('success', 'Data repair-list berhasil diubah!');

        } catch (Exception $e) {

            return redirect()->route('repair-list.edit', $id)->with('danger', 'Terjadi kesalahan saat mengubah data repair-list.');
        }
        
    }

    public function destroy(Request $request){

        $selectedItems = $request->input('selected_items', []);

        try {

            $data = RepairList::whereIn('FLAG_IDX', $selectedItems)->delete();

            return redirect()->route('repair-list.index')->with('success', 'Data Master RepairList berhasil dihapus!');

        } catch (\Exception $e) {

            return redirect()->route('repair-list.index')->with('danger', 'Terjadi kesalahan saat menghapus data Master RepairList.');
        }
        
    }

    public function cetak(Request $request)
    {

        $selectedItems = $request->input('selected_items', []);

        if($request->pilih_cetak == 1){

            return Excel::download(new MasterOwnershipExport($selectedItems), 'data-repair-list.xlsx');

        } else {

            $data   = RepairList::where('FLAG_IDX', $selectedItems)->get();
            $pdf    = PDF::loadView('reports.repair-list', ['data'=>$data]);
            $pdf->setPaper('a4', 'potrait');

            return $pdf->stream('data-repair-list.pdf');
        }

    }
}
