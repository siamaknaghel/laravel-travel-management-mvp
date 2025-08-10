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
        Schema::create('subservices', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100); // e.g. Economy, Business, Suite
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->string('code', 20); // e.g. ECO, BUS, SUI
            $table->unique(['service_id', 'code']); // یک زیرخدمت نمی‌تونه دوبار با همون کد باشه
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subservices');
    }
};
