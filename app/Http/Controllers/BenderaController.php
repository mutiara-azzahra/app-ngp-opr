<?php

namespace App\Http\Controllers;

use Auth;
use PDF;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
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

        $request->validate([
            'kode_bendera'        => 'required',
            'asal_negara'         => 'required',
        ],
        [
            'required'  => 'Data :attribute belum diisi'
        ]);   
        
        $data = Bendera::where('KODE_BENDERA', $request->kode_bendera)->first();
        $lastest_data = Bendera::orderBy('FLAG_IDX', 'desc')->get();

        if(!$data){

            $input['KODE_BENDERA']          = $request->kode_bendera;
            $input['ASAL_NEGARA']           = $request->asal_negara;
            $input['NOTE']                  = $request->note;
            if(!$lastest_data){
                $input['FLAG_IDX']           = $lastest_data->FLAG_IDX + 1;
            } else {
                $input['FLAG_IDX']           = 1;
            }
            $input['LOG_ENTRY_NAME']         = Auth::user()->USERNAME;
            $input['LOG_ENTRY_DATE']         = NOW();
            

            $created    = Bendera::create($input);

            if($created){
                
                return redirect()->route('bendera.index')->with('success','Data bendera kapal baru berhasil ditambahkan!');

            } else {
                
                return redirect()->route('bendera.create')->with('danger','Maaf! ada data yang belum terisi');

            }

        } else {

            return redirect()->route('bendera.create')->with('danger','Kode bendera sudah ada!');

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

    public function print(Request $request)
    {

        $selectedItems = $request->input('selected_items', []);

        if($request->pilih_cetak == 1){

            return Excel::download(new MasterKapalExport($selectedItems), 'data-kapal.xlsx');

        } else {

            $data   = Kapal::where('KODE_KAPAL', $selectedItems)->get();
            $pdf    = PDF::loadView('reports.bendera', ['data'=>$data]);
            $pdf->setPaper('a4', 'potrait');

            return $pdf->stream('data-bendera.pdf');
        }

    }
}
