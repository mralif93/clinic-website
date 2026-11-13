<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentStatusUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Appointment $appointment) {}

    public function envelope(): Envelope
    {
        $statusLabel = match ($this->appointment->status) {
            'confirmed' => 'Disahkan',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => 'Dikemaskini',
        };

        return new Envelope(
            subject: "Status Tempahan [{$this->appointment->booking_code}]: {$statusLabel} - Sakeenah Medicare",
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.appointments.status-updated',
        );
    }

    /**
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
