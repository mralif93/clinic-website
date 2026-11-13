<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentStatusUpdatedMail;
use App\Models\Appointment;
use App\Models\Practitioner;
use App\Models\Service;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminAppointmentController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status');
        $search = $request->query('q');
        $serviceId = $request->query('service_id');
        $practitionerId = $request->query('practitioner_id');
        $mode = $request->query('mode');

        $query = Appointment::with(['service', 'practitioner'])->latest();

        if ($status && in_array($status, ['pending', 'confirmed', 'completed', 'cancelled'])) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search): void {
                $q->where('booking_code', 'like', "%{$search}%")
                    ->orWhere('client_name', 'like', "%{$search}%")
                    ->orWhere('client_phone', 'like', "%{$search}%")
                    ->orWhere('client_email', 'like', "%{$search}%");
            });
        }

        if ($serviceId) {
            $query->where('service_id', $serviceId);
        }

        if ($practitionerId) {
            $query->where('practitioner_id', $practitionerId);
        }

        if ($mode && in_array($mode, ['in_person', 'online'])) {
            $query->where('session_mode', $mode);
        }

        $appointments = $query->paginate(15)->withQueryString();

        $services = Service::orderBy('name')->get(['id', 'name']);
        $practitioners = Practitioner::orderBy('name')->get(['id', 'name']);

        return view('admin.appointments.index', [
            'appointments' => $appointments,
            'currentStatus' => $status,
            'search' => $search,
            'serviceId' => $serviceId,
            'practitionerId' => $practitionerId,
            'mode' => $mode,
            'services' => $services,
            'practitioners' => $practitioners,
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
        $oldStatus = $appointment->status;

        $appointment->update([
            'status' => $request->input('status'),
            'payment_status' => $request->input('payment_status'),
            'admin_notes' => $request->input('admin_notes'),
            'meeting_url' => $request->input('meeting_url'),
        ]);

        // Send status update email if status changed
        if ($oldStatus !== $appointment->status && ! empty($appointment->client_email)) {
            try {
                Mail::to($appointment->client_email)->send(new AppointmentStatusUpdatedMail($appointment));
            } catch (Exception $e) {
                Log::warning('Gagal menghantar emel kemas kini status: '.$e->getMessage());
            }
        }

        return redirect()->route('admin.appointments.show', $appointment->id)
            ->with('status', 'Status tempahan berjaya dikemaskini dan emel notifikasi telah dihantar!');
    }
}
