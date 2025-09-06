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
        Schema::create('demografi_penduduk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('kk');
            $table->string('nik')->unique();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->enum('pendidikan_terakhir', ['sd', 'sltp', 'slta', 's1', 's2', 's3']);
            $table->enum('agama', ['islam', 'katolik', 'protestan', 'hindu', 'budha', 'konghucu', 'kepercayaan']);
            $table->string('pekerjaan');
            $table->timestamps();
            
            $table->index(['desa_id', 'nama']);
            $table->index(['desa_id', 'jenis_kelamin']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demografi_penduduk');
    }
};