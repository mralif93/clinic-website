<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScreenerResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AdminScreenerController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('q');
        $severity = $request->query('severity');

        $query = ScreenerResponse::query();

        if ($search) {
            $query->where(function ($q) use ($search): void {
                $q->where('client_name', 'like', "%{$search}%")
                    ->orWhere('client_phone', 'like', "%{$search}%")
                    ->orWhere('client_email', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%");
            });
        }

        if ($severity) {
            $query->where(function ($q) use ($severity): void {
                $q->where('depression_severity', $severity)
                    ->orWhere('anxiety_severity', $severity)
                    ->orWhere('stress_severity', $severity);
            });
        }

        $screeners = $query->latest()->paginate(15)->withQueryString();

        return view('admin.screeners.index', [
            'screeners' => $screeners,
            'search' => $search,
            'selectedSeverity' => $severity,
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
