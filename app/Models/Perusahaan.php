<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $connection = 'db_firebird';
    protected $table      = 'MST_PERUSAHAAN';

    protected $fillable = [
    ];

}
