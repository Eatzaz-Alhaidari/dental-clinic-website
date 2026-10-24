<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Doctor extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = [
        'name',
        'specialty',
        'bio',
    ];

    protected $fillable = [
        'name',
        'specialty',
        'bio',
        'photo',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope only active doctors.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Branches where this doctor works.
     */
    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(Branch::class, 'branch_doctor')
            ->withTimestamps();
    }

    /**
     * Services offered by this doctor.
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'doctor_service')
            ->withTimestamps();
    }

    /**
     * Appointment requests for this doctor.
     */
    public function appointmentRequests(): HasMany
    {
        return $this->hasMany(AppointmentRequest::class);
    }
}
