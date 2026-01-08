<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Notifications\SubscriptionExpiredNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class CheckExpiredSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:check-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for expired subscriptions and deactivate tenants';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for expired subscriptions...');

        $expiredSubscriptions = Subscription::with(['tenant', 'plan'])
            ->where('status', Subscription::STATUS_ACTIVE)
            ->whereDate('ends_at', '<', now())
            ->get();

        foreach ($expiredSubscriptions as $subscription) {
            try {
                // Update subscription status
                $subscription->update([
                    'status' => Subscription::STATUS_EXPIRED,
                ]);

                // Deactivate tenant
                $subscription->tenant->update([
                    'is_active' => false,
                ]);

                // Send notification
                Notification::route('mail', $subscription->tenant->email)
                    ->notify(new SubscriptionExpiredNotification($subscription));

                $this->warn("Expired subscription for {$subscription->tenant->name} - Tenant deactivated");
            } catch (\Exception $e) {
                $this->error("Failed to process expired subscription for {$subscription->tenant->name}: {$e->getMessage()}");
            }
        }

        $count = $expiredSubscriptions->count();
        $this->info("Processed {$count} expired subscription(s).");
        
        return 0;
    }
}
