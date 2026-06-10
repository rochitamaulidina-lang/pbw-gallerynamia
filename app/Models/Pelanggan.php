<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey ='no_pelanggan';

    public $timestamps = false;

    protected $guarded =[];

    //relasi
    public function penjualan()
    {
        return $this->hasMany(Penjualan::class,'no_pelanggan');
    }

}
