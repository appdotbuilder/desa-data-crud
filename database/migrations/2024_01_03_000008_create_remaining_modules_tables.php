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
        // Bahan Galian
        Schema::create('bahan_galian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis');
            $table->decimal('deposit_ton_tahun', 10, 2);
            $table->decimal('produksi_ton_tahun', 10, 2);
            $table->timestamps();
            
            $table->index('desa_id');
        });

        // Potensi Air
        Schema::create('potensi_air', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis');
            $table->decimal('volume_m3', 10, 2);
            $table->decimal('debit_m_detik', 10, 2);
            $table->timestamps();
            
            $table->index('desa_id');
        });

        // Air Minum
        Schema::create('air_minum', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis');
            $table->integer('jumlah_unit');
            $table->integer('pemanfaat_kk');
            $table->string('kondisi');
            $table->timestamps();
            
            $table->index('desa_id');
        });

        // Perikanan
        Schema::create('perikanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis');
            $table->string('sifat');
            $table->string('sistem');
            $table->decimal('jumlah_ton_tahun', 10, 2);
            $table->timestamps();
            
            $table->index('desa_id');
        });

        // Fasilitas Umum
        Schema::create('fasilitas_umum', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->string('volume');
            $table->decimal('titik_bt', 10, 6)->nullable();
            $table->decimal('titik_bs', 10, 6)->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
            
            $table->index('desa_id');
        });

        // Pendidikan
        Schema::create('infrastruktur_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->string('volume');
            $table->decimal('titik_bt', 10, 6)->nullable();
            $table->decimal('titik_bs', 10, 6)->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
            
            $table->index('desa_id');
        });

        // Kesehatan
        Schema::create('infrastruktur_kesehatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->string('volume');
            $table->decimal('titik_bt', 10, 6)->nullable();
            $table->decimal('titik_bs', 10, 6)->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
            
            $table->index('desa_id');
        });

        // Pariwisata dan Budaya
        Schema::create('pariwisata_budaya', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis');
            $table->integer('jumlah');
            $table->timestamps();
            
            $table->index('desa_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pariwisata_budaya');
        Schema::dropIfExists('infrastruktur_kesehatan');
        Schema::dropIfExists('infrastruktur_pendidikan');
        Schema::dropIfExists('fasilitas_umum');
        Schema::dropIfExists('perikanan');
        Schema::dropIfExists('air_minum');
        Schema::dropIfExists('potensi_air');
        Schema::dropIfExists('bahan_galian');
    }
};