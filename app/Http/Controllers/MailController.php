<?php

namespace App\Http\Controllers;

use Log;
use Mail;
use Illuminate\Http\Request;
use App\Jobs\SendWelcomeEmail;
use App\Models\User;
use App\Models\Profile;
use App\Test;

class MailController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(1);
        $test = new Test($user);
        echo $test->handle();
        //dd($test->user->email);
        //return view()->make("mail.index");
    }

    public function send()
    {
        Log::info("Request Cycle with Queues Begins");
        $user = User::findOrFail(1);
        $this->dispatch(new SendWelcomeEmail($user));
        Log::info("Request Cycle with Queues Ends");
        echo "hallo";
    }

    public function subscriber()
    {
        $profiles = Profile::where('newsletter', 1)->get();
        foreach ($profiles as $profile){
          echo $profile->user->email.'<br>';
        }
        //return view()->make("mail.index");
    }

}
