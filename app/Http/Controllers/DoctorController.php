<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DoctorController extends Controller
{
    /**
     * Display a listing of doctors with optional branch and service filters.
     */
    public function index(Request $request): View
    {
        $query = Doctor::active()->with(['branches', 'services']);

        if ($request->filled('branch_id')) {
            $query->whereHas('branches', fn ($q) => $q->where('branches.id', $request->branch_id));
        }

        if ($request->filled('service_id')) {
            $query->whereHas('services', fn ($q) => $q->where('services.id', $request->service_id));
        }

        $doctors = $query->get();
        $branches = Branch::active()->get();
        $services = Service::active()->ordered()->get();

        return view('pages.doctors.index', compact('doctors', 'branches', 'services'));
    }

    /**
     * Display a specific doctor profile, specialties, schedule, and branches.
     */
    public function show(Doctor $doctor): View
    {
        abort_unless($doctor->is_active, 404);

        $doctor->load(['branches', 'services']);
        $relatedDoctors = Doctor::active()
            ->where('id', '!=', $doctor->id)
            ->take(3)
            ->get();

        return view('pages.doctors.show', compact('doctor', 'relatedDoctors'));
    }
}
