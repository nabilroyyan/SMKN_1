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
        Schema::create('siswa_monitoring', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_pelanggaran');
            $table->unsignedBigInteger('id_absensi');
            $table->timestamps();

            $table->foreign('id_siswa')->references('id')->on('siswa')->onDelete('cascade');
            $table->foreign('id_pelanggaran')->references('id')->on('pelanggaran')->onDelete('cascade');
            $table->foreign('id_absensi')->references('id')->on('absensi')->onDelete('cascade');

            $table->unique(['id_siswa', 'id_pelanggaran','id_absensi']); // opsional, jika ingin mencegah duplikasi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_pelanggaran');
    }
};
