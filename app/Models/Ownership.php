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
}
