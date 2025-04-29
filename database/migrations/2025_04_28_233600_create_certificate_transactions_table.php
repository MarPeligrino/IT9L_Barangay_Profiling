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
        Schema::create('certificate_transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('business_permit_id')->constrained()->onDelete('cascade');
            $table->decimal('amount_paid', 8, 2);
            $table->date('payment_date')->default(now());
            $table->enum('payment_status', ['Paid', 'Pending', 'Failed'])->default(('Pending'));

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificate_transactions');
    }
};
