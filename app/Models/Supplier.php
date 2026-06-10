<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey ='no_supplier';

    public $timestamps = false;

    protected $guarded =[];

    //relasi
    public function pembelian()
    {
        return $this->hasMany(Pembelian::class,'no_supplier');
    }
}
