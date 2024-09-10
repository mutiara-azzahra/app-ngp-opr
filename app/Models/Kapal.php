<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kapal extends Model
{
    use HasFactory;

   protected $connection = 'third_db';
   protected $table      = 'OPR_KAPAL';

    // protected $connection = 'db_localhost1';
    
    public $timestamps    = false;

    protected $fillable = [
        'KODE_KAPAL',
        'NAMA_KAPAL',
        'CALLSIGN',
        'JENIS_KAPAL',
        'KODE_BENDERA',
        'PANJANG',
        'LEBAR',
        'DRAFT',
        'TINGGI',
        'GROSS',
        'TON',
        'DEAD_TON',
        'DISPLACEMENT',
        'JENIS_MESIN',
        'DAYA_MESIN',
        'KECEPATAN_MAX',
        'KAPASITAS_KARGO',
        'KAPASITAS_PENUMPANG',
        'TAHUN_PEMBUATAN',
        'GALANGAN_KAPAL',
        'KLASIFIKASI'
    ];

    public function bendera()
    {
        return $this->hasOne(Bendera::class, 'KODE_BENDERA', 'KODE_BENDERA');
    }

    public function jenis_kapal()
    {
        return $this->hasOne(JenisKapal::class, 'JENIS_KAPAL', 'JENIS_KAPAL');
    }
}
