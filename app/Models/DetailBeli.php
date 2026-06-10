<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBeli extends Model
{
   protected $table = 'detail_beli';
    public $timestamps = false;

    protected $guarded =[];

    public $incrementing = false;

    //relasi
    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class,'no_beli');
    }
    //relasi
    public function bahan_baku()
    {
        return $this->belongsTo(BahanBaku::class,'no_bahan');
    }
}
