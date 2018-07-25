<?php

namespace App\Http\Controllers;

use App;
use App\Models\Profile;
use App\Models\Theme;
use App\Models\User;
use App\Notifications\SendGoodbyeEmail;
use App\Traits\CaptureIpTrait;
use File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Image;
use Validator;
use View;
use Webpatser\Uuid\Uuid;

class FileController extends Controller
{
    public function index()
    {
        return view('mediaupload.file-upload');
    }


    public function catadd()
    {
        if (Input::hasFile('logo')) {
            return "file present";
        } else {
            return "file not present";
        }
    }

    public function dropzone()
    {
        return view('dropzone-view');
    }

    /**
     * Image Upload Code
     *
     * @return void
     */
    public function dropzoneStore(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);
        return response()->json(['success'=>$imageName]);
    }
}
