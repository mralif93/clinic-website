<?php

namespace App\Services;

use App\Models\GoogleCalendarEvent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleCalendarSyncService
{
    /**
     * Synchronize events from the configured Google Calendar source (iCal URL or API).
     *
     * @return array{success: bool, message: string, count: int}
     */
    public function sync(): array
    {
        $icalUrl = config('services.google_calendar.ical_url');

        if (empty($icalUrl)) {
            return [
                'success' => false,
                'message' => 'Pautan iCal Google Calendar belum ditetapkan dalam fail .env (GOOGLE_CALENDAR_ICAL_URL).',
                'count' => 0,
            ];
        }

        try {
            $response = Http::timeout(20)->get($icalUrl);

            if (! $response->successful()) {
                return [
                    'success' => false,
                    'message' => 'Gagal memuat turun data dari Google Calendar (HTTP status: '.$response->status().').',
                    'count' => 0,
                ];
            }

            $icsContent = $response->body();
            $events = $this->parseIcs($icsContent);

            $syncedCount = 0;
            $now = Carbon::now();

            foreach ($events as $evt) {
                GoogleCalendarEvent::updateOrCreate(
                    ['google_event_id' => $evt['uid']],
                    [
                        'summary' => $evt['summary'] ?: '(Tiada Tajuk)',
                        'description' => $evt['description'] ?? null,
                        'location' => $evt['location'] ?? null,
                        'start_time' => $evt['start_time'],
                        'end_time' => $evt['end_time'],
                        'is_all_day' => $evt['is_all_day'],
                        'status' => $evt['status'] ?? 'confirmed',
                        'html_link' => $evt['url'] ?? null,
                        'organizer_email' => $evt['organizer'] ?? null,
                        'attendees' => $evt['attendees'] ?? [],
                        'last_synced_at' => $now,
                    ]
                );
                $syncedCount++;
            }

            return [
                'success' => true,
                'message' => 'Berjaya menyegerakkan '.$syncedCount.' temujanji dari Google Calendar.',
                'count' => $syncedCount,
            ];
        } catch (\Throwable $e) {
            Log::error('Google Calendar Sync Error: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return [
                'success' => false,
                'message' => 'Ralat semasa penyelarasan kalendar: '.$e->getMessage(),
                'count' => 0,
            ];
        }
    }

    /**
     * Parse raw iCalendar (.ics) content into structured array.
     *
     * @return array<int, array<string, mixed>>
     */
    public function parseIcs(string $ics): array
    {
        // Unfold folded lines (lines starting with space or tab continue previous line)
        $ics = preg_replace("/\r\n[ \t]/", '', $ics);
        $ics = preg_replace("/\n[ \t]/", '', $ics);

        $lines = preg_split("/\r\n|\n|\r/", $ics);
        $events = [];
        $currentEvent = null;
        $inEvent = false;

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === 'BEGIN:VEVENT') {
                $inEvent = true;
                $currentEvent = [
                    'uid' => null,
                    'summary' => '',
                    'description' => '',
                    'location' => '',
                    'start_time' => null,
                    'end_time' => null,
                    'is_all_day' => false,
                    'status' => 'confirmed',
                    'url' => null,
                    'organizer' => null,
                    'attendees' => [],
                ];

                continue;
            }

            if ($line === 'END:VEVENT') {
                if ($inEvent && ! empty($currentEvent['uid']) && ! empty($currentEvent['start_time'])) {
                    $events[] = $currentEvent;
                }
                $inEvent = false;
                $currentEvent = null;

                continue;
            }

            if (! $inEvent) {
                continue;
            }

            // Extract property name and value
            if (! str_contains($line, ':')) {
                continue;
            }

            [$propPart, $valuePart] = explode(':', $line, 2);
            $propParts = explode(';', $propPart);
            $propName = strtoupper($propParts[0]);

            // Unescape iCal text characters (\,, \;, \n, \N)
            $unescapedValue = str_replace(
                ['\\,', '\\;', '\\n', '\\N', '\\\\'],
                [',', ';', "\n", "\n", '\\'],
                $valuePart
            );

            switch ($propName) {
                case 'UID':
                    $currentEvent['uid'] = trim($valuePart);
                    break;
                case 'SUMMARY':
                    $currentEvent['summary'] = trim($unescapedValue);
                    break;
                case 'DESCRIPTION':
                    $currentEvent['description'] = trim($unescapedValue);
                    break;
                case 'LOCATION':
                    $currentEvent['location'] = trim($unescapedValue);
                    break;
                case 'STATUS':
                    $currentEvent['status'] = strtolower(trim($valuePart));
                    break;
                case 'URL':
                    $currentEvent['url'] = trim($valuePart);
                    break;
                case 'ORGANIZER':
                    $currentEvent['organizer'] = preg_replace('/^mailto:/i', '', trim($valuePart));
                    break;
                case 'ATTENDEE':
                    $email = preg_replace('/^mailto:/i', '', trim($valuePart));
                    $currentEvent['attendees'][] = $email;
                    break;
                case 'DTSTART':
                    $parsed = $this->parseIcsDate($propPart, $valuePart);
                    $currentEvent['start_time'] = $parsed['datetime'];
                    $currentEvent['is_all_day'] = $parsed['is_all_day'];
                    break;
                case 'DTEND':
                    $parsed = $this->parseIcsDate($propPart, $valuePart);
                    $currentEvent['end_time'] = $parsed['datetime'];
                    break;
            }
        }

        return $events;
    }

    /**
     * Parse iCal date or datetime string into Carbon instance in Malaysia local time (Asia/Kuala_Lumpur).
     *
     * @return array{datetime: Carbon, is_all_day: bool}
     */
    private function parseIcsDate(string $propPart, string $value): array
    {
        $value = trim($value);
        $localTz = config('app.timezone', 'Asia/Kuala_Lumpur');
        $isAllDay = str_contains($propPart, 'VALUE=DATE') || strlen($value) === 8;

        if ($isAllDay && strlen($value) === 8) {
            // Format: YYYYMMDD
            $dt = Carbon::createFromFormat('Ymd', $value, $localTz)->startOfDay();

            return ['datetime' => $dt, 'is_all_day' => true];
        }

        // Check if a specific TZID is provided in the property, e.g. DTSTART;TZID=Asia/Kuala_Lumpur
        $tzid = null;
        if (preg_match('/TZID=([^;:]+)/i', $propPart, $tzMatches)) {
            $tzid = trim($tzMatches[1]);
        }

        // Format: UTC ends with Z (e.g. 20261113T043000Z)
        if (str_ends_with($value, 'Z')) {
            $dt = Carbon::createFromFormat('Ymd\THis\Z', $value, 'UTC')->setTimezone($localTz);

            return ['datetime' => $dt, 'is_all_day' => false];
        }

        // Format: YYYYMMDDTHHMMSS with TZID or local timezone
        $sourceTz = $tzid ?: $localTz;

        try {
            $dt = Carbon::createFromFormat('Ymd\THis', $value, $sourceTz)->setTimezone($localTz);

            return ['datetime' => $dt, 'is_all_day' => false];
        } catch (\Throwable) {
            return ['datetime' => Carbon::parse($value, $sourceTz)->setTimezone($localTz), 'is_all_day' => false];
        }
    }
}
