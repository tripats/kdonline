<?php

namespace App\Http\Controllers;

use Auth;
use App;
use Illuminate\Support\Facades\Session;
use App\Models\ApplicationConfig;
use App\Models\ApplicationInfos;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
            return view('pages.admin.home')->with(compact('user', 'status', 'appinfos'));
        }
        return view('pages.user.home')->with(compact('user', 'status', 'appinfos'));
    }
}
