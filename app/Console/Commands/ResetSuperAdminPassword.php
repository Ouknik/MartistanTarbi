<?php

namespace App\Console\Commands;

use App\Models\SuperAdmin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetSuperAdminPassword extends Command
{
    protected $signature = 'superadmin:reset-password {email?} {password?}';
    protected $description = 'Reset Super Admin password';

    public function handle()
    {
        $email = $this->argument('email') ?? 'admin@maristan.ma';
        $password = $this->argument('password') ?? 'password';

        $admin = SuperAdmin::where('email', $email)->first();

        if (!$admin) {
            $this->error("Super Admin with email {$email} not found!");
            return 1;
        }

        $admin->password = Hash::make($password);
        $admin->save();

        $this->info("Password reset successfully!");
        $this->info("Email: {$email}");
        $this->info("Password: {$password}");

        return 0;
    }
}
