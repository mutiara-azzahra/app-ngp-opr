<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    use HasFactory;

    protected $connection = 'third_db';
    protected $table      = 'MKT_CP';
    public $timestamps    = false;

    protected $fillable = [
        'KODE_CP',
        'NAMA_CP',
        'ALIAS',
        'GENDER',
        'GOL_DARAH',
        'AGAMA',
        'WARGANEGARA',
        'STATUS_PERKAWINAN',
        'TANGGAL_LAHIR',
        'TEMPAT_LAHIR',
        'KOTA_LAHIR',
        'PROVINSI_LAHIR',
        'NEGARA_LAHIR',
        'PH1',
        'PH2',
        'EMAIL',
        'NOTE_CP',
        'ALAMAT1',
        'KELURAHAN1',
        'KECAMATAN1',
        'KOTA1',
        'PROVINSI1',
        'NEGARA1',
        'KODEPOS1',
        'TELP1',
        'STATUS_ADDR1',
        'NOTE_ADDR1',
        'ALAMAT2',
        'KELURAHAN2',
        'KECAMATAN2',
        'KOTA2',
        'PROVINSI2',
        'NEGARA2',
        'KODEPOS2',
        'TELP2',
        'STATUS_ADDR2',
        'NOTE_ADDR2',
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
