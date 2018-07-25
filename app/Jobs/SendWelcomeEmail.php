<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Mail\Mailer;
use App\Models\User;

class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        for($i = 1; $i<=10; $i++){
        $mailer->send('mail.welcome', ['data'=>'data'], function ($message) {
            $message->from('nwambachristian@gmail.com', 'Christian Nwmaba');
            $message->to('tripats@wurst.de');
        });
      }
    }
}
