<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use App\Models\Practitioner;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'service_id' => ['required', 'exists:services,id'],
            'practitioner_id' => ['nullable', 'exists:practitioners,id'],
            'session_mode' => ['required', 'in:in_person,online'],
            'appointment_date' => [
                'required',
                'date',
                'after:today',
                function (string $attribute, mixed $value, Closure $fail): void {
                    $practitionerId = $this->input('practitioner_id');
                    if ($practitionerId && $value) {
                        $practitioner = Practitioner::find($practitionerId);
                        if ($practitioner) {
                            // Check specific blocked / leave dates
                            if (! empty($practitioner->blocked_dates) && in_array($value, (array) $practitioner->blocked_dates, true)) {
                                $fail('Pakar pilihan sedang bercuti pada tarikh tersebut. Sila pilih tarikh lain.');

                                return;
                            }

                            // Check regular working routine
                            if (! empty($practitioner->working_days)) {
                                $dayOfWeek = Carbon::parse($value)->format('l');
                                if (! in_array($dayOfWeek, $practitioner->working_days, true)) {
                                    $fail('Pakar pilihan tidak bertugas pada hari tersebut. Sila pilih tarikh lain.');
                                }
                            }
                        }
                    }
                },
            ],
            'appointment_time' => [
                'required',
                'string',
                function (string $attribute, mixed $value, Closure $fail): void {
                    $date = $this->input('appointment_date');
                    $practitionerId = $this->input('practitioner_id');

                    if ($practitionerId && $value) {
                        $practitioner = Practitioner::find($practitionerId);
                        if ($practitioner && ! empty($practitioner->available_slots)) {
                            if (! in_array($value, $practitioner->available_slots, true)) {
                                $fail('Pakar pilihan tidak menyediakan slot masa pada waktu ini.');

                                return;
                            }
                        }
                    }

                    if ($date && $value && $practitionerId) {
                        $isBooked = Appointment::whereDate('appointment_date', $date)
                            ->where('appointment_time', $value)
                            ->where('practitioner_id', $practitionerId)
                            ->whereIn('status', ['pending', 'confirmed'])
                            ->exists();

                        if ($isBooked) {
                            $fail('Slot masa terpilih telah diambil oleh pelanggan lain untuk pakar berkenaan. Sila pilih waktu atau pakar yang lain.');
                        }
                    }
                },
            ],
            'client_name' => ['required', 'string', 'max:255'],
            'client_email' => ['required', 'email', 'max:255'],
            'client_phone' => ['required', 'string', 'max:20'],
            'client_age' => ['nullable', 'integer', 'min:1', 'max:120'],
            'reason_for_visit' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
