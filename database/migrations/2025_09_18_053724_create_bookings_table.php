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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->foreignId('promo_id')->nullable()->constrained('promotions')->onDelete('set null');

            $table->dateTime('booking_time');
            $table->dateTime('estimated_finish_time')->nullable();

            $table->enum('status', ['Menunggu', 'Diterima', 'Sedang Dicuci', 'Selesai', 'Dibatalkan'])->default('Menunggu');
            $table->enum('payment_method', ['COD', 'TRANSFER', 'EWALLET']);
            $table->enum('payment_status', ['Pending', 'Paid', 'Failed'])->default('Pending');

            $table->decimal('total_price', 10, 2)->default(0);
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
