<?php

namespace App\Http\Controllers;

use App;
use Auth;
use App\Models\User;
use App\Models\ApplicationConfig;
use Image;
use App\Traits\CaptureIpTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Validator;
use View;
use Log;

class ApplicationConfigController extends Controller
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
        $applicationconfig = ApplicationConfig::first();
        return View('application.config')->with(compact('applicationconfig'));
    }

    public function create($activity_id)
    {
        return view('application.create')->with('activity_id', $activity_id);
    }

    public function edit($id)
    {
        $application = Application::find($id);

        return view('application.edit')->with('application', $application);
    }

    public function store(Request $request)
    {
        //dd($request);
        $post = request()->validate([
          'application_year' => 'required|min:4|max:5',

      ]);
        $appconf = ApplicationConfig::first();
        $post['application_year'] = $appconf->application_year;
        $save = Auth::user()->application()->save(new Application($post));
        return back()->with('success', trans('application.createSuccess'));
    }

    public function update(Request $request, $id)
    {
        $post = request()->validate([
        'application_year' => 'required|min:4|max:5',

    ]);
      
        $appconf = ApplicationConfig::first();
        $appconf->application_year = $request['application_year'];
        $appconf->application_info_id = $request['application_info_id'];
        $appconf->save();
        return redirect('applicationconfig')->with('success', trans('application.configUpdateSuccess'));
    }
}
