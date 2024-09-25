<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kapal extends Model
{
    use HasFactory;

    protected $connection = 'third_db';
    protected $table      = 'REF_JENIS_KAPAL';
    public $timestamps    = false;

    protected $fillable = [
        'KODE_KAPAL',
        'NAMA_KAPAL',
        'CALLSIGN',
        'JENIS_KAPAL',
        'KODE_BENDERA',
        'PANJANG',
        'LEBAR',
        'TINGGI',
        'DRAFT',
        'GROSS_TON',
        'DEAD_TON',
        'DISPLACEMENT',
        'JENIS_MESIN',
        'DAYA_MESIN',
        'KECEPATAN_MAX',
        'KAPASITAS_KARGO',
        'KAPASITAS_PENUMPANG',
        'TAHUN_PEMBUATAN',
        'GALANGAN_KAPAL',
        'KLASIFIKASI',
        'NOTE',
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

    public function jenis_kapal()
    {
        return $this->hasOne(JenisKapal::class, 'JENIS_KAPAL', 'JENIS_KAPAL');
    }

    public function bendera()
    {
        return $this->hasOne(Bendera::class, 'KODE_BENDERA', 'KODE_BENDERA');
    }
}
