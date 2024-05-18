<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use IlluminateSupportFacadesMail;
use SendEmailVerificationNotification;

class TestMailController extends Controller
{
    public function sendTestEmail()
    {
        Mail::raw('This is a test email.', function ($message) {
            $message->to('lolokha1346@gmail.com')->subject('Test Email');
        });
 
        return 'Email sent successfully!';
    }
    
}
