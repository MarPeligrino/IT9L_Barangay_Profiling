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
        Schema::create('business_permits', function (Blueprint $table) {
            $table->id();

            $table->foreignId('business_id')->constrained();
            $table->foreignId('barangay_employee_id')->constrained();
            $table->date('issued_date');
            $table->date('expiry_date');
            $table->string('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business__permits');
    }
};
