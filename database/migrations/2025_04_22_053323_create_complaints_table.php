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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();

            $table->foreignId('incident_id')->constrained('incident_reports');
            $table->foreignId('barangay_employee_id')->constrained();
            $table->text('remarks')->nullable();

            // Updated: status is now an ENUM
            $table->enum('status', ['pending', 'in_progress', 'resolved', 'closed']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
