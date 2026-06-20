<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBarang extends Model
{
    protected $table = 'detail_barang';
    public $timestamps = false;

    protected $fillable = [
        'no_barang',
        'no_bahan',
        'qty_pakai',
        'subtotal_bom',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'no_barang');
    }

    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class, 'no_bahan');
    }
}