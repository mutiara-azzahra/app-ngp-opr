<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPrint extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $table = 'XLOG_PRINT';

    protected $fillable = [
    ];
}
