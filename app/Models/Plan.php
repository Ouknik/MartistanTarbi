<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $connection = 'central';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price_monthly',
        'price_yearly',
        'currency',
        'trial_days',
        'max_doctors',
        'max_patients',
        'max_storage_mb',
        'features',
        'is_active',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'price_monthly' => 'decimal:2',
        'price_yearly' => 'decimal:2',
    ];

    /**
     * Get tenants on this plan
     */
    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }

    /**
     * Scope for active plans
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Check if plan has a specific feature
     */
    public function hasFeature(string $feature): bool
    {
        return in_array($feature, $this->features ?? []);
    }

    /**
     * Get yearly discount percentage
     */
    public function getYearlyDiscountAttribute(): float
    {
        if ($this->price_monthly <= 0) return 0;
        
        $yearlyIfMonthly = $this->price_monthly * 12;
        return round((1 - ($this->price_yearly / $yearlyIfMonthly)) * 100, 1);
    }
}
