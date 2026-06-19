<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('no_barang')->unique();      
            $table->string('nama_barang');
            $table->string('ukuran');                    
            $table->integer('stok_barang')->default(0);
            $table->decimal('harga_barang', 15, 2);      
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};