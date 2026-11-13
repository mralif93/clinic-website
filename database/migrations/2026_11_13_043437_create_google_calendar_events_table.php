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
        Schema::create('google_calendar_events', function (Blueprint $table): void {
            $table->id();
            $table->string('google_event_id')->unique();
            $table->string('summary');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->boolean('is_all_day')->default(false);
            $table->string('status')->nullable()->default('confirmed');
            $table->string('html_link')->nullable();
            $table->string('organizer_email')->nullable();
            $table->json('attendees')->nullable();
            $table->timestamp('last_synced_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('google_calendar_events');
    }
};
