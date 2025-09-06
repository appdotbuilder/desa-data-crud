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
        // Kehutanan Kepemilikan
        Schema::create('kehutanan_kepemilikan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis');
            $table->decimal('luas_ha', 10, 2);
            $table->timestamps();
            
            $table->index('desa_id');
        });

        // Hasil Hutan
        Schema::create('hasil_hutan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis');
            $table->decimal('luas_ha', 10, 2);
            $table->timestamps();
            
            $table->index('desa_id');
        });

        // Kondisi Hutan
        Schema::create('kondisi_hutan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis');
            $table->decimal('baik_ha', 10, 2);
            $table->decimal('rusak_ha', 10, 2);
            $table->timestamps();
            
            $table->index('desa_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kondisi_hutan');
        Schema::dropIfExists('hasil_hutan');
        Schema::dropIfExists('kehutanan_kepemilikan');
    }
};