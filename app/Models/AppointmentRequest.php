<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppointmentRequest extends Model
{
    use HasFactory;

    public const STATUS_NEW = 'new';
    public const STATUS_CONTACTED = 'contacted';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_CANCELLED = 'cancelled';

    public const STATUSES = [
        self::STATUS_NEW => [
            'label_ar' => 'جديد',
            'label_en' => 'New',
            'color' => 'warning',
        ],
        self::STATUS_CONTACTED => [
            'label_ar' => 'تم التواصل',
            'label_en' => 'Contacted',
            'color' => 'info',
        ],
        self::STATUS_CONFIRMED => [
            'label_ar' => 'مؤكد',
            'label_en' => 'Confirmed',
            'color' => 'success',
        ],
        self::STATUS_CANCELLED => [
            'label_ar' => 'ملغي',
            'label_en' => 'Cancelled',
            'color' => 'danger',
        ],
    ];

    protected $fillable = [
        'patient_name',
        'phone',
        'branch_id',
        'service_id',
        'doctor_id',
        'preferred_date',
        'preferred_time',
        'notes',
        'status',
    ];

    protected $casts = [
        'preferred_date' => 'date',
    ];

    /**
     * Relationship with Branch.
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Relationship with Service.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Relationship with Doctor (optional).
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Scope for a specific branch.
     */
    public function scopeForBranch(Builder $query, ?int $branchId): Builder
    {
        if (! $branchId) {
            return $query;
        }

        return $query->where('branch_id', $branchId);
    }

    /**
     * Scope by status.
     */
    public function scopeStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for appointments requested for today or created today.
     */
    public function scopeCreatedToday(Builder $query): Builder
    {
        return $query->whereDate('created_at', Carbon::today());
    }

    /**
     * Status label localized.
     */
    public function getStatusLabelAttribute(): string
    {
        $locale = app()->getLocale();
        $config = self::STATUSES[$this->status] ?? null;

        if (! $config) {
            return $this->status;
        }

        return $locale === 'en' ? $config['label_en'] : $config['label_ar'];
    }

    /**
     * Badge color for status.
     */
    public function getStatusColorAttribute(): string
    {
        return self::STATUSES[$this->status]['color'] ?? 'gray';
    }
}
