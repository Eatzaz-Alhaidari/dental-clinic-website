<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * About Us page.
     */
    public function about(): View
    {
        $doctorsCount = Doctor::active()->count();
        $servicesCount = Service::active()->count();
        $branches = Branch::active()->get();

        return view('pages.about', compact('doctorsCount', 'servicesCount', 'branches'));
    }

    /**
     * Contact Us page.
     */
    public function contact(): View
    {
        $branches = Branch::active()->get();

        return view('pages.contact', compact('branches'));
    }

    /**
     * Booking appointment page (ready for Livewire form in Phase 4).
     */
    public function booking(): View
    {
        $branches = Branch::active()->get();
        $services = Service::active()->ordered()->get();
        $doctors = Doctor::active()->get();

        return view('pages.booking', compact('branches', 'services', 'doctors'));
    }
}
