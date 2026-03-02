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
{Schema::create('bookings', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('user_id')->nullable();
    $table->unsignedBigInteger('tour_id')->nullable();

    $table->integer('quantity')->default(1);
    $table->decimal('total_price', 12, 2)->default(0);
    $table->string('status')->default('pending');
    $table->string('booking_code')->nullable();

    $table->string('customer_name');
    $table->string('customer_email');
    $table->string('customer_phone');

    $table->date('departure_date');

    $table->timestamps();
});
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
