<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\InactiveUserReminder;
use App\Models\User;

class SendInactiveUsersEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::where('ultima_sesion', '<', date('Y-m-d H:i:s', strtotime('-30 days')))->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new InactiveUserReminder($user));
        }
    }
}