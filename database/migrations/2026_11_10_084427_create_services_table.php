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
        Schema::create('services', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category'); // e.g. psychotherapy, assessment, child_therapy, corporate
            $table->text('summary')->nullable();
            $table->longText('description')->nullable();
            $table->string('target_audience')->nullable(); // e.g. Dewasa, Kanak-kanak, Pasangan
            $table->decimal('price', 10, 2)->default(0.00);
            $table->decimal('deposit_amount', 10, 2)->default(50.00);
            $table->integer('duration_minutes')->default(60);
            $table->string('image_path')->nullable();
            $table->boolean('allows_online')->default(true);
            $table->boolean('allows_in_person')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
