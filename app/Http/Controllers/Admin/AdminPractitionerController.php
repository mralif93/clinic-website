<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Practitioner;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPractitionerController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('q');
        $mode = $request->query('mode'); // online, in_person
        $status = $request->query('status'); // active, inactive

        $query = Practitioner::query();

        if ($search) {
            $query->where(function ($q) use ($search): void {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('registration_number', 'like', "%{$search}%")
                    ->orWhere('bio', 'like', "%{$search}%");
            });
        }

        if ($mode === 'online') {
            $query->where('accepts_online', true);
        } elseif ($mode === 'in_person') {
            $query->where('accepts_in_person', true);
        }

        if ($status !== null && $status !== '') {
            $query->where('is_active', $status === 'active');
        }

        $practitioners = $query->orderBy('sort_order')->paginate(15)->withQueryString();

        return view('admin.practitioners.index', [
            'practitioners' => $practitioners,
            'search' => $search,
            'selectedMode' => $mode,
            'selectedStatus' => $status,
        ]);
    }

    public function create(): View
    {
        return view('admin.practitioners.form', [
            'practitioner' => new Practitioner,
            'isEdit' => false,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'registration_number' => ['nullable', 'string', 'max:100'],
            'bio' => ['nullable', 'string'],
            'specialties' => ['nullable', 'string'],
            'languages' => ['nullable', 'string'],
            'working_days' => ['nullable', 'array'],
            'working_days.*' => ['string', 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday'],
            'available_slots' => ['nullable', 'array'],
            'available_slots.*' => ['string'],
            'blocked_dates' => ['nullable', 'array'],
            'blocked_dates.*' => ['string', 'date_format:Y-m-d'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'photo_path' => ['nullable', 'string', 'max:255'],
            'accepts_online' => ['boolean'],
            'accepts_in_person' => ['boolean'],
            'is_active' => ['boolean'],
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('practitioners', 'public');
            $validated['photo_path'] = 'storage/'.$path;
        }

        $validated['slug'] = Str::slug($validated['name']).'-'.Str::random(4);
        $validated['specialties'] = array_filter(array_map('trim', explode(',', $request->input('specialties', ''))));
        $validated['languages'] = array_filter(array_map('trim', explode(',', $request->input('languages', 'Bahasa Melayu, English'))));
        $validated['working_days'] = $request->input('working_days', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']);
        $validated['available_slots'] = $request->input('available_slots', ['10:00 AM', '11:30 AM', '02:00 PM', '03:30 PM', '05:00 PM', '08:00 PM']);
        $validated['blocked_dates'] = array_values(array_filter(array_unique($request->input('blocked_dates', []))));
        $validated['accepts_online'] = $request->boolean('accepts_online');
        $validated['accepts_in_person'] = $request->boolean('accepts_in_person');
        $validated['is_active'] = $request->boolean('is_active');

        Practitioner::create($validated);

        return redirect()->route('admin.practitioners.index')->with('success', 'Pakar baharu berjaya didaftarkan.');
    }

    public function edit(int $id): View
    {
        $practitioner = Practitioner::findOrFail($id);

        return view('admin.practitioners.form', [
            'practitioner' => $practitioner,
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $practitioner = Practitioner::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'registration_number' => ['nullable', 'string', 'max:100'],
            'bio' => ['nullable', 'string'],
            'specialties' => ['nullable', 'string'],
            'languages' => ['nullable', 'string'],
            'working_days' => ['nullable', 'array'],
            'working_days.*' => ['string', 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday'],
            'available_slots' => ['nullable', 'array'],
            'available_slots.*' => ['string'],
            'blocked_dates' => ['nullable', 'array'],
            'blocked_dates.*' => ['string', 'date_format:Y-m-d'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'photo_path' => ['nullable', 'string', 'max:255'],
            'accepts_online' => ['boolean'],
            'accepts_in_person' => ['boolean'],
            'is_active' => ['boolean'],
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('practitioners', 'public');
            $validated['photo_path'] = 'storage/'.$path;
        }

        $validated['specialties'] = array_filter(array_map('trim', explode(',', $request->input('specialties', ''))));
        $validated['languages'] = array_filter(array_map('trim', explode(',', $request->input('languages', ''))));
        $validated['working_days'] = $request->input('working_days', []);
        $validated['available_slots'] = $request->input('available_slots', []);
        $validated['blocked_dates'] = array_values(array_filter(array_unique($request->input('blocked_dates', []))));
        $validated['accepts_online'] = $request->boolean('accepts_online');
        $validated['accepts_in_person'] = $request->boolean('accepts_in_person');
        $validated['is_active'] = $request->boolean('is_active');

        $practitioner->update($validated);

        return redirect()->route('admin.practitioners.index')->with('success', 'Profil, jadual slot, dan senarai cuti pakar berjaya dikemaskini.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $practitioner = Practitioner::findOrFail($id);
        $practitioner->delete();

        return redirect()->route('admin.practitioners.index')->with('success', 'Profil pakar telah dipadam.');
    }
}
