<?php

namespace App\Jobs;

use App\Notifications\SlackNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Support\Facades\Notification;

class SlackNote implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notification::route('slack', 'https://hooks.slack.com/services/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')
            ->notify(new SlackNotification());
        return 1;
    }
}
