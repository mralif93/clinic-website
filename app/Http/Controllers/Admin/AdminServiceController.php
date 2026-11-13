<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminServiceController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('q');
        $category = $request->query('category');
        $status = $request->query('status'); // active, inactive

        $query = Service::query();

        if ($search) {
            $query->where(function ($q) use ($search): void {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('summary', 'like', "%{$search}%")
                    ->orWhere('target_audience', 'like', "%{$search}%");
            });
        }

        if ($category) {
            $query->where('category', $category);
        }

        if ($status !== null && $status !== '') {
            $query->where('is_active', $status === 'active');
        }

        $services = $query->orderBy('sort_order')->paginate(15)->withQueryString();

        $categories = Service::distinct()->pluck('category')->filter()->values();

        return view('admin.services.index', [
            'services' => $services,
            'search' => $search,
            'selectedCategory' => $category,
            'selectedStatus' => $status,
            'categories' => $categories,
        ]);
    }

    public function create(): View
    {
        return view('admin.services.form', [
            'service' => new Service,
            'isEdit' => false,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'target_audience' => ['nullable', 'string', 'max:255'],
            'summary' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'deposit_amount' => ['required', 'numeric', 'min:0'],
            'duration_minutes' => ['required', 'integer', 'min:15'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'allows_online' => ['boolean'],
            'allows_in_person' => ['boolean'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
            $validated['image_path'] = 'storage/'.$path;
        }

        $validated['slug'] = Str::slug($validated['name']).'-'.Str::random(4);
        $validated['allows_online'] = $request->boolean('allows_online');
        $validated['allows_in_person'] = $request->boolean('allows_in_person');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Perkhidmatan baharu berjaya didaftarkan.');
    }

    public function edit(int $id): View
    {
        $service = Service::findOrFail($id);

        return view('admin.services.form', [
            'service' => $service,
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'target_audience' => ['nullable', 'string', 'max:255'],
            'summary' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'deposit_amount' => ['required', 'numeric', 'min:0'],
            'duration_minutes' => ['required', 'integer', 'min:15'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'allows_online' => ['boolean'],
            'allows_in_person' => ['boolean'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('image')) {
            if ($service->image_path && Str::startsWith($service->image_path, 'storage/')) {
                $rawPath = Str::after($service->image_path, 'storage/');
                if (Storage::disk('public')->exists($rawPath)) {
                    Storage::disk('public')->delete($rawPath);
                }
            }
            $path = $request->file('image')->store('services', 'public');
            $validated['image_path'] = 'storage/'.$path;
        }

        $validated['allows_online'] = $request->boolean('allows_online');
        $validated['allows_in_person'] = $request->boolean('allows_in_person');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Perkhidmatan berjaya dikemaskini.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Perkhidmatan telah dipadam.');
    }
}
