<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    // use HasFactory;
     /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'no_asset',
        'id_categori',
        'id_jenis',
        'id_merek'
    ];
    
    public function tbCategori(){
        return $this->hasMany(categori::class,'id','id_categori','categori');
    }

    public function tbJenis(){
        return $this->hasMany(Jenis::class,'id','id_jenis','jenis');
    }

    public function tbMerek(){
        return $this->hasMany(Merek::class,'id','id_merek','merek');
    }

    
    protected $table = 'barang';
    // protected $primaryKey = 'id_jenis';
    // protected $keyType = 'string';
    //public $timestamps = false;
}
