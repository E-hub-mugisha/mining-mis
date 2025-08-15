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
        Schema::create('maintenance_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_id')->constrained('equipment')->cascadeOnDelete();
            $table->enum('priority',['low','medium','high'])->default('medium');
            $table->enum('status',['open','in_progress','done'])->default('open');
            $table->date('scheduled_for')->nullable();
            $table->date('completed_at')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_jobs');
    }
};
