<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;
    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id_jenis',
        'jenis',

    ];
    
    protected $table = 'jenis';
    protected $primaryKey = 'id_jenis';
    protected $keyType = 'string';
    //public $timestamps = false;
    

}
