<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('no_barang')->constrained('barang', 'id')->onDelete('cascade');
            $table->foreignId('no_bahan')->constrained('bahan_baku', 'id')->onDelete('cascade');
            $table->integer('qty_pakai');
            $table->decimal('subtotal_bom', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_barang');
    }
};