<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    protected $table = 'bahan_baku';
    protected $primaryKey = 'no_bahan';  
    public $incrementing = false;        
    protected $keyType = 'string';       

    public $timestamps = false;
    
    protected $fillable = [
        'no_bahan',
        'nama_bahan',
        'stok_bahan',
        'satuan',
        'stok_kritis',
        'harga_beli',
    ];
}