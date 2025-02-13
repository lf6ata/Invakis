<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionSto extends Model
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'session_sto',
        'total_barang',
        'progress',
        'durasi',
        'tgl_sto',
        'save_sto',
    ];

    protected $table = 'session_sto';
}
