<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'no_barang';  
    public $incrementing = false;         
    protected $keyType = 'string';        

    public $timestamps = false; 
    
    protected $fillable = [
        'no_barang',
        'nama_barang',
        'ukuran',
        'stok_barang',
        'harga_barang',
    ];

    public function detailBarang()
    {
        return $this->hasMany(DetailBarang::class, 'no_barang');
    }
}