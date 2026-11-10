<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
            'appointment_date' => ['required', 'date', 'after:today'],
            'appointment_time' => ['required', 'string'],
            'client_name' => ['required', 'string', 'max:255'],
            'client_email' => ['required', 'email', 'max:255'],
            'client_phone' => ['required', 'string', 'max:20'],
            'client_age' => ['nullable', 'integer', 'min:1', 'max:120'],
            'reason_for_visit' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
