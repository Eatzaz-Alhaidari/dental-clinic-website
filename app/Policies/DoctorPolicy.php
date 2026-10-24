<?php

namespace App\Policies;

use App\Models\Doctor;
use App\Models\User;

class DoctorPolicy
{
    /**
     * Determine whether the user can view any doctors.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'receptionist']);
    }

    /**
     * Determine whether the user can view the doctor.
     */
    public function view(User $user, Doctor $doctor): bool
    {
        return $user->hasAnyRole(['super_admin', 'receptionist']);
    }

    /**
     * Determine whether the user can create doctors.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('super_admin');
    }

    /**
     * Determine whether the user can update the doctor.
     */
    public function update(User $user, Doctor $doctor): bool
    {
        return $user->hasRole('super_admin');
    }

    /**
     * Determine whether the user can delete the doctor.
     */
    public function delete(User $user, Doctor $doctor): bool
    {
        return $user->hasRole('super_admin');
    }
}
