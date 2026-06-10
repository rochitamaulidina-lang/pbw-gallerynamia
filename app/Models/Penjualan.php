<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey ='no_jual';

    public $timestamps = false;

    protected $guarded =[];

    //relasi
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class,'no_pelanggan');
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class,'no_pegawai');
    }
    public function detail_penjualan()
    {
        return $this->hasMany(DetailPenjualan::class,'no_jual');
    }
}
