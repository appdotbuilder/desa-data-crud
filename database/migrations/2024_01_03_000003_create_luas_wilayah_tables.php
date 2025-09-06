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
        // Tanah Perkebunan
        Schema::create('tanah_perkebunan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis');
            $table->decimal('luas_ha', 10, 2);
            $table->timestamps();
            
            $table->index('desa_id');
        });

        // Tanah Sawah
        Schema::create('tanah_sawah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis');
            $table->decimal('luas_ha', 10, 2);
            $table->timestamps();
            
            $table->index('desa_id');
        });

        // Tanah Kering
        Schema::create('tanah_kering', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis');
            $table->decimal('luas_ha', 10, 2);
            $table->timestamps();
            
            $table->index('desa_id');
        });

        // Tanah Basah
        Schema::create('tanah_basah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis');
            $table->decimal('luas_ha', 10, 2);
            $table->timestamps();
            
            $table->index('desa_id');
        });

        // Tanah Fasilitas Umum
        Schema::create('tanah_fasilitas_umum', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis');
            $table->decimal('luas_ha', 10, 2);
            $table->timestamps();
            
            $table->index('desa_id');
        });

        // Tanah Hutan
        Schema::create('tanah_hutan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis');
            $table->decimal('luas_ha', 10, 2);
            $table->timestamps();
            
            $table->index('desa_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanah_hutan');
        Schema::dropIfExists('tanah_fasilitas_umum');
        Schema::dropIfExists('tanah_basah');
        Schema::dropIfExists('tanah_kering');
        Schema::dropIfExists('tanah_sawah');
        Schema::dropIfExists('tanah_perkebunan');
    }
};