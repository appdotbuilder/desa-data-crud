<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Komoditas Sayur
        Schema::create('komoditas_sayur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis');
            $table->decimal('luas_ha', 10, 2);
            $table->decimal('jumlah_produksi_ton_tahun', 10, 2);
            $table->timestamps();
            
            $table->index('desa_id');
        });

        // Komoditas Buah
        Schema::create('komoditas_buah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis');
            $table->decimal('luas_ha', 10, 2);
            $table->decimal('jumlah_produksi_ton_tahun', 10, 2);
            $table->timestamps();
            
            $table->index('desa_id');
        });

        // Tanaman Obat
        Schema::create('tanaman_obat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis');
            $table->decimal('luas_ha', 10, 2);
            $table->decimal('jumlah_produksi_ton_tahun', 10, 2);
            $table->timestamps();
            
            $table->index('desa_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanaman_obat');
        Schema::dropIfExists('komoditas_buah');
        Schema::dropIfExists('komoditas_sayur');
    }
};