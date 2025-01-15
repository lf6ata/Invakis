<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sto extends Model
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'session_sto',
        'tgl_sto',
        'no_asset',
        'status',
        'user',
        'tgl_save_sto'

    ];

    public function tbBarang()
    {
        return $this->hasMany(Barang::class, 'no_asset', 'no_asset');
    }

    protected $table = 'sto';
}
