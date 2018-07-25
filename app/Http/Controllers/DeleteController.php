<?php

namespace App\Http\Controllers;

use App;
use Auth;
use File;
use App\Models\User;
use App\Models\Application;
use App\Models\Medium;
use Illuminate\Http\Request;

class DeleteController extends Controller
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
    * handle delete media
    *@param Request
    *@param id
    */
    public function deleteImage(Request $request, $id)
    {
        $currentUser = \Auth::user();
        $media        = Medium::findOrFail($id);
        //dd($media);
        if ($media->user_id != $currentUser->id) {
            return redirect('applications')->with('error', trans('profile.errorDeleteNotYour'));
        }

        $save_path_small    =  storage_path() . '/app/public/media/images_small/';
        $save_path_medium   = storage_path() .  '/app/public/media/images_medium/';
        $save_path_large    = storage_path() .  '/app/public/media/images_large/';

        File::delete($save_path_small.$media->file_name);
        File::delete($save_path_medium.$media->file_name);
        File::delete($save_path_large.$media->file_name);
        $media->delete();
        return back()->with('success', 'Image successfully deleted');
    }

    /**
    * handle delete video
    *@param Request
    *@param id
    */
    public function deleteVideo(Request $request, $id)
    {
        $currentUser = \Auth::user();
        $media        = Medium::findOrFail($id);
        if ($media->user_id != $currentUser->id) {
            return redirect('applications')->with('error', trans('profile.errorDeleteNotYour'));
        }
        $destinationPath = storage_path() . '/app/public/media/video/';

        File::delete($destinationPath.$media->file_name);
        $media->delete();
        return back()->with('success', 'Video successfully deleted');
    }
    /**
    * handle delete video
    *@param Request
    *@param id
    */
    public function deleteAudio(Request $request, $id)
    {
        $currentUser = \Auth::user();
        $media        = Medium::findOrFail($id);
        if ($media->user_id != $currentUser->id) {
            return redirect('applications')->with('error', trans('profile.errorDeleteNotYour'));
        }
        $destinationPath = storage_path() . '/app/public/media/audio/';

        File::delete($destinationPath.$media->file_name);
        $media->delete();
        return back()->with('success', 'Audio file successfully deleted');
    }

    /**
    * handle delete video
    *@param Request
    *@param id
    */
    public function deletePdf(Request $request, $id)
    {
        $currentUser = \Auth::user();
        $media        = Medium::findOrFail($id);
        $application = Application::findOrFail($media->application_id);
        if ($media->user_id != $currentUser->id) {
            return redirect('applications')->with('error', trans('profile.errorDeleteNotYour'));
        }
        if($application->activity_id==4){
        $destinationPath    = storage_path() . '/app/public/media/literature_pdf/';
        }
        else{
          $destinationPath    = storage_path() . '/app/public/media/pdf/';
        }

        File::delete($destinationPath.$media->file_name);
        $media->delete();
        return back()->with('success', 'PDF successfully deleted');
    }
}
