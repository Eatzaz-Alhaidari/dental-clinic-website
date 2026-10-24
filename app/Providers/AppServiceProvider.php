<?php

namespace App\Providers;

use App\Models\AppointmentRequest;
use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Service;
use App\Policies\AppointmentRequestPolicy;
use App\Policies\BranchPolicy;
use App\Policies\DoctorPolicy;
use App\Policies\ServicePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(AppointmentRequest::class, AppointmentRequestPolicy::class);
        Gate::policy(Branch::class, BranchPolicy::class);
        Gate::policy(Service::class, ServicePolicy::class);
        Gate::policy(Doctor::class, DoctorPolicy::class);
    }
}
