<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBarang extends Model
{
    protected $table = 'detail_barang';
    public $timestamps = false;

    protected $guarded =[];

    public $incrementing = false;

    //relasi
    public function barang()
    {
        return $this->belongsTo(Barang::class,'no_barang');
    }
    public function bahan_baku()
    {
        return $this->belongsTo(BahanBaku::class,'no_bahan');
    }
}
