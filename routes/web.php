<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Dar Al Uloom Oral & Dental Surgery Clinic
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', HomeController::class)->name('home');

// About Us
Route::get('/about', [PageController::class, 'about'])->name('about');

// Services (List & Single Detail)
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');

// Doctors (List & Profile Detail)
Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
Route::get('/doctors/{doctor}', [DoctorController::class, 'show'])->name('doctors.show');

// Branches (Riyadh, Jeddah, and Taif details & maps)
Route::get('/branches', [BranchController::class, 'index'])->name('branches.index');

// Contact Us
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Appointment Booking Page (Placeholder for Phase 4 Livewire)
Route::get('/booking', [PageController::class, 'booking'])->name('booking.index');

// Language Switcher (ar / en)
Route::get('/language/{locale}', function (string $locale) {
    if (in_array($locale, ['ar', 'en'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('language.switch');
