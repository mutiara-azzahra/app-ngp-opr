<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogEtc extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    
    protected $table = 'XLOG_ETC';

    protected $fillable = [
    ];
}
