<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bahan_baku', function (Blueprint $table) {
            $table->id();
            $table->string('no_bahan')->unique();
            $table->string('nama_bahan');
            $table->integer('stok_bahan')->default(0);
            $table->string('satuan');
            $table->integer('stok_kritis')->default(0);
            $table->decimal('harga_beli', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bahan_baku');
    }
};