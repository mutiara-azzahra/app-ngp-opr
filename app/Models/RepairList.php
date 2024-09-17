<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairList extends Model
{
    use HasFactory;

    protected $connection = 'third_db';
    protected $table      = 'MST_REPAIR_LIST';
    public $timestamps    = false;

    protected $fillable = [
        'KODE_REPAIR_LIST',
        'KODE_JENIS_KAPAL',
        'BAGIAN_KAPAL',
        'JENIS_PERBAIKAN',
        'DESKRIPSI',
        'SATUAN',
        'INTERVAL_WAKTU_HARI',
        'HPP',
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
}
