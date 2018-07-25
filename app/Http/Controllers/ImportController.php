<?php

namespace App\Http\Controllers;

use App;

use App\Models\Profile;
use App\Models\Theme;
use App\Models\User;
use App\Models\Medium;
use App\Models\Application;
use App\Models\Encoding;
use App\Notifications\SendGoodbyeEmail;
use App\Traits\CaptureIpTrait;
use File;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Image;
use Webpatser\Uuid\Uuid;
use Validator;
use View;
use DB;

class ImportController extends Controller
{
    /**
     * function to import old users to new insta
     */
    public function newsletter()
    {
  
      $oldusers = DB::connection('mysql2')->select('SELECT * from sf_guard_user_profile WHERE newsletter = 1');
      foreach ($oldusers as $olduser){
        $id = $olduser->user_id;
        $profile = Profile::findOrFail($id);

        $profile->newsletter = 1;
        $profile->save();
      }
    }

    public function import_user()
    {

        //echo phpinfo();
        //die;
        //
        //

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('profiles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('role_user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $oldusers = DB::connection('mysql2')->select('SELECT * from sf_guard_user AS u LEFT JOIN (sf_guard_user_profile AS up)
               ON (up.user_id = u.id)');
               //dd($oldusers);
        foreach ($oldusers as $olduser) {
            $user = User::where('email', '=', $this->convert($olduser->email))->first();
              //print_r($olduser);
              //echo $olduser->user_id;
            if ($user === null)
            {
                $user = User::create([
                      'id'                           => $olduser->user_id,
                      'name'                           => $olduser->username,
                      'first_name'                     => $olduser->first_name,
                      'last_name'                      => $olduser->last_name,
                      'email'                          => $olduser->email,
                      'password'                       => $olduser->password,
                      'token'                          => str_random(64),
                      'activated'                      => true,

                  ]);

                $profile = new Profile();
                $profile->user_id = $olduser->user_id;
                $profile->street = $olduser->street;
                $profile->postcode = $olduser->postcode;
                $profile->city = $olduser->city;
                $profile->country = $olduser->country;
                $profile->birthday = $olduser->birthday;
                $profile->fixed_number = $olduser->fixed_number;
                $profile->birthplace = $olduser->birthplace;
                $profile->mobile_number = $olduser->mobile_number;
                $profile->homepage = $olduser->homepage;
                $profile->vita= $olduser->vita;
                $profile->exhibition = $olduser->exhibition;
                $user->profile()->save($profile);
                $user->attachRole(3);
                $user->save();


            }

        }
    }
    public function import_applications()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      DB::table('applications')->truncate();


      $applications = DB::connection('mysql2')->select('SELECT * from application');

      foreach ($applications as $oldapplication) {
        $application = Application::create([
          'id' => $oldapplication->id,
          'user_id' => $oldapplication->user_id,
          'expectations' => $oldapplication->expectations,
          'description' => $oldapplication->description,
          'activity_id' => $oldapplication->activity_id,
          'application_year' => $oldapplication->application_year,
          'family' => $this->checknull($oldapplication->family),
          'preferred_start' => $this->checknull($oldapplication->preferred_start),
          'homepage' => $oldapplication->homepage,
          'duration' => $oldapplication->duration,
          'is_painting' => $this->checknull($oldapplication->is_painting),
          'is_graphic' => $this->checknull($oldapplication->is_graphic),
          'is_photography' => $this->checknull($oldapplication->is_photography),
          'is_video' => $this->checknull($oldapplication->is_video),
          'is_sculpture' => $this->checknull($oldapplication->is_sculpture),
          'is_installation' => $this->checknull($oldapplication->is_installation),
          'is_object' => $this->checknull($oldapplication->is_object),
          'is_performance' => $this->checknull($oldapplication->is_performance),
          'is_mixed_media' => $this->checknull($oldapplication->is_mixed_media),
          'is_participative' => $this->checknull($oldapplication->is_participative),
          'is_sound' => $this->checknull($oldapplication->is_sound),
          'is_internet' => $this->checknull($oldapplication->is_internet),
          'is_interdisciplinary' => $this->checknull($oldapplication->is_interdisciplinary),
          'is_focus_visual' => $this->checknull($oldapplication->is_focus_visual),
          'is_focus_sciences' => $this->checknull($oldapplication->is_focus_sciences),
          'is_focus_economics' => $this->checknull($oldapplication->is_focus_economics),
          'is_energy' => $this->checknull($oldapplication->is_energy),
          'is_roman' => $this->checknull($oldapplication->is_roman),
          'is_theather' => $this->checknull($oldapplication->is_theather),
          'is_literature_both' =>$this->checknull($oldapplication->is_literature_both),
          'is_proposed' => $this->checknull($oldapplication->is_proposed)

          ]);
          $application->save();
      }
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function import_media()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      DB::table('media')->truncate();


      $media = DB::connection('mysql2')->select('SELECT * from media');
      foreach ($media as $oldmedia) {

        /*
        1 = Picture
        2 = Video
        3 = Audio/mp3
        4 = PDF
         */
        if ($oldmedia->mime_type == 'jpg') {
          $type = 1;
          $extension = '.jpg';
        }
        if ($oldmedia->mime_type == 'swf') {
          $type = 2;
          $extension = '.mp4';
        }
        if ($oldmedia->mime_type == 'flv') {
          $type = 3;
          $extension = '.mp3';
        }
        if ($oldmedia->mime_type == 'pdf') {
          $type = 4;
          $extension = '.pdf';
        }
        $medium = Medium::create([
          'user_id' => $oldmedia->user_id,
          'application_id' => $oldmedia->application_id,
          'title' => $oldmedia->title,
          'file_name_org' => $oldmedia->file_name.$extension,
          'file_name' => $oldmedia->file_name.$extension,
          'type' => $type,
          'description' => $oldmedia->description,
          'international' => 0

          ]);
          $medium->save();

      }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
    public function checknull($string)
    {

      if(is_null($string))
      {
        return false;
      }
      else
      {
          return $string;
      }
    }

    public function public_update()
    {
      $oldusers = DB::connection('mysql2')->select('SELECT * from sf_guard_user_profile');
      //dd($oldusers);
      foreach ($oldusers as $olduser) {
        $profile = Profile::where('user_id',$olduser->user_id)->first();
        $profile->profile_public = 1;
        $profile->save();
      }
    }

    public function convert($string)
    {
        //$convert =str_replace('\xE2\x80',' ',$str);
        $encoding =  mb_detect_encoding($string).'<br>   ';
        //$convert =  mb_convert_encoding($string, "UTF-8", mb_detect_encoding($string, "UTF-8, ISO-8859-1, ISO-8859-15, Windows-1252", true));
        foreach(mb_list_encodings() as $chr){
           //echo mb_convert_encoding($string, 'UTF-8', $chr)." : ".$chr."<br>";
            return mb_convert_encoding($string, 'UTF-8', $chr);
          }
        //return $convert = mb_convert_encoding($string, 'Windows-1252', 'UTF-8');
        //return $convert;

    }
}
