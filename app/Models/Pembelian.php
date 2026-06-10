<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';
    protected $primaryKey ='no_beli';

    public $timestamps = false;

    protected $guarded =[];

    //relasi
    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'no_supplier');
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class,'no_pegawai');
    }
    public function detail_beli()
    {
        return $this->hasMany(DetailBeli::class,'no_beli');
    }
}
