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
        Schema::create('screener_responses', function (Blueprint $table): void {
            $table->id();
            $table->string('screener_type')->default('dass21'); // dass21, adhd_screener, etc.
            $table->string('session_id')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_email')->nullable();
            $table->string('client_phone')->nullable();

            // DASS-21 Scores
            $table->integer('depression_score')->default(0);
            $table->string('depression_severity')->nullable(); // normal, mild, moderate, severe, extremely_severe
            $table->integer('anxiety_score')->default(0);
            $table->string('anxiety_severity')->nullable();
            $table->integer('stress_score')->default(0);
            $table->string('stress_severity')->nullable();

            $table->json('answers')->nullable();
            $table->text('recommended_services')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('screener_responses');
    }
};
