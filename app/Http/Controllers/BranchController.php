<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\View\View;

class BranchController extends Controller
{
    /**
     * Display clinic branches (Sana'a and Ibb) with doctors, contacts, maps and working hours.
     */
    public function index(): View
    {
        $branches = Branch::active()
            ->with(['doctors' => fn ($q) => $q->active()->with('services')])
            ->get();

        return view('pages.branches.index', compact('branches'));
    }
}
