<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBeli extends Model
{
    protected $table = 'detail_beli';
    public $timestamps = false;

    protected $fillable = [
        'no_beli',
        'no_bahan',
        'qty_beli',
        'subtotal_beli',
    ];

    protected $primaryKey = null;
    public $incrementing = false;

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'no_beli');
    }

    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class, 'no_bahan');
    }
}