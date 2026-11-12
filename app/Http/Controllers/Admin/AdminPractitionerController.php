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
    public function index(): View
    {
        $practitioners = Practitioner::orderBy('sort_order')->paginate(15);

        return view('admin.practitioners.index', [
            'practitioners' => $practitioners,
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
        $validated['specialties'] = array_map('trim', explode(',', $request->input('specialties', '')));
        $validated['languages'] = array_map('trim', explode(',', $request->input('languages', 'Bahasa Melayu, English')));
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

        $validated['specialties'] = array_map('trim', explode(',', $request->input('specialties', '')));
        $validated['languages'] = array_map('trim', explode(',', $request->input('languages', '')));
        $validated['accepts_online'] = $request->boolean('accepts_online');
        $validated['accepts_in_person'] = $request->boolean('accepts_in_person');
        $validated['is_active'] = $request->boolean('is_active');

        $practitioner->update($validated);

        return redirect()->route('admin.practitioners.index')->with('success', 'Profil pakar berjaya dikemaskini.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $practitioner = Practitioner::findOrFail($id);
        $practitioner->delete();

        return redirect()->route('admin.practitioners.index')->with('success', 'Profil pakar telah dipadam.');
    }
}
