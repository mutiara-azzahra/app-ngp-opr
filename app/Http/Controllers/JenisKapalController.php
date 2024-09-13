<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
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

        $idx    = JenisKapal::orderBy('FLAG_IDX', 'desc')->first();

        $data   = JenisKapal::where('JENIS_KAPAL', $request->jenis_kapal)->first();

        $request->validate([
            'jenis_kapal' => 'required',
            'g1'          => 'required',
        ],[
            'required'  => 'Data :attribute belum diisi',
            'unique'    => ':attribute sudah ada'
        ]);

        if(!$data){

            $input['JENIS_KAPAL']       = $request->jenis_kapal;
            $input['G1']                = $request->g1;
            $input['FLAG_IDX']          = $idx->FLAG_IDX + 1;
            $input['LOG_ENTRY_DATE']    = NOW();

            $created    = JenisKapal::create($input);
            
            if($created){
                
                return redirect()->route('jenis-kapal.index')->with('success','Data jenis kapal baru berhasil ditambahkan!');

            } else {
                
                return redirect()->route('jenis-kapal.create')->with('danger','Maaf! ada data yang belum terisi');

            }

        } else {

            return redirect()->route('jenis-kapal.create')->with('danger','Data jenis kapal sudah terdaftar!');

        }
        
    }
    
    public function edit($id){

        $data = JenisKapal::where('FLAG_IDX', $id)->first();

        return view('jenis-kapal.edit', compact('data'));
    }

    public function update(Request $request, $id){

        $request->validate([
            'jenis_kapal'  => 'required',
            'g1'           => 'required',
        ]);

        try {

            JenisKapal::where('FLAG_IDX', $id)->update([
                'JENIS_KAPAL'       => $request->jenis_kapal,
                'G1'                => $request->g1,
                'NOTE'              => $request->note,
                'LOG_EDIT_DATE'     => Carbon::now(),
                'LOG_EDIT_NAME'     => Auth::user()->USERNAME
            ]);

            return redirect()->route('jenis-kapal.index')->with('success', 'Data jenis kapal berhasil diubah!');

        } catch (\Exception $e) {

            return redirect()->route('jenis-kapal.edit', $id)->with('danger', 'Terjadi kesalahan saat mengubah data jenis kapal.');
        }

    }

    public function destroy(Request $request){

        dd($request->all());

        $selectedItems = $request->input('selected_items', []);

        try {
                $data = JenisKapal::whereIn('JENIS_KAPAL', $selectedItems)->delete();

            return redirect()->route('jenis-kapal.index')->with('success', 'Data Master Kapal berhasil dihapus!');

        } catch (\Exception $e) {

            return redirect()->route('jenis-kapal.index')->with('danger', 'Terjadi kesalahan saat menghapus data Master Kapal.');
        }
        
    }
}

