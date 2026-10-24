<?php

namespace App\Policies;

use App\Models\AppointmentRequest;
use App\Models\User;

class AppointmentRequestPolicy
{
    /**
     * Determine whether the user can view any appointment requests.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'receptionist']);
    }

    /**
     * Determine whether the user can view the appointment request.
     * Receptionist can only view requests belonging to their branch.
     */
    public function view(User $user, AppointmentRequest $appointmentRequest): bool
    {
        if ($user->hasRole('super_admin')) {
            return true;
        }

        if ($user->hasRole('receptionist')) {
            return $user->branch_id && $user->branch_id === $appointmentRequest->branch_id;
        }

        return false;
    }

    /**
     * Determine whether the user can create appointment requests.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'receptionist']);
    }

    /**
     * Determine whether the user can update the appointment request.
     * Receptionist can only update requests belonging to their branch.
     */
    public function update(User $user, AppointmentRequest $appointmentRequest): bool
    {
        if ($user->hasRole('super_admin')) {
            return true;
        }

        if ($user->hasRole('receptionist')) {
            return $user->branch_id && $user->branch_id === $appointmentRequest->branch_id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the appointment request.
     * Only super_admin can delete records.
     */
    public function delete(User $user, AppointmentRequest $appointmentRequest): bool
    {
        return $user->hasRole('super_admin');
    }

    /**
     * Determine whether the user can bulk delete appointment requests.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasRole('super_admin');
    }
}
