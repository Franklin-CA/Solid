<?php

namespace App\Console\Commands;
use App\Models\User;
use Illuminate\Console\Command;

class UpdateUserStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-user-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = now();

        User::where('expiry_date', '<', $today)
            ->update(['is_active' => false]); // Set inactive for expired members
    
        User::where('expiry_date', '>=', $today)
            ->update(['is_active' => true]); // Set active for valid members
    }
}
