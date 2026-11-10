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
        Schema::create('appointments', function (Blueprint $table): void {
            $table->id();
            $table->string('booking_code')->unique();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->foreignId('practitioner_id')->nullable()->constrained()->nullOnDelete();

            // Client Details
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            $table->integer('client_age')->nullable();
            $table->text('reason_for_visit')->nullable();

            // Session Details
            $table->string('session_mode')->default('in_person'); // in_person, online
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string('status')->default('pending'); // pending, confirmed, completed, cancelled

            // Payment
            $table->decimal('total_amount', 10, 2)->default(0.00);
            $table->decimal('deposit_amount', 10, 2)->default(0.00);
            $table->string('payment_status')->default('pending'); // pending, paid, refunded
            $table->string('payment_method')->nullable(); // fpx, card, cash
            $table->string('payment_reference')->nullable();

            // Meeting Link for Online Tele-therapy
            $table->string('meeting_url')->nullable();
            $table->text('admin_notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
