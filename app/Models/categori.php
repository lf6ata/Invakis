<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categori extends Model
{
    // use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id_categori',
        'categori',
    ];
    
    // protected $primaryKey = 'id_categori';
    // public $incrementing = false;
    // protected $keyType = 'char';

    protected $table = 'categori';
    // public $timestamps = false;
    
}
