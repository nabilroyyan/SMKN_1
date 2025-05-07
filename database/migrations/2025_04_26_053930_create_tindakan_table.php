<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('tindakan', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_siswa');
        $table->string('tindakan');
        $table->text('catatan')->nullable();
        $table->timestamps();

        $table->foreign('id_siswa')->references('id')->on('siswa')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindakan');
    }
};
