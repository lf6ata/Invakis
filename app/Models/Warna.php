<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warna extends Model
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id_warna',
        'warna',

    ];
    
    protected $table = 'warna';
    
}
