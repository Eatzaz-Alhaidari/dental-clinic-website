<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $services = Service::active()->ordered()->get();
        $doctors = Doctor::active()->with(['branches', 'services'])->take(6)->get();
        $branches = Branch::active()->withCount('doctors')->get();

        return view('pages.home', compact('services', 'doctors', 'branches'));
    }
}
