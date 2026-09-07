<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ResetAdminUser extends Command
{
    protected $signature = 'admin:reset';
    protected $description = 'Reset or create the admin user';

    public function handle(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@lolita.com'],
            [
                'name'     => 'Admin',
                'password' => bcrypt('admin123'),
                'is_admin' => true,
            ]
        );

        // Force-set is_admin bypassing mass assignment
        User::where('email', 'admin@lolita.com')->update(['is_admin' => true]);

        $fresh = User::where('email', 'admin@lolita.com')->first();
        $this->info("Admin user ready.");
        $this->line("  Email    : {$fresh->email}");
        $this->line("  is_admin : {$fresh->is_admin}");
        $this->line("  Password : admin123");
    }
}
