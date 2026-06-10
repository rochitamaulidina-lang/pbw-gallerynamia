<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $table = 'detail_penjual';
    public $timestamps = false;

    protected $guarded =[];

    public $incrementing = false;

    //relasi
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class,'no_jual');
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class,'no_barang');
    }
}

