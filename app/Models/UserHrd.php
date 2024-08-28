<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHrd extends Model
{
    use HasFactory;

    protected $connection = 'firebird';

    protected $table = 'HRD_USER';

    protected $fillable = [
    ];
}
