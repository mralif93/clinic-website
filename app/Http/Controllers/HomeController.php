<?php

namespace App\Http\Controllers;

use App\Models\Practitioner;
use App\Models\Service;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $featuredServices = Service::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        $practitioners = Practitioner::where('is_active', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        return view('pages.home', [
            'featuredServices' => $featuredServices,
            'practitioners' => $practitioners,
        ]);
    }
}
