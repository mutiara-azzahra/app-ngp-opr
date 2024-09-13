<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bendera;

class BenderaController extends Controller
{
    public function index(){

        $data = Bendera::paginate(20);
        
        return view('bendera.index', compact('data'));
    }

    public function create(){

        return view('bendera.create');
    }

    public function store(Request $request){

        $data = Bendera::where('KODE_BENDERA', $request->KODE_BENDERA)->first();

        $request->validate([
            'kode_bendera'        => 'required',
            'asal_negara'         => 'required',
        ],
        [
            'required'  => 'Data :attribute belum diisi',
        ]
    
    );    

        if($data === null){

            $input['KODE_BENDERA']          = $request->kode_bendera;
            $input['ASAL_NEGARA']           = $request->asal_negara;
            $input['NOTE']                  = $request->note;

            $created    = Bendera::create($input);

            if($created){
                
                return redirect()->route('bendera.index')->with('success','Data bendera kapal baru berhasil ditambahkan!');

            } else {
                
                return redirect()->route('bendera.create')->with('danger','Maaf! ada data yang belum terisi');

            }

        } else {

            return redirect()->route('bendera.create')->with('danger','Data bendera kapal sudah ada!');

        }

    }
    
    public function edit($id){

        $data = Bendera::where('KODE_BENDERA', $id)->first();

        return view('bendera.edit', compact('data'));
    }

    public function update($id){

        
    }

    public function destroy(Request $request){

        $selectedItems = $request->input('selected_items', []);

        try {
            
            $data = Bendera::whereIn('FLAG_IDX', $selectedItems)->delete();

            return redirect()->route('bendera.index')->with('success', 'Data Master Kapal berhasil dihapus!');

        } catch (\Exception $e) {

            return redirect()->route('bendera.index')->with('danger', 'Terjadi kesalahan saat menghapus data Master Kapal.');
        }
        
    }
}
