<?php

namespace App\Helpers;

class GoogleCalendarHelper
{
    /**
     * Clean Google Calendar description by removing automated Google Meet boilerplate,
     * dial-in codes, US phone numbers, and recurring reminders.
     */
    public static function cleanDescription(?string $desc): ?string
    {
        if (empty($desc)) {
            return null;
        }

        // Remove hidden Google Calendar sync metadata (-::~:~::~...:::~.-)
        $clean = preg_replace('/-::~:~::~:~:.*?:::~.-.*?::/s', '', $desc);

        // Remove Meet boilerplate lines
        $clean = preg_replace('/Join with Google Meet:\s*https?:\/\/[^\s]+/i', '', $clean);
        $clean = preg_replace('/Video call link:\s*https?:\/\/[^\s]+/i', '', $clean);
        $clean = preg_replace('/Google Meet joining info[^\n]*/i', '', $clean);
        $clean = preg_replace('/Or dial:[^\n]*/i', '', $clean);
        $clean = preg_replace('/More phone numbers:[^\n]*/i', '', $clean);
        $clean = preg_replace('/Learn more about Meet at:[^\n]*/i', '', $clean);
        $clean = preg_replace('/Time zone:[^\n]*/i', '', $clean);
        $clean = preg_replace('/https?:\/\/tel\.meet\/[^\s]*/i', '', $clean);

        // Strip lone Meet links like <a href="https://meet.google.com/...">...</a>
        $clean = preg_replace('/<a\s+href="https?:\/\/meet\.google\.com\/[^"]+">[^<]*<\/a>/i', '', $clean);
        $clean = preg_replace('/https?:\/\/meet\.google\.com\/[a-z0-9\-]+/i', '', $clean);

        // Remove generic reminder lines if solely that
        $clean = preg_replace('/This is an event reminder\.?/i', '', $clean);

        // Strip HTML tags and normalize spacing
        $clean = strip_tags($clean);
        $clean = html_entity_decode($clean, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $clean = preg_replace("/[\r\n]+/", "\n", $clean);
        $clean = trim($clean);

        return ! empty($clean) ? $clean : null;
    }

    /**
     * Extract Google Meet URL from location, description, or html tags.
     */
    public static function extractMeetUrl(?string $location, ?string $description): ?string
    {
        if (! empty($location) && str_contains(strtolower($location), 'meet.google.com')) {
            return trim($location);
        }

        if (! empty($description) && preg_match('/https:\/\/meet\.google\.com\/[a-z0-9\-]+/i', $description, $matches)) {
            return $matches[0];
        }

        if (! empty($location) && str_starts_with($location, 'http')) {
            return trim($location);
        }

        return null;
    }
}
