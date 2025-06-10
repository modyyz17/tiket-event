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
    Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->string('nama_event');
        $table->string('lokasi');
        $table->date('tanggal');
        $table->string('kategori'); // konser, seminar, pameran, gameshow
        $table->string('gambar')->nullable();
        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
