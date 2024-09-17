<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactPerson;
use App\Models\Kapal;
use App\Models\Bendera;

class ContactPersonController extends Controller
{
    public function index(){

        $data = ContactPerson::paginate(20);
        
        return view('contact-person.index', compact('data'));
    }

    public function create(){
        
        return view('contact-person.create');
    }

    public function store(Request $request){

        $data         = ContactPerson::where('KODE_CP', $request->kode_cp)->first();
        $lastest_data = ContactPerson::orderBy('FLAG_IDX', 'desc')->first();

        $request->validate([
            'nik'              => 'required|min:15|max:16',
            'kode_cp'          => 'required',
            'nama_cp'          => 'required',
            'tempat_lahir'     => 'required',
            'tanggal_lahir'    => 'required',
            'email'            => 'required',
            'telp1'            => 'required',
            'alamat1'          => 'required',
        ],
        [
            'required'         => 'Data :attribute belum diisi',
            'min'              => 'NPWP minimal 15 digit angka',
            'max'              => 'NPWP maksimal 16 digit angka'
        ]);

        if(!$data){

            $input['NIK']               = $request->nik;
            $input['KODE_CP']           = $request->kode_cp;
            $input['NAMA_CP']           = $request->nama_cp;
            $input['ALIAS']             = $request->alias;
            $input['TEMPAT_LAHIR']      = $request->tempat_lahir;
            $input['TANGGAL_LAHIR']     = $request->tanggal_lahir;
            $input['EMAIL']             = $request->email;
            $input['TELP2']             = $request->telp2;
            $input['ALAMAT2']           = $request->alamat2;
            $input['KELURAHAN2']        = $request->kelurahan2;
            $input['KECAMATAN2']        = $request->kecamatan2;
            $input['KOTA2']             = $request->kota2;
            $input['PROVINSI2']         = $request->provinsi2;
            $input['NEGARA2']           = $request->negara2;
            $input['KODEPOS']           = $request->kodepos2;
            if(!$lastest_data){
                $input['FLAG_IDX']      = $lastest_data->FLAG_IDX + 1;
            } else {
                $input['FLAG_IDX']      = 1;
            }
            $input['LOG_ENTRY_NAME']    = Auth::user()->USERNAME;
            $input['LOG_ENTRY_DATE']    = NOW();

            $created    = ContactPerson::create($input);
            
            return redirect()->route('contact-person.index')->with('success','Data kode contact-person baru berhasil ditambahkan!');

            if($created){
                return redirect()->route('contact-person.index')->with('success','Data kode contact-person baru berhasil ditambahkan!');
            } else {
                return redirect()->route('contact-person.create')->with('danger','Maaf! ada data yang belum terisi');
            }
        } else {
            return redirect()->route('contact-person.create')->with('danger','Data kode contact-person sudah ada!');
        }

    }

    public function show($id){

        $data        = ContactPerson::where('KODE_KAPAL', $id)->first();

        return view('contact-person.show', compact('data'));

    }
    
    public function edit($id){

        $data  = ContactPerson::where('FLAG_IDX', $id)->first();
        $kapal = Kapal::where('FLAG_STATUS', 1)->get();

        return view('contact-person.edit', compact('data', 'kapal'));
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

            ContactPerson::where('FLAG_IDX', $id)->update([
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

            return redirect()->route('contact-person.index')->with('success', 'Data contact-person berhasil diubah!');

        } catch (Exception $e) {

            return redirect()->route('contact-person.edit', $id)->with('danger', 'Terjadi kesalahan saat mengubah data contact-person.');
        }
        
    }

    public function destroy(Request $request){

        $selectedItems = $request->input('selected_items', []);

        try {

            $data = ContactPerson::whereIn('FLAG_IDX', $selectedItems)->delete();

            return redirect()->route('contact-person.index')->with('success', 'Data Master ContactPerson berhasil dihapus!');

        } catch (\Exception $e) {

            return redirect()->route('contact-person.index')->with('danger', 'Terjadi kesalahan saat menghapus data Master ContactPerson.');
        }
        
    }

    public function cetak(Request $request)
    {

        $selectedItems = $request->input('selected_items', []);

        if($request->pilih_cetak == 1){

            return Excel::download(new MasterOwnershipExport($selectedItems), 'data-contact-person.xlsx');

        } else {

            $data   = ContactPerson::where('FLAG_IDX', $selectedItems)->get();
            $pdf    = PDF::loadView('reports.contact-person', ['data'=>$data]);
            $pdf->setPaper('a4', 'potrait');

            return $pdf->stream('data-contact-person.pdf');
        }

    }
}
