<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $fillable = [
        'npk',
        'nama_kr',
        'divisi'
    ];

    protected $table = 'karyawan';
}
