<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Article;
use App\Models\Practitioner;
use App\Models\ScreenerResponse;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;

class AdminDashboardController extends Controller
{
    public function __invoke(): View
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();

        // Core Metrics
        $totalAppointments = Appointment::count();
        $pendingAppointments = Appointment::where('status', 'pending')->count();
        $confirmedAppointments = Appointment::where('status', 'confirmed')->count();
        $todayAppointments = Appointment::whereDate('appointment_date', $today)->count();
        $totalScreeners = ScreenerResponse::count();
        $totalDepositCollected = Appointment::where('payment_status', 'paid')->sum('deposit_amount');

        // Recent Appointments (with client, service, practitioner)
        $recentAppointments = Appointment::with(['service', 'practitioner'])
            ->latest()
            ->take(6)
            ->get();

        // Recent DASS-21 Screeners
        $recentScreeners = ScreenerResponse::latest()
            ->take(5)
            ->get();

        // Active Practitioners with today's status
        $practitioners = Practitioner::where('is_active', true)
            ->orderBy('sort_order')
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'totalAppointments' => $totalAppointments,
            'pendingAppointments' => $pendingAppointments,
            'confirmedAppointments' => $confirmedAppointments,
            'todayAppointments' => $todayAppointments,
            'totalDepositCollected' => $totalDepositCollected,
            'totalScreeners' => $totalScreeners,
            'recentAppointments' => $recentAppointments,
            'recentScreeners' => $recentScreeners,
            'practitioners' => $practitioners,
            'totalPractitioners' => Practitioner::count(),
            'totalServices' => Service::count(),
            'totalArticles' => Article::count(),
        ]);
    }
}
