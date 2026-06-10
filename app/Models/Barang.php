<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey ='no_barang';

    public $timestamps = false;

    protected $guarded =[];

    
    //relasi
    public function detail_barang()
    {
        return $this->hasMany(DetailBarang::class,'no_barang');
    }
    public function detail_penjualan()
    {
        return $this->hasMany(DetailPenjualan::class,'no_barang');
    }


}
