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
        Schema::table('practitioners', function (Blueprint $table): void {
            $table->json('working_days')->nullable()->after('languages');
            $table->json('available_slots')->nullable()->after('working_days');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('practitioners', function (Blueprint $table): void {
            $table->dropColumn(['working_days', 'available_slots']);
        });
    }
};
