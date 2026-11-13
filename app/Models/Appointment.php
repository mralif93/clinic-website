<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'service_id',
        'practitioner_id',
        'client_name',
        'client_email',
        'client_phone',
        'client_age',
        'reason_for_visit',
        'session_mode',
        'appointment_date',
        'appointment_time',
        'status',
        'total_amount',
        'deposit_amount',
        'payment_status',
        'payment_method',
        'payment_reference',
        'deposit_receipt',
        'meeting_url',
        'admin_notes',
    ];

    protected function casts(): array
    {
        return [
            'appointment_date' => 'date',
            'client_age' => 'integer',
            'total_amount' => 'decimal:2',
            'deposit_amount' => 'decimal:2',
        ];
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function practitioner(): BelongsTo
    {
        return $this->belongsTo(Practitioner::class);
    }
}
