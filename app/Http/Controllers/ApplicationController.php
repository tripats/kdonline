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
use View;
use Log;

class ApplicationController extends Controller
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
        $currentUser = \Auth::user();
        $user = User::findOrFail($currentUser->id);
        $applications = Application::where('user_id', $user->id)->orderBy('updated_at', 'desc')->get();
        return View('application.index')->with(compact('user', 'applications'));
    }

    public function create($activity_id)
    {
        return view('application.create')->with('activity_id', $activity_id);
    }

    public function info()
    {
        echo phpinfo();
    }

    public function edit($id)
    {
        $application = Application::find($id);
        $this->checkUserOwner($application->user_id);
        return view('application.edit')->with('application', $application);
    }

    private function checkUserOwner($app_user_id){
      $currentUser = \Auth::user();
      $user = User::findOrFail($currentUser->id);

        if ($user->id != $app_user_id) {
            abort(403, 'Unauthorized action.');
        }
      }


    public function store(Request $request)
    {
        $appinfo = \App\Models\ApplicationConfig::first();

        /* wenn application == kww */
        if ($request->activity_id == 3):
      $post = request()->validate([
        'expectations' => 'required|min:10|max:5000',
        'description' => 'required|min:10|max:5000'

    ]);
        endif;
        /* wenn application == mixed media*/
        if ($request->activity_id == 2):
      $post = request()->validate([
        'expectations' => 'required|min:10|max:5000',
        'description' => 'required|min:10|max:5000',
        'preferred_start' => 'required'

    ]);
        endif;
        /* wenn application == composition*/
        if ($request->activity_id == 5):
      $post = request()->validate([
        'expectations' => 'required|min:10|max:5000',
        'description' => 'required|min:10|max:5000',
        'preferred_start' => 'required'
    ]);
        endif;
        /* wenn application == Literatur */
        if ($request->activity_id == 4):
      $post = request()->validate([
        'expectations' => 'required|min:10|max:5000',
        'description' => 'required|min:10|max:5000',
        'preferred_start' => 'required'

    ]);
        endif;
        /* wenn application == air */
        if ($request->activity_id == 1):
      $post = request()->validate([
        'expectations' => 'required|min:10|max:5000',
        'description' => 'required|min:10|max:5000',
        'preferred_start' => 'required'
        ]);
        endif;
        $appconf = ApplicationConfig::first();
        $request['application_year'] = $appconf->application_year;


        $application = Auth::user()->application()->save(new Application($request->all()));
        $currentUser = \Auth::user();
        Mail::to($currentUser->email)->send(new ApplicationCreated());
        return redirect()->route('application_success', ['id' => $application->id]);
        //return back()->with('success', trans('application.createSuccess'));
    }

    public function update(Request $request, $id)
    {

        /* if application == kww */
        if ($request->activity_id == 3):
      $post = request()->validate([
        'expectations' => 'required|min:10|max:5000',
        'description' => 'required|min:10|max:5000'

    ]);
        endif;
        /* if application == miexed media*/
        if ($request->activity_id == 2):
      $post = request()->validate([
        'expectations' => 'required|min:10|max:5000',
        'description' => 'required|min:10|max:5000',
        'preferred_start' => 'required'

    ]);
        endif;

        /* if application == composition*/
        if ($request->activity_id == 5):
      $post = request()->validate([
        'expectations' => 'required|min:10|max:5000',
        'description' => 'required|min:10|max:5000',
        'preferred_start' => 'required'
    ]);
        endif;
        /* if application == Literatur */
        if ($request->activity_id == 4):
      $post = request()->validate([
        'expectations' => 'required|min:10|max:5000',
        'description' => 'required|min:10|max:5000',
        'preferred_start' => 'required'

    ]);
        endif;
        /* if application == air */
        if ($request->activity_id == 1):
      $post = request()->validate([
        'expectations' => 'required|min:10|max:5000',
        'description' => 'required|min:10|max:5000',
        'preferred_start' => 'required'
        ]);
        endif;
        //dd($request);
        $appconf = ApplicationConfig::first();
        $request->request->add(['application_year' => $appconf->application_year]);
        //dd($request->all());
        $save = Auth::user()->application()->findOrFail($id)->fill($request->all())->save();
        return redirect('applications')->with('success', trans('application.updateSuccess'));
    }

    /**Show Upload Form nach erfolgreicher Erstellung der Bewerbung*/
    public function applicactionSuccess($id)
    {
        $application = Application::where('id', $id)->first();
        return view('application.application_success')->with('application', $application);
    }

    public function destroy(Request $request, $id)
    {
        $application = Application::where('id', $id)->first();

        $this->checkUserOwner($application->user_id);

        $media = Medium::where('application_id', $id)->where('type', 1)->get();
        $save_path_small    =  storage_path() . '/app/public/media/images_small/';
        $save_path_medium   = storage_path() .  '/app/public/media/images_medium/';
        $save_path_large    = storage_path() .  '/app/public/media/images_large/';
        foreach ($media as $medium) {
            File::delete($save_path_small.$medium->file_name);
            File::delete($save_path_medium.$medium->file_name);
            File::delete($save_path_large.$medium->file_name);
            $medium->delete();
        }

        $media = Medium::where('application_id', $id)->where('type', 2)->get();
        $destinationPath = storage_path() . '/app/public/media/video/';
        foreach ($media as $medium) {
            File::delete($destinationPath.$medium->file_name);
            $medium->delete();
        }

        $media = Medium::where('application_id', $id)->where('type', 3)->get();
        $destinationPath = storage_path() . '/app/public/media/audio/';
        foreach ($media as $medium) {
            File::delete($destinationPath.$medium->file_name);
            $medium->delete();
        }

        $media = Medium::where('application_id', $id)->where('type', 4)->get();
        $destinationPath = storage_path() . '/app/public/media/pdf/';
        foreach ($media as $medium) {
            File::delete($destinationPath.$medium->file_name);
            $medium->delete();
        }
        $application->delete();

        return back()->with('success', trans('application.deleteSuccess'));
    }

    public function jurypropose(Request $request, $id)
      {
    	$validator = Validator::make($request->all(), [
            'appid' => 'required',
            'is_proposed' => 'required'
        ]);

        if ($validator->passes()) {
          $app = Application::where('id', $id)->first();
          $app->is_proposed = $request->is_proposed;
          $app->save();
              return response()->json(['success'=>'Added new records.']);
        }

    	return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function jurypropose_reset()
      {
        Application::query()->update(['is_proposed' => 0]);
        return back()->with('success', trans('application.resetProposalsSuccess'));
    }


}
