<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Kapal;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class MasterKapalExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $selectedItems;

    public function __construct($selectedItems)
    {
        dd($selectedItems);
        $this->selectedItems = $selectedItems;

    }

    public function collection()
    {
        return Kapal::where('KODE_KAPAL', $this->selectedItems)->get()->map(function($item){
            $item->no                  = '-';
            $item->kode_kapal          = $item->KODE_KAPAL;
            $item->nama_kapal          = $item->NAMA_KAPAL;
            $item->callsign            = $item->CALLSIGN;
            $item->jenis_kapal         = $item->jenis_kapal->JENIS_KAPAL;
            $item->kode_bendera        = $item->bendera->KODE_BENDERA.'/'.$item->bendera->ASAL_NEGARA;
            $item->panjang             = $item->PANJANG;
            $item->lebar               = $item->LEBAR;
            $item->draft               = $item->DRAFT;
            $item->tinggi              = $item->TINGGI;
            $item->gross_ton           = $item->GROSS_TON;
            $item->dead_ton            = $item->DEAD_TON;
            $item->displacement        = $item->DISPLACEMENT;
            $item->jenis_mesin         = $item->JENIS_MESIN;
            $item->daya_mesin          = $item->DAYA_MESIN;
            $item->kecepatan_max       = $item->KECEPATAN_MAX;
            $item->kapasitas_kargo     = $item->KAPASITAS_KARGO;
            $item->kapasitas_penumpang = $item->KAPASITAS_PENUMPANG;
            $item->tahun_pembuatan     = $item->TAHUN_PEMBUATAN;
            $item->galangan_kapal      = $item->GALANGAN_KAPAL;
            $item->klasifikasi         = $item->KLASIFIKASI;
         
            return $item->only(['no','kode_kapal','nama_kapal',
                'callsign','jenis_kapal','kode_bendera','panjang','lebar',
                'draft','tinggi','gross_ton',
                'dead_ton','displacement','jenis_mesin', 
                'daya_mesin', 'kecepatan_max', 'kapasitas_kargo', 'kapasitas_penumpang', 'tahun_pembuatan', 'galangan_kapal', 'klasifikasi']);
        });
    }

    public function headings(): array
    {
        return [
            ['DATA KAPAL'],
            [
                ''
            ],
            [
                ''
            ],
            ['NO.','KODE KAPAL','NAMA KAPAL','CALLSIGN','JENIS KAPAL','BENDERA','PANJANG', 'LEBAR','DRAFT','TINGGI',
                'GROSS TON','DEAD TON','DISPLACEMENT','JENIS MESIN', 'DAYA MESIN', 'KECEPATAN MAX', 'KAPASITAS KARGO',
                'KAPASITAS PENUMPANG', 'TAHUN PEMBUATAN', 'GALANGAN KAPAL', 'KLASIFIKASI'],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $count = $this->collection()->count();
        $count = $count + 5;
        $cell   = 'A4:N' . $count;

        $sheet->mergeCells('A1:N1');
        $sheet->mergeCells('A2:N2');
        
        $sheet->getStyle('A1:N1')->applyFromArray(['aligment' => ['horizontal' => 'center']]);
        $sheet->getStyle('A2:N2')->applyFromArray(['aligment' => ['horizontal' => 'center']]);

        $sheet->getStyle('A4:N4')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('F07470');

        return [
            $cell => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ]
                ]
            ],
        ];
    }
}