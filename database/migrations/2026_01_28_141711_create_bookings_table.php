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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email')->nullable();
            $table->date('visit_date');
            $table->time('visit_time');
            $table->json('tickets'); // Store as JSON array
            $table->json('menu_items')->nullable(); // Store as JSON array
            $table->text('notes')->nullable();
            $table->enum('payment_method', ['tempat', 'transfer', 'qris']);
            $table->boolean('agree_terms');
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
