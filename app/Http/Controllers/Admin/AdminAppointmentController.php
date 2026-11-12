<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminAppointmentController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status');

        $query = Appointment::with(['service', 'practitioner'])->latest();

        if ($status && in_array($status, ['pending', 'confirmed', 'completed', 'cancelled'])) {
            $query->where('status', $status);
        }

        $appointments = $query->paginate(15)->withQueryString();

        return view('admin.appointments.index', [
            'appointments' => $appointments,
            'currentStatus' => $status,
            'statusCounts' => [
                'all' => Appointment::count(),
                'pending' => Appointment::where('status', 'pending')->count(),
                'confirmed' => Appointment::where('status', 'confirmed')->count(),
                'completed' => Appointment::where('status', 'completed')->count(),
                'cancelled' => Appointment::where('status', 'cancelled')->count(),
            ],
        ]);
    }

    public function show(int $id): View
    {
        $appointment = Appointment::with(['service', 'practitioner'])
            ->findOrFail($id);

        return view('admin.appointments.show', [
            'appointment' => $appointment,
        ]);
    }

    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:pending,confirmed,completed,cancelled'],
            'payment_status' => ['required', 'in:pending,paid,refunded'],
            'admin_notes' => ['nullable', 'string', 'max:2000'],
            'meeting_url' => ['nullable', 'url', 'max:255'],
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->update([
            'status' => $request->input('status'),
            'payment_status' => $request->input('payment_status'),
            'admin_notes' => $request->input('admin_notes'),
            'meeting_url' => $request->input('meeting_url'),
        ]);

        return back()->with('success', 'Status tempahan berjaya dikemaskini.');
    }
}
