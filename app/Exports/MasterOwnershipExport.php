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

        $this->selectedItems = $selectedItems;

    }

    public function collection()
    {
        return Kapal::where('KODE_KAPAL', $this->selectedItems)->get()->map(function($item){
            $item->no                     = '-';
            $item->kode_os                = $item->KODE_OS;
            $item->kode_kapal             = $item->KODE_KAPAL;
            $item->class                  = $item->CLASS;
            $item->nama_pemilik_terdaftar = $item->NAMA_PEMILIK_TERDAFTAR;
            $item->nama_pemilik_manfaat   = $item->NAMA_PEMILIK_MANFAAT;
            $item->operator_kapal         = $item->OPERATOR_KAPAL;
            $item->manajer_teknis         = $item->MANAJER_TEKNIS;
            $item->manajer_komersial      = $item->MANAJER_KOMERSIAL;
            $item->npwp                   = $item->NPWP;
            $item->email                  = $item->EMAIL;
            $item->fax                    = $item->FAX;
            $item->telpon                 = $item->TELPON;
         
            return $item->only(['no','kode_os','kode_kapal','class','nama_pemilik_terdaftar','nama_pemilik_manfaat','operator_kapal','manajer_teknis',
                'manajer_komersial','npwp','email','fax','telpon']);
        });

    }

    public function headings(): array
    {
        return [
            ['DATA OWNERSHIP KAPAL'],
            [
                ''
            ],
            [
                ''
            ],
            ['NO.','KODE OS','KODE KAPAL','CLASS','NAMA PEMILIK TERDAFTAR','NAMA PEMILIK MANFAAT','OPERATOR KAPAL', 'MANAJER TEKNIS','MANAJER KOMERSIAL','NPWP',
                'EMAIL','FAX','TELPON'],
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