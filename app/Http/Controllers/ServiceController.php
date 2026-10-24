<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index(): View
    {
        $services = Service::active()->ordered()->get();

        return view('pages.services.index', compact('services'));
    }

    /**
     * Display a specific service and its practicing doctors.
     */
    public function show(Service $service): View
    {
        abort_unless($service->is_active, 404);

        $service->load(['doctors' => fn ($q) => $q->active()->with('branches')]);
        $relatedServices = Service::active()
            ->where('id', '!=', $service->id)
            ->ordered()
            ->take(3)
            ->get();

        return view('pages.services.show', compact('service', 'relatedServices'));
    }
}
