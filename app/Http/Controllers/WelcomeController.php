<?php

namespace App\Http\Controllers;

use App;
use Auth;
use App\Models\ApplicationConfig;
use App\Models\ApplicationInfos;
use App\Models\User;
use App\Jobs\SendWelcomeEmail;

class WelcomeController extends Controller
{
    public function welcome()
    {


        $currentUser = \Auth::user();
        //dd($currentUser);
        //SendWelcomeEmail::dispatch($currentUser);
            //dd($currentUser);
        $status = ApplicationConfig::first();
        //dd($currentUser);
        /* when not logged in or profile is not saved*/
        if (!$currentUser) {
            $appinfos = ApplicationInfos::where('id', $status->application_info_id)->first();
            $user = false;
            return view('welcome')->with(compact('user', 'status', 'appinfos'));
        } else {
            $user = Auth::user();
            $status = ApplicationConfig::first();

            $appinfos = ApplicationInfos::where('id', $status->application_info_id)->first();

            if($user->activated == null){
                return redirect()->route('activation-required');
              }
              if($user->activated == false){
                return redirect()->route('activation-required');
              }

            if($user->checkProfile() == false){
                return view('pages.user.noprofile')->with(compact('user', 'status', 'appinfos'));
              }
              if ($user->isAdmin()) {
                  return view('pages.user.home')->with(compact('user', 'status', 'appinfos'));
              }
            return view('pages.user.home')->with(compact('user', 'status', 'appinfos'));

        }
    }
    public function offline()
    {
        return view('application.application_offline');
    }

    public function faq()
    {
        return view('pages.user.faq');
    }

    public function privacy()
    {
        return view('pages.user.privacy');
    }

    public function imprint()
    {
        return view('pages.user.imprint');
    }
}
