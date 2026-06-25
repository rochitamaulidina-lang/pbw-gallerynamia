<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'no_jual';
    public $incrementing = false;  
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'no_jual',
        'no_pelanggan',
        'no_pegawai',
        'tgl_jual',
        'dp',
        'sisa_bayar',
        'total_jual',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'no_pelanggan');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'no_pegawai');
    }

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'no_jual');
    }
}
