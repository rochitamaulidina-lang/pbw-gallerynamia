<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey ='no_pegawai';

    public $timestamps = false;

    protected $guarded =[];

    
    //relasi
    public function pembelian()
    {
        return $this->hasMany(Pembelian::class,'no_pegawai');
    }
    public function penjualan()
    {
        return $this->hasMany(Penjualan::class,'no_pegawai');
    }


}
