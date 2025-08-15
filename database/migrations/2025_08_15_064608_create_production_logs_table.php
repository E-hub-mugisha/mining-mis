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
        Schema::create('production_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->constrained('sites')->cascadeOnDelete();
            $table->date('date');
            $table->decimal('ore_tonnage',12,2)->default(0);
            $table->decimal('waste_tonnage',12,2)->default(0);
            $table->decimal('avg_grade',8,4)->nullable(); // g/t
            $table->integer('truck_trips')->default(0);
            $table->integer('downtime_minutes')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_logs');
    }
};
