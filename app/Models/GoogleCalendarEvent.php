<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleCalendarEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'google_event_id',
        'summary',
        'description',
        'location',
        'start_time',
        'end_time',
        'is_all_day',
        'status',
        'html_link',
        'organizer_email',
        'attendees',
        'last_synced_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_time' => 'datetime',
            'end_time' => 'datetime',
            'is_all_day' => 'boolean',
            'attendees' => 'array',
            'last_synced_at' => 'datetime',
        ];
    }
}
