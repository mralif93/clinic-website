<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Practitioner;
use App\Models\ScreenerResponse;
use App\Models\Service;
use Illuminate\Contracts\View\View;

class AdminDashboardController extends Controller
{
    public function __invoke(): View
    {
        $totalAppointments = Appointment::count();
        $pendingAppointments = Appointment::where('status', 'pending')->count();
        $confirmedAppointments = Appointment::where('status', 'confirmed')->count();
        $totalScreeners = ScreenerResponse::count();

        $recentAppointments = Appointment::with(['service', 'practitioner'])
            ->latest()
            ->take(6)
            ->get();

        $recentScreeners = ScreenerResponse::latest()
            ->take(6)
            ->get();

        return view('admin.dashboard', [
            'totalAppointments' => $totalAppointments,
            'pendingAppointments' => $pendingAppointments,
            'confirmedAppointments' => $confirmedAppointments,
            'totalScreeners' => $totalScreeners,
            'recentAppointments' => $recentAppointments,
            'recentScreeners' => $recentScreeners,
            'totalPractitioners' => Practitioner::count(),
            'totalServices' => Service::count(),
        ]);
    }
}
