<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';
    protected $primaryKey = 'no_beli';
    public $incrementing = false;  // auto_increment
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'no_beli',
        'no_supplier',
        'no_pegawai',
        'no_faktur',
        'tgl_beli',
        'total_beli',
        'faktur_file',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'no_supplier');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'no_pegawai');
    }

    public function detailBeli()
    {
        return $this->hasMany(DetailBeli::class, 'no_beli');
    }
}