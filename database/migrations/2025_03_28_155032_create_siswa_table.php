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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->string('nisn')->unique();
            $table->string('tempat');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama');
            $table->string('status_dalam_keluarga');
            $table->integer('anak_ke');
            $table->text('alamat_peserta_didik');
            $table->string('nomer_telepon_rumah')->nullable();
            $table->string('sekolah_asal');
            $table->date('diterima_disekolah_pada_tanggal');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->text('alamat_orangtua');
            $table->string('pekerjaan_ayah');
            $table->string('pekerjaan_ibu');
            $table->string('foto_siswa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
