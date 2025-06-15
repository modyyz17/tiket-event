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
    Schema::create('tikets', function (Blueprint $table) {
        $table->id();
        $table->foreignId('event_id')->constrained()->onDelete('cascade');
        $table->string('name');
        $table->string('email');
        $table->string('phone_number')->nullable();
        $table->integer('quantity');
        $table->decimal('total_price', 10, 2);
        $table->enum('payment_method', ['bank_transfer', 'qris', 'ewallet']);
        $table->string('ticket_code')->unique();
        $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending');

    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tikets');
    }
};
