<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $table = 'detail_penjualan';
    public $incrementing = false;  
    public $timestamps = false;

    protected $fillable = [
        'no_jual',
        'no_barang',
        'qty_jual',
        'subtotal_jual',
    ];

    protected $primaryKey = null;

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'no_jual', 'no_jual');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'no_barang', 'no_barang');
    }
}
