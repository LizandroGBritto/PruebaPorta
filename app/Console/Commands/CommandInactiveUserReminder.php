<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendInactiveUsersEmail;
use Illuminate\Support\Facades\Log;

class CommandInactiveUserReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send-inactive-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder to inactive users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        SendInactiveUsersEmail::dispatch();
        
        $this->info('Inactive user reminders sent successfully.');
        // Assuming you have a user object to log
        $user = auth()->user(); 
        Log::info("Enviando correo a: " . $user->email);
    }
}