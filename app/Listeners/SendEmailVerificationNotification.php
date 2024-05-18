<?php

namespace App\Listeners;

use App\Events\EmailVerificationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailVerificationNotification
{
    public function handle(EmailVerificationEvent $event)
    {
        
        Mail::to($event->user->email)->send(new VerificationMail($event->verificationCode));
    }
}
