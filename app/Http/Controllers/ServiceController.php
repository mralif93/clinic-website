<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Contracts\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('pages.services.index', [
            'services' => $services,
        ]);
    }

    public function show(string $slug): View
    {
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $otherServices = Service::where('is_active', true)
            ->where('id', '!=', $service->id)
            ->take(3)
            ->get();

        return view('pages.services.show', [
            'service' => $service,
            'otherServices' => $otherServices,
        ]);
    }
}
