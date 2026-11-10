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
        Schema::create('practitioners', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('title'); // e.g. Clinical Psychologist, Registered Counselor
            $table->string('registration_number')->nullable(); // e.g. MAHPC(CP)0012, KB08765
            $table->text('bio')->nullable();
            $table->json('specialties')->nullable(); // ['Depression', 'Autism', 'Trauma', 'Couples']
            $table->json('languages')->nullable(); // ['Bahasa Melayu', 'English']
            $table->string('photo_path')->nullable();
            $table->boolean('accepts_online')->default(true);
            $table->boolean('accepts_in_person')->default(true);
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
        Schema::dropIfExists('practitioners');
    }
};
