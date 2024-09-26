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
}
