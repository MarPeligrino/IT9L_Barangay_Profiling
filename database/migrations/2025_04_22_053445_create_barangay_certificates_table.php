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
        Schema::create('barangay_certificates', function (Blueprint $table) {
            $table->id();

            $table->foreignId('resident_id')->constrained();
            $table->foreignId('barangay_employee_id')->constrained();
            $table->foreignId('certificate_type_id')->constrained();
            $table->text('purpose');
            $table->date('issued_date');
            $table->string('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangay_certificates');
    }
};
