<?php

namespace App\Http\Controllers;

use App;
use Auth;
use App\Models\User;
use App\Models\Application;
use App\Models\Medium;
use Image;
use File;
use App\Notifications\SendGoodbyeEmail;
use App\Traits\CaptureIpTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Http\UploadedFile;
use App\Helper\TextHelper;
use View;
use Log;

class UploadController extends Controller
{
    public function uploadForm()
    {
        return view('upload_form');
    }

    public function uploadSubmit(Request $request)
    {
        $image = $request->photos[0];
        if ($image) {
            $file_extension = $image->getClientOriginalExtension();
            $time=time();
            $uid = uniqid($time, false);
            $filename = $uid.'.'.$image->getClientOriginalExtension();
            $save_path60    =  storage_path() . '/media/images60/';
            $save_path200    = storage_path() . '/media/images200/';
            $save_path1200   = storage_path() . '/media/images1200/';


            File::makeDirectory($save_path60, $mode = 0755, true, true);
            File::makeDirectory($save_path200, $mode = 0755, true, true);
            File::makeDirectory($save_path1200, $mode = 0755, true, true);

            // Save the file to the server
            Image::make($image)->resize(null, 60, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($save_path60 . $filename);

            Image::make($image)->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($save_path200 . $filename);
            Image::make($image)->resize(null, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($save_path1200 . $filename);

            $media = Medium::create([
                'user_id'          => 1,
                'application_id'          => 1,
                'file_name'         => $filename,
                'file_name_org'    => $image->getClientOriginalName(),
                'file_extension'   => $file_extension,
                'extension'        => $image->getClientOriginalExtension(),
                'mime_type'        => $image->getMimeType()

            ]);

            $media->save();

            $photos = [];
            $photo_object = new \stdClass();
            $photo_object->name = 'http://bilder.bild.de/fotos/bu-32-bildlogo-0812-jpg_14249078_mbqf-1325756515-21916986/Bild/1.bild.jpg');
            $photo_object->size = 312312;
            $photo_object->fileID = 3;
            $photos[] = $photo_object;
            //return redirect('mediaupload/'.$offer_id)->with('success', trans('medieupload.successUpload'));
            return response()->json(array('files' => $photos), 200);
            //return response()->json(array('path'=> $path), 200);
        } else {
            return response()->json(['fail'=>'error']);
        }
    }


    public function postProduct(Request $request)
    {
        $product = Product::create($request->all());
        ProductPhoto::whereIn('id', explode(",", $request->file_ids))
        ->update(['product_id' => $product->id]);
        return 'Product saved successfully';
    }
}
