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
        // Jenis dan Populasi
        Schema::create('jenis_populasi_ternak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis');
            $table->integer('jumlah_ekor');
            $table->timestamps();
            
            $table->index('desa_id');
        });

        // Produk Peternakan
        Schema::create('produk_peternakan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis');
            $table->string('jumlah'); // bisa ekor/m/kg/l
            $table->timestamps();
            
            $table->index('desa_id');
        });

        // Pakan Ternak
        Schema::create('pakan_ternak', function (Blueprint $table) {
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
        Schema::dropIfExists('pakan_ternak');
        Schema::dropIfExists('produk_peternakan');
        Schema::dropIfExists('jenis_populasi_ternak');
    }
};