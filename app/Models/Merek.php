<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merek extends Model
{
    // use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id_merek',
        'merek',

    ];
    
    protected $table = 'merek';
    protected $primaryKey = 'id_merek';
    // protected $keyType = 'number';
    //public $timestamps = false;
}
