<?php

namespace App\Http\Controllers;

use App;
use Auth;
use File;
use Image;
use App\Models\User;
use App\Models\Application;
use App\Models\Medium;
use App\Notifications\SendGoodbyeEmail;
use App\Traits\CaptureIpTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Validator;
use View;

class MediaController extends Controller
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

    public function edit($id)
    {
        $medium = Medium::findOrFail($id);
        $currentUser = \Auth::user();

        if ($medium->user_id != $currentUser->id) {
            return redirect('applications')->with('error', trans('profile.errorDeleteNotYour'));
        }

        return view('media.edit')->with('medium', $medium);
    }
    /* handle upload
    *@param request
    *@integer id
    */

    private function checkUserOwner($app_user_id){
      $currentUser = \Auth::user();
      $user = User::findOrFail($currentUser->id);

        if ($user->id != $app_user_id) {
            abort(403, 'Unauthorized action.');
        }
      }

    public function update(Request $request, $id)
    {
        $save = Auth::user()->media()->findOrFail($id)->fill($request->toArray())->save();

        $medium = Medium::findOrFail($id);
        // if media image
        if ($medium->type == 1):
          $type = $medium->type;
        $application = Application::where('id', $medium->application_id)->first();
        $media = Medium::where('application_id', $medium->application_id)->where('type', 1)->orderBy('id', 'desc')->get();
        return redirect()->route('imageupload', ['id' => $medium->application_id, 'type' => 'image'])->with('success', 'Information successfully updated');
        endif;

        // if media Video
        if ($medium->type == 2):
          $type = $medium->type;
        $application = Application::where('id', $medium->application_id)->first();
        $media = Medium::where('application_id', $medium->application_id)->where('type', 2)->orderBy('id', 'desc')->get();
        return redirect()->route('videoupload', ['id' => $medium->application_id, 'type' => 'vido'])->with('success', 'Information successfully updated');
        //return view('media.audio_upload')->with(compact('id', 'type', 'application', 'media'))->with('success', 'Information successfully updated');
        endif;

        // if media audio
        if ($medium->type == 3):
          $type = $medium->type;
        $application = Application::where('id', $medium->application_id)->first();
        $media = Medium::where('application_id', $medium->application_id)->where('type', 3)->orderBy('id', 'desc')->get();
        return redirect()->route('audioupload', ['id' => $medium->application_id, 'type' => 'audio'])->with('success', 'Information successfully updated');
        //return view('media.audio_upload')->with(compact('id', 'type', 'application', 'media'))->with('success', 'Information successfully updated');
        endif;

        // if media pdf
        if ($medium->type == 4):
          $type = $medium->type;
        $application = Application::where('id', $medium->application_id)->first();
        $media = Medium::where('application_id', $medium->application_id)->where('type', 4)->orderBy('id', 'desc')->get();
        return redirect()->route('pdfupload', ['id' => $medium->application_id, 'type' => 'pdf'])->with('success', 'Information successfully updated');
        //return view('media.audio_upload')->with(compact('id', 'type', 'application', 'media'))->with('success', 'Information successfully updated');
        endif;

        //return back()->with('success', 'Information successfully updated');
    }


    /* handle upload
    *@integer id
    *@param tpye 1-4
    */
    public function imageUpload($id, $type)
    {
        $application = Application::where('id', $id)->first();
        $this->checkUserOwner($application->user_id);
        $media = Medium::where('application_id', $id)->where('type', 1)->orderBy('id', 'desc')->get();
        //dd($media);
        return view('media.image_upload')->with(compact('id', 'type', 'application', 'media'));
    }
    /* handle upload
    *@integer id
    *@param tpye 1-4
    */
    public function videoUpload($id, $type)
    {
        $application = Application::where('id', $id)->first();
        $this->checkUserOwner($application->user_id);
        $media = Medium::where('application_id', $id)->where('type', 2)->orderBy('id', 'desc')->get();
        return view('media.video_upload')->with(compact('id', 'type', 'application', 'media'));
    }
    /* handle upload
    *@integer id
    *@param tpye 1-4
    */
    public function audioUpload($id, $type)
    {
        $application = Application::where('id', $id)->first();
        $this->checkUserOwner($application->user_id);
        $media = Medium::where('application_id', $id)->where('type', 3)->orderBy('id', 'desc')->get();
        return view('media.audio_upload')->with(compact('id', 'type', 'application', 'media'));
    }
    /* handle upload
    *@integer id
    *@param tpye 1-4
    */
    public function pdfUpload($id, $type)
    {
        $application = Application::where('id', $id)->first();
        $this->checkUserOwner($application->user_id);
        $media = Medium::where('application_id', $id)->where('type', 4)->orderBy('id', 'desc')->get();
        return view('media.pdf_upload')->with(compact('id', 'type', 'application', 'media'));
    }

    /* handle upload
    *@param request
    */
    public function videoStore(Request $request)
    {
        $this->validate($request, [
         'video' => 'required|mimes:mp4,avi,asf,mov,qt,avchd,flv,swf,mkv,mpg,mpeg,mpeg-4,wmv,divx,3gp|max:30000',
     ]);

        $currentUser = \Auth::user();
        $videotmp = time();
        $video = $request->file('video');
        $input['video'] = $videotmp.'.'.$video->getClientOriginalExtension();
        $destinationPath = storage_path() . '/app/public/media/video/';
        $time=time();
        $uid = uniqid($time, false);
        $filename = $uid.'.'.$video->getClientOriginalExtension();
        $video->move($destinationPath, $filename);

        if ($video->getClientOriginalExtension() != "mp4") {
            $in = $destinationPath.'/'.$filename;
            $out = $destinationPath.'/'.$uid.'.mp4';
            //preview image
            //$cmd = "ffmpeg -i $in -ss 1 -pix_fmt rgb24 -vframes 1 -s 60x40 $out 2>&1";
            $cmd = "ffmpeg -i $in -vcodec h264 -acodec aac -vf scale=720:480 -strict -2 $out";
            $fh = popen($cmd, "r");
            while (fgets($fh)) {
            }
            pclose($fh);
            File::delete($in);
        }
        $media = Medium::create([
              'user_id'          => $currentUser->id,
              'title'             => $request->title,
              'description'      => $request->description,
              'international'    => $request->international,
              'application_id'          => $request->id,
              'file_name'         => $uid.'.mp4',
              'file_name_org'    => $video->getClientOriginalName(),
              'type'   => 2,

          ]);

        $media->save();
        return back()->with('success', 'Video upload successful');
    }

    /* handle upload
    *@param request
    */
    public function imageStore(Request $request)
    {
        $request->validate([
               'file' => 'required | mimes:jpeg,jpg,png | max:3000',
           ]);

           $currentUser = \Auth::user();

        $image = $request->file('file');
        //dd($image);
        if ($image) {
            $image = $request->file('file');
            $file_extension = $image->getClientOriginalExtension();
            $time=time();
            $uid = uniqid($time, false);
            $filename = $uid.'.'.$image->getClientOriginalExtension();
            $save_path_small    = storage_path() . '/app/public/media/images_small/';
            $save_path_medium    =  storage_path() . '/app/public/media/images_medium/';
            $save_path_large   = storage_path() . '/app/public/media/images_large/';


            File::makeDirectory($save_path_small, $mode = 0755, true, true);
            File::makeDirectory($save_path_medium, $mode = 0755, true, true);
            File::makeDirectory($save_path_large, $mode = 0755, true, true);

            // Save the file to the server
            Image::make($image)->resize(null, 60, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($save_path_small . $filename);

            Image::make($image)->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($save_path_medium . $filename);
            Image::make($image)->resize(null, 1200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($save_path_large . $filename);

            $media = Medium::create([
                  'user_id'          => $currentUser->id,
                  'title'             => $request->title,
                  'description'      => $request->description,
                  'application_id'          => $request->id,
                  'international'    => $request->international,
                  'file_name'         => $filename,
                  'file_name_org'    => $image->getClientOriginalName(),
                  'type'        => 1,

              ]);
            $media->save();


            return back()->with('success', trans('application.successUpload'));
        } else {
            return back()->with('success', trans('application.failedUpload'));
        }
    }

    public function audioStore(Request $request)
    {

        $request->validate([
               'audio' => 'required | max:10000',
           ]);
        $currentUser = \Auth::user();

        $mp3 = $request->file('audio');

        if ($mp3) {
            $file_extension = $mp3->getClientOriginalExtension();
            $time=time();
            $uid = uniqid($time, false);
            $filename = $uid.'.'.$mp3->getClientOriginalExtension();
            $save_path_audio    = storage_path() . '/app/public/media/audio/';

            File::makeDirectory($save_path_audio, $mode = 0755, true, true);
            $mp3->move($save_path_audio, $filename);
            $media = Medium::create([
                  'user_id'          => $currentUser->id,
                  'title'             => $request->title,
                  'description'      => $request->description,
                  'application_id'          => $request->id,
                  'international'    => $request->international,
                  'file_name'         => $filename,
                  'file_name_org'    => $mp3->getClientOriginalName(),
                  'type'        => 3,

              ]);

            $media->save();


            return back()->with('success', trans('application.successUpload'));
        } else {
            return back()->with('success', trans('application.failedUpload'));
        }
    }
    public function pdfStore(Request $request)
    {
        $request->validate([
               'pdf' => 'required | max:25000',
           ]);
        $currentUser = \Auth::user();
        $application = Application::findOrFail($request->id);

        $pdf = $request->file('pdf');
        if ($pdf) {
            $first_name = str_slug($application->user->first_name);
            $last_name = str_slug($application->user->last_name);

            $file_extension = $pdf->getClientOriginalExtension();
            $time=time();
            $uid = uniqid($time, false);
            $filename = $application->application_year.'-'.$last_name.'-'.$first_name.'-'.$uid.'.'.$pdf->getClientOriginalExtension();
            if($application->activity_id==4){
            $save_path_pdf    = storage_path() . '/app/public/media/literature_pdf/';
            }
            else{
              $save_path_pdf    = storage_path() . '/app/public/media/pdf/';
            }
            File::makeDirectory($save_path_pdf, $mode = 0755, true, true);

            $pdf->move($save_path_pdf, $filename);
            $media = Medium::create([
                  'user_id'          => $currentUser->id,
                  'title'             => $request->title,
                  'description'      => $request->description,
                  'international'    => $request->international,
                  'application_id'          => $request->id,
                  'file_name'         => $filename,
                  'file_name_org'    => $pdf->getClientOriginalName(),
                  'type'        => 4,

              ]);

            $media->save();


            return back()->with('success', trans('application.successUpload'));
        } else {
            return back()->with('error', trans('application.failedUpload'));
        }
    }
}
