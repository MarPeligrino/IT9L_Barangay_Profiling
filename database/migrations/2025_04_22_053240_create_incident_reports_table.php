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
        Schema::create('incident_reports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('barangay_employee_id')->constrained();
            $table->date('report_date');
            $table->text('remarks')->nullable();

            // Change: define 'status' as an ENUM
            $table->enum('status', ['pending', 'in_progress', 'resolved', 'closed']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident_reports'); // Also fixed table name from 'incident__reports'
    }
};
