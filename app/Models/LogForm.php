<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogForm extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    
    protected $table = 'XLOG_FORM';

    protected $fillable = [
    ];
}
