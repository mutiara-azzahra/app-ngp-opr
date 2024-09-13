<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKapal extends Model
{
    use HasFactory;

    protected $connection = 'third_db';
    protected $table      = 'REF_JENIS_KAPAL';
    
    public $timestamps    = false;

    protected $fillable = [
        'JENIS_KAPAL',
        'G1',
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
        return $this->hasMany(Kapal::class, 'JENIS_KAPAL', 'JENIS_KAPAL');
    }
}
