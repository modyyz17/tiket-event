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
        Schema::create('tiket', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->text('deskripsi')->nullable();
    $table->string('lokasi');
    $table->date('tanggal');
    $table->time('waktu');
    $table->decimal('harga', 10, 2);
    $table->string('gambar')->nullable();
    $table->unsignedBigInteger('kategori_id');
    $table->timestamps();

    $table->foreign('kategori_id')->references('id')->on('kategori_tiket')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiket');
    }
};
