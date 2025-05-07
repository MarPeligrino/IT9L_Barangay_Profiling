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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('owner_id')->constrained('residents');
            $table->foreignId('business_type_id')->constrained('business_types');
            $table->string('business_name');
            $table->string('house_number');
            $table->string('street_name');
            $table->string('village');
            $table->string('barangay');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
