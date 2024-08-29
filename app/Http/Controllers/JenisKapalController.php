<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisKapal;

class JenisKapalController extends Controller
{
    public function index(){

        $data = JenisKapal::paginate(10);
        
        return view('jenis-kapal.index', compact('data'));
    }

    public function create(){

        return view('jenis-kapal.create');
    }

    public function store(Request $request){    

        $idx    = JenisKapal::orderBy('FLAG_IDX')->first();
        // $data   = JenisKapal::where('JENIS_KAPAL', $request->jenis_kapal)->first();

        dd($data);

        $request->validate([
            'jenis_kapal' => 'required',
            'G1'          => 'required',
        ]);

        if($data === null){

            $input['JENIS_KAPAL']       = $request->jenis_kapal;
            $input['G1']                = $request->G1;
            $input['FLAG_IDX']          = $idx->flag_idx + 1;
            $input['LOG_ENTRY_DATA']    = NOW();

            $created    = JenisKapal::create($input);
            
            return redirect()->route('jenis-kapal.create')->with('success','Data jenis kapal baru berhasil ditambahkan!');

        } else {

            return redirect()->route('jenis-kapal.create')->with('danger','Data jenis kapal sudah terdaftar!');

        }
        

    }
    
    public function edit($id){

        $data = Kapal::where('KODE_KAPAL', $id)->first();

        return view('jenis-kapal.edit', compact('data'));
    }

    public function update($id){

        
    }

    public function destroy(Request $request){

        $selectedItems = $request->input('selected_items', []);

        try {
                $data = Kapal::whereIn('JENIS_KAPAL', $selectedItems)->delete();

            return redirect()->route('jenis-kapal.index')->with('success', 'Data Master Kapal berhasil dihapus!');

        } catch (Throwable $e) {

            return redirect()->route('jenis-kapal.index')->with('danger', 'Terjadi kesalahan saat menghapus data Master Kapal.');
        }
        
    }
}

