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
        // Perkebunan Swasta/Negara
        Schema::create('perkebunan_swasta_negara', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis');
            $table->decimal('luas_ha', 10, 2);
            $table->decimal('jumlah_produksi_ton_tahun', 10, 2);
            $table->timestamps();
            
            $table->index('desa_id');
        });

        // Perkebunan Masyarakat
        Schema::create('perkebunan_masyarakat', function (Blueprint $table) {
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
        Schema::dropIfExists('perkebunan_masyarakat');
        Schema::dropIfExists('perkebunan_swasta_negara');
    }
};