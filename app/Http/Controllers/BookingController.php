<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Mail\AppointmentCreatedMail;
use App\Models\Appointment;
use App\Models\Practitioner;
use App\Models\Service;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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

    public function getBookedSlots(Request $request): JsonResponse
    {
        $request->validate([
            'date' => ['required', 'date'],
            'practitioner_id' => ['nullable', 'exists:practitioners,id'],
        ]);

        $selectedDate = $request->query('date');
        $dateCarbon = Carbon::parse($selectedDate);
        $dayOfWeek = $dateCarbon->format('l'); // Monday, Tuesday, ...

        $defaultSlots = ['10:00 AM', '11:30 AM', '02:00 PM', '03:30 PM', '05:00 PM', '08:00 PM'];
        $allowedSlots = $defaultSlots;
        $isWorkingDay = true;
        $isOnLeave = false;

        if ($request->filled('practitioner_id')) {
            $practitioner = Practitioner::find($request->query('practitioner_id'));
            if ($practitioner) {
                // Check weekly working routine
                $workingDays = $practitioner->working_days ?: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
                $isWorkingDay = in_array($dayOfWeek, (array) $workingDays, true);

                // Check specific blocked/leave dates
                $blockedDates = (array) ($practitioner->blocked_dates ?? []);
                if (in_array($selectedDate, $blockedDates, true)) {
                    $isOnLeave = true;
                }

                if (! empty($practitioner->available_slots)) {
                    $allowedSlots = $practitioner->available_slots;
                }
            }
        }

        $query = Appointment::whereDate('appointment_date', $selectedDate)
            ->whereIn('status', ['pending', 'confirmed']);

        if ($request->filled('practitioner_id')) {
            $query->where('practitioner_id', $request->query('practitioner_id'));
        }

        $bookedTimes = $query->pluck('appointment_time')
            ->map(function ($time) {
                return date('h:i A', strtotime($time));
            })
            ->unique()
            ->values();

        return response()->json([
            'is_working_day' => $isWorkingDay,
            'is_on_leave' => $isOnLeave,
            'day_name' => $dayOfWeek,
            'allowed_slots' => $allowedSlots,
            'booked_slots' => $bookedTimes,
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

        // Send confirmation email asynchronously / safely
        try {
            Mail::to($appointment->client_email)->send(new AppointmentCreatedMail($appointment));
        } catch (Exception $e) {
            Log::warning('Gagal menghantar emel tempahan: '.$e->getMessage());
        }

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

    public function uploadReceipt(Request $request, string $bookingCode): RedirectResponse
    {
        $request->validate([
            'receipt' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'], // 5MB max
        ]);

        $appointment = Appointment::where('booking_code', $bookingCode)->firstOrFail();

        if ($request->hasFile('receipt')) {
            // Delete previous receipt if existed
            if ($appointment->deposit_receipt && Storage::disk('public')->exists($appointment->deposit_receipt)) {
                Storage::disk('public')->delete($appointment->deposit_receipt);
            }

            $path = $request->file('receipt')->store('receipts', 'public');
            $appointment->update([
                'deposit_receipt' => $path,
                'payment_method' => 'bank_transfer',
            ]);
        }

        return redirect()->route('booking.confirmation', ['booking_code' => $appointment->booking_code])
            ->with('status', 'Resit bayaran deposit anda telah berjaya dimuat naik! Pihak klinik akan mengesahkan slot tempahan anda tidak lama lagi.');
    }
}
