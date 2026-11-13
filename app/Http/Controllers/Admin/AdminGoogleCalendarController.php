<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GoogleCalendarEvent;
use App\Services\GoogleCalendarSyncService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminGoogleCalendarController extends Controller
{
    /**
     * Display a listing of synced Google Calendar appointments.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $timeframe = $request->query('timeframe', 'all'); // all, upcoming, past, today, custom
        $date = $request->query('date');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = GoogleCalendarEvent::query();

        if (! empty($search)) {
            $query->where(function ($q) use ($search): void {
                $q->where('summary', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('organizer_email', 'like', "%{$search}%");
            });
        }

        $now = Carbon::now();

        // Single date or date range filter priority
        if (! empty($startDate) && ! empty($endDate)) {
            $query->whereDate('start_time', '>=', $startDate)
                ->whereDate('start_time', '<=', $endDate);
        } elseif (! empty($startDate)) {
            $query->whereDate('start_time', '>=', $startDate);
        } elseif (! empty($endDate)) {
            $query->whereDate('start_time', '<=', $endDate);
        } elseif (! empty($date)) {
            $query->whereDate('start_time', $date);
        } elseif ($timeframe === 'upcoming') {
            $query->where('start_time', '>=', $now);
        } elseif ($timeframe === 'today') {
            $query->whereDate('start_time', $now->toDateString());
        } elseif ($timeframe === 'past') {
            $query->where('start_time', '<', $now);
        }

        $events = $query->orderByDesc('start_time')
            ->paginate(15)
            ->withQueryString();

        $lastSyncedAtRaw = GoogleCalendarEvent::max('last_synced_at');
        $lastSyncedAt = $lastSyncedAtRaw ? Carbon::parse($lastSyncedAtRaw) : null;
        $hasIcalConfigured = ! empty(config('services.google_calendar.ical_url'));

        $totalUpcoming = GoogleCalendarEvent::where('start_time', '>=', $now)->count();
        $totalToday = GoogleCalendarEvent::whereDate('start_time', $now->toDateString())->count();
        $totalPast = GoogleCalendarEvent::where('start_time', '<', $now)->count();
        $totalAll = GoogleCalendarEvent::count();

        return view('admin.google-calendar.index', compact(
            'events',
            'search',
            'timeframe',
            'date',
            'startDate',
            'endDate',
            'lastSyncedAt',
            'hasIcalConfigured',
            'totalUpcoming',
            'totalToday',
            'totalPast',
            'totalAll'
        ));
    }

    /**
     * Display full details of a specific Google Calendar event.
     */
    public function show(int $id): View
    {
        $event = GoogleCalendarEvent::findOrFail($id);

        return view('admin.google-calendar.show', compact('event'));
    }

    /**
     * Trigger manual synchronization from Google Calendar.
     */
    public function sync(GoogleCalendarSyncService $service): RedirectResponse
    {
        $result = $service->sync();

        if ($result['success']) {
            return redirect()
                ->route('admin.google-calendar.index')
                ->with('success', $result['message']);
        }

        return redirect()
            ->route('admin.google-calendar.index')
            ->with('error', $result['message']);
    }
}
