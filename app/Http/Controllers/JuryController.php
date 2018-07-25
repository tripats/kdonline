<?php

namespace App\Http\Controllers;

use App;
use Auth;
use App\Models\User;
use App\Models\Application;
use App\Models\ApplicationConfig;
use App\Models\Medium;
use App\Mail\ApplicationCreated;
use Illuminate\Support\Facades\Mail;
use Image;
use File;
use App\Notifications\SendGoodbyeEmail;
use App\Traits\CaptureIpTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Validator;
use DB;
use View;
use Log;

class JuryController extends Controller
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

    public function index()
    {
        $applications = Application::orderBy('id', 'application_year')->paginate(100);
        return View('jury.index')->with(compact('applications'));
    }

    public function literature()
    {
      $appinfo = \App\Models\ApplicationConfig::first();
      $app_year = $appinfo->application_year;
        $applications = Application::where('activity_id', 4)->where('application_year', $app_year)->orderBy('id', 'application_year')->paginate(500);
        return View('jury.index')->with(compact('applications'));
    }

    public function art()
    {
      $appinfo = \App\Models\ApplicationConfig::first();
      $app_year = $appinfo->application_year;
        $applications = Application::where('activity_id','<=', 2)->where('application_year', $app_year)->orderBy('id', 'application_year')->paginate(500);
        return View('jury.index')->with(compact('applications'));
    }

    public function create($activity_id)
    {
        return view('application.create')->with('activity_id', $activity_id);
    }

    public function searchUser(Request $request)
        {
            $applicants = DB::table('users')
                          ->where('users.name', 'LIKE', "%$request->findcustomer%")
                          ->orWhere('users.first_name', 'LIKE', "%$request->findcustomer%")
                          ->orWhere('users.last_name', 'LIKE', "%$request->findcustomer%")
                          ->orWhere('users.email', 'LIKE', "%$request->findcustomer%")
                          ->get();
            //dd($applicants);
            return view('jury.applicants')->with('applicants', $applicants);
        }

    public function showApplications(Request $request)
    {
      $user = User::findOrFail($request->id);
      $applications = Application::where('user_id', $user->id)->orderBy('updated_at', 'desc')->get();
      return View('jury.applications_overview')->with(compact('user', 'applications'));
    }

    public function edit($id)
    {

    }

    public function show($id)
    {
        $application = Application::find($id);

        return view('jury.show')->with('application', $application);
    }
    public function store(Request $request)
    {

    }

    public function update(Request $request, $id)
    {

    }

    /**Show Upload Form nach erfolgreicher Erstellung der Bewerbung*/
    public function applicactionSuccess($id)
    {
    }

    public function destroy(Request $request, $id)
    {
    }
}
