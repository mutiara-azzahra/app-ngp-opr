<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ownership extends Model
{
    use HasFactory;

    protected $connection = 'third_db';
    protected $table      = 'MKT_OS';
    public $timestamps    = false;

    protected $fillable = [
        'KODE_OS',
        'KODE_KAPAL',
        'CLASS',
        'STATUS',
        'NAMA_PEMILIK_TERDAFTAR',
        'NAMA_PEMILIK_MANFAAT',
        'OPERATOR_KAPAL',
        'OPERATOR_PIHAK_KETIGA',
        'MANAJER_TEKNIS',
        'MANAJER_KOMERSIAL',
        'NPWP',
        'EMAIL',
        'FAX',
        'TELPON',
        'ALAMAT',
        'FLAG_IDX',
        'FLAG_SYSTEM',
        'FLAG_DEFAULT',
        'FLAG_STATUS',
        'FLAG_STATUS0_NAME',
        'FLAG_STATUS0_DATE',
        'FLAG_STATUS1_NAME',
        'FLAG_STATUS2_DATE',
        'LOG_ENTRY_NAME',
        'LOG_ENTRY_DATE',
        'LOG_EDIT_NAME',
        'LOG_EDIT_DATE',
    ];
}
