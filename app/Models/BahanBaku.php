<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    protected $table = 'bahan_baku';
    protected $primaryKey ='no_bahan';

    public $timestamps = false;

    protected $guarded =[];

    //relasi
    public function detail_barang()
    {
        return $this->hasMany(DetailBarang::class,'no_bahan');
    }
    public function detail_beli()
    {
        return $this->hasMany(DetailBeli::class,'no_bahan');
    }

}
