<?php

namespace App\Models;

use App\Services\PhoneService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Branch extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = [
        'name',
        'address',
        'working_hours',
    ];

    protected $fillable = [
        'name',
        'address',
        'whatsapp_number',
        'phone',
        'working_hours',
        'map_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Mutator to ensure whatsapp_number is always stored in international format
     * without '+' or leading zeros (e.g. 967771234567).
     */
    protected function whatsappNumber(): Attribute
    {
        return Attribute::make(
            set: fn (?string $value) => $value ? PhoneService::normalize($value) : null,
        );
    }

    /**
     * Scope only active branches.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Doctors working in this branch.
     */
    public function doctors(): BelongsToMany
    {
        return $this->belongsToMany(Doctor::class, 'branch_doctor')
            ->withTimestamps();
    }

    /**
     * Appointment requests for this branch.
     */
    public function appointmentRequests(): HasMany
    {
        return $this->hasMany(AppointmentRequest::class);
    }

    /**
     * Staff/Users assigned to this branch.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Clean WhatsApp number suitable for wa.me URL (pure digits).
     */
    public function getCleanWhatsappNumberAttribute(): string
    {
        return preg_replace('/[^0-9]/', '', $this->whatsapp_number ?? '');
    }
}
