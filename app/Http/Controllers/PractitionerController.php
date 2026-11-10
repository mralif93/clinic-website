<?php

namespace App\Http\Controllers;

use App\Models\Practitioner;
use Illuminate\Contracts\View\View;

class PractitionerController extends Controller
{
    public function index(): View
    {
        $practitioners = Practitioner::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('pages.practitioners.index', [
            'practitioners' => $practitioners,
        ]);
    }

    public function show(string $slug): View
    {
        $practitioner = Practitioner::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('pages.practitioners.show', [
            'practitioner' => $practitioner,
        ]);
    }
}
