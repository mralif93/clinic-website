<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScreenerResponse;
use Illuminate\Contracts\View\View;

class AdminScreenerController extends Controller
{
    public function index(): View
    {
        $screeners = ScreenerResponse::latest()->paginate(15);

        return view('admin.screeners.index', [
            'screeners' => $screeners,
        ]);
    }

    public function show(int $id): View
    {
        $screener = ScreenerResponse::findOrFail($id);

        return view('admin.screeners.show', [
            'screener' => $screener,
        ]);
    }
}
