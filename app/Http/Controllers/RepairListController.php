<?php

namespace App\Http\Controllers;

use Auth;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\RepairList;
use App\Models\JenisKapal;
use App\Exports\RepairListExport;
use Maatwebsite\Excel\Facades\Excel;

class RepairListController extends Controller
{
    public function index(){

        $data = RepairList::paginate(20);
        
        return view('repair-list.index', compact('data'));
    }

    public function create(){
        
        $jenis_kapal   = JenisKapal::where('FLAG_STATUS', 1)->get();

        return view('repair-list.create', compact('jenis_kapal'));
    }

    public function store(Request $request){

        $data         = RepairList::where('KODE_REPAIR_LIST', $request->kode_repair_list)->first();
        $lastest_data = RepairList::where('KODE_REPAIR_LIST', $request->kode_repair_list)->get();

        $request->validate([
            'kode_repair_list'      => 'required',
            'jenis_kapal'           => 'required',
            'bagian_kapal'          => 'required',
            'jenis_perbaikan'       => 'required',
            'deskripsi'             => 'required',
            'interval_waktu_hari'   => 'required',
            'hpp'                   => 'required',
            'satuan'                => 'required',
        ],
        [
            'required'  => 'Data :attribute belum diisi',
        ]);

        if(!$data){

            $input['KODE_REPAIR_LIST']          = $request->kode_os;
            $input['JENIS_KAPAL']               = $request->kode_kapal;
            $input['BAGIAN_KAPAL']              = $request->bagian_kapal;
            $input['JENIS_PERBAIKAN']           = $request->jenis_perbaikan;
            $input['DESKRIPSI']                 = $request->deskripsi;
            $input['INTERVAL_WAKTU_HARI']       = $request->interval_waktu_hari;
            $input['HPP']                       = $request->hpp;
            $input['SATUAN']                    = $request->satuan;
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
            'kode_repair_list'      => 'required',
            'kode_jenis_kapal'      => 'required',
            'bagian_kapal'          => 'required',
            'jenis_perbaikan'       => 'required',
            'deskripsi'             => 'required',
            'satuan'                => 'required',
            'interval_waktu_hari'   => 'required',
            'hpp'                   => 'required',
        ],
        [
            'required'  => 'Data :attribute belum diisi'
        ]);

        try {

            RepairList::where('FLAG_IDX', $id)->update([
                'KODE_REPAIR_LIST'      => $request->kode_os,
                'KODE_JENIS_KAPAL'      => $request->kode_kapal,
                'BAGIAN_KAPAL'          => $request->bagian_kapal,
                'JENIS_PERBAIKAN'       => $request->jenis_perbaikan,
                'DESKRIPSI'             => $request->deskripsi,
                'SATUAN'                => $request->satuan,
                'INTERVAL_WAKTU_HARI'   => $request->interval_waktu_hari,
                'HPP'                   => $request->hpp,
                'LOG_EDIT_NAME'         => Auth::user()->USERNAME,
                'LOG_EDIT_DATE'         => NOW(),
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
