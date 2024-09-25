<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bendera extends Model
{
    use HasFactory;

    protected $connection = 'third_db';
    protected $table      = 'REF_KODE_BENDERA';
    public $timestamps    = false;

    protected $fillable = [
        'KODE_BENDERA',
        'ASAL_NEGARA',
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

    public function kapal()
    {
        return $this->hasMany(Kapal::class, 'KODE_BENDERA', 'KODE_BENDERA');
    }
}
