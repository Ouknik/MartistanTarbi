<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use App\Notifications\TrialEndingNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class CheckTrialEnding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:check-trial-ending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for trial periods ending soon and send notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for trial periods ending soon...');

        // Check for trials ending in 7, 3, and 1 days
        $notificationDays = [7, 3, 1];

        foreach ($notificationDays as $days) {
            $date = now()->addDays($days)->startOfDay();
            
            $tenants = Tenant::where('is_active', true)
                ->whereNotNull('trial_ends_at')
                ->whereDate('trial_ends_at', $date)
                ->get();

            foreach ($tenants as $tenant) {
                try {
                    Notification::route('mail', $tenant->email)
                        ->notify(new TrialEndingNotification($tenant, $days));
                    
                    $this->info("Sent trial ending notification to {$tenant->name} ({$days} days)");
                } catch (\Exception $e) {
                    $this->error("Failed to send notification to {$tenant->name}: {$e->getMessage()}");
                }
            }
        }

        $this->info('Finished checking trial periods.');
        return 0;
    }
}
