<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Notifications\SubscriptionExpiringNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class CheckExpiringSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:check-expiring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for expiring subscriptions and send notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for expiring subscriptions...');

        // Check for subscriptions expiring in 7, 3, and 1 days
        $notificationDays = [7, 3, 1];

        foreach ($notificationDays as $days) {
            $date = now()->addDays($days)->startOfDay();
            
            $subscriptions = Subscription::with(['tenant', 'plan'])
                ->where('status', Subscription::STATUS_ACTIVE)
                ->whereDate('ends_at', $date)
                ->get();

            foreach ($subscriptions as $subscription) {
                try {
                    Notification::route('mail', $subscription->tenant->email)
                        ->notify(new SubscriptionExpiringNotification($subscription, $days));
                    
                    $this->info("Sent expiring notification to {$subscription->tenant->name} ({$days} days)");
                } catch (\Exception $e) {
                    $this->error("Failed to send notification to {$subscription->tenant->name}: {$e->getMessage()}");
                }
            }
        }

        $this->info('Finished checking expiring subscriptions.');
        return 0;
    }
}
