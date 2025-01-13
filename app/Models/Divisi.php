<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'divisi'

    ];

    protected $table = 'divisi';
    public $timestamps = false;
}
