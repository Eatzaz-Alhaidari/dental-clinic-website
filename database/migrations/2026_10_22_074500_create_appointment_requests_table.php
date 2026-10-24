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
        Schema::create('appointment_requests', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->string('phone', 30)->index();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->foreignId('service_id')->constrained('services')->cascadeOnDelete();
            $table->foreignId('doctor_id')->nullable()->constrained('doctors')->nullOnDelete();
            $table->date('preferred_date')->index();
            $table->string('preferred_time', 50);
            $table->text('notes')->nullable();
            $table->enum('status', ['new', 'contacted', 'confirmed', 'cancelled'])->default('new')->index();
            $table->timestamps();

            // Compound indexes for Filament query filtering and dashboard performance
            $table->index(['branch_id', 'status']);
            $table->index(['branch_id', 'preferred_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_requests');
    }
};
