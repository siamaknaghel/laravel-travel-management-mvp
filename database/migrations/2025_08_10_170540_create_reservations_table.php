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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // پارتنری که رزرو رو زده
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->foreignId('subservice_id')->constrained()->onDelete('cascade');
            $table->foreignId('origin_country_id')->constrained('countries')->onDelete('cascade');
            $table->foreignId('origin_province_id')->nullable()->constrained('provinces')->onDelete('set null');
            $table->foreignId('origin_city_id')->nullable()->constrained('cities')->onDelete('set null');
            $table->foreignId('destination_country_id')->constrained('countries')->onDelete('cascade');
            $table->foreignId('destination_province_id')->nullable()->constrained('provinces')->onDelete('set null');
            $table->foreignId('destination_city_id')->nullable()->constrained('cities')->onDelete('set null');
            $table->date('travel_date');
            $table->decimal('price', 12, 2);
            $table->string('status')->default('pending'); // pending, confirmed, cancelled
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
