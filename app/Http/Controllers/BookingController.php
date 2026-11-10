<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\Practitioner;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function index(): View
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $practitioners = Practitioner::where('is_active', true)->orderBy('sort_order')->get();

        return view('pages.booking.index', [
            'services' => $services,
            'practitioners' => $practitioners,
        ]);
    }

    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $service = Service::findOrFail($validated['service_id']);

        $bookingCode = 'SKM-'.strtoupper(Str::random(6));

        $appointment = Appointment::create([
            'booking_code' => $bookingCode,
            'service_id' => $service->id,
            'practitioner_id' => $validated['practitioner_id'] ?? null,
            'client_name' => $validated['client_name'],
            'client_email' => $validated['client_email'],
            'client_phone' => $validated['client_phone'],
            'client_age' => $validated['client_age'] ?? null,
            'reason_for_visit' => $validated['reason_for_visit'] ?? null,
            'session_mode' => $validated['session_mode'],
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'status' => 'pending',
            'total_amount' => $service->price,
            'deposit_amount' => $service->deposit_amount,
            'payment_status' => 'pending',
        ]);

        return redirect()->route('booking.confirmation', ['booking_code' => $appointment->booking_code]);
    }

    public function confirmation(string $bookingCode): View
    {
        $appointment = Appointment::with(['service', 'practitioner'])
            ->where('booking_code', $bookingCode)
            ->firstOrFail();

        return view('pages.booking.confirmation', [
            'appointment' => $appointment,
        ]);
    }
}
