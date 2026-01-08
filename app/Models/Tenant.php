<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    /**
     * Indicates if the IDs are auto-incrementing.
     * We use custom string IDs (slug-based)
     */
    public $incrementing = false;

    /**
     * The data type of the primary key.
     */
    protected $keyType = 'string';

    /**
     * Get the value indicating whether the IDs are incrementing.
     * Override to ensure we use string IDs
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Get the key type.
     * Override to ensure string key type
     */
    public function getKeyType()
    {
        return 'string';
    }

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'logo',
        'plan_id',
        'is_active',
        'trial_ends_at',
        'subscription_ends_at',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
        'is_active' => 'boolean',
        'trial_ends_at' => 'datetime',
        'subscription_ends_at' => 'datetime',
    ];

    /**
     * Get custom columns for the tenant
     */
    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'email',
            'phone',
            'address',
            'city',
            'logo',
            'plan_id',
            'is_active',
            'trial_ends_at',
            'subscription_ends_at',
        ];
    }

    /**
     * Get the plan associated with the tenant
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Get subscription history
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Check if tenant is on trial
     */
    public function onTrial(): bool
    {
        return $this->trial_ends_at && $this->trial_ends_at->isFuture();
    }

    /**
     * Check if subscription is active
     */
    public function hasActiveSubscription(): bool
    {
        return $this->subscription_ends_at && $this->subscription_ends_at->isFuture();
    }

    /**
     * Check if tenant can access the system
     */
    public function canAccess(): bool
    {
        return $this->is_active && ($this->onTrial() || $this->hasActiveSubscription());
    }
}
