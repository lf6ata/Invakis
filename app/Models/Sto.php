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
        'tgl_sto',
        'no_asset',
        'status',
        'user',
        'tgl_save_sto'

    ];
    
    protected $table = 'sto';

}
