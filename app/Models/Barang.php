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
        'id_merek',
        'id_warna',
        'lokasi',
        'npk',
        'nama_kr',
        'divisi',
        'image',
        'serial_number',
        'jenis_license',
        'kode_license',
        'tgl_masuk',
        'tgl_terakhir_sto'
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
    public function tbWarna(){
        return $this->hasMany(Warna::class,'id','id_warna','warna');
    }
    public function tbKaryawan(){
        return $this->hasMany(Karyawan::class,'id','npk','nama_kr');
    }

    
    protected $table = 'barang';
    // protected $primaryKey = 'id_jenis';
    // protected $keyType = 'string';
    //public $timestamps = false;
}
