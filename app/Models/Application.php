<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Medium;
/**
 * @property mixed user_id
 */
class Application extends Model
{
    protected $fillable = [
    'expectations',
    'description',
    'activity_id',
    'application_year',
    'family',
    'preferred_start',
    'homepage',
    'duration',
    'is_painting',
    'is_graphic',
    'is_photography',
    'is_video',
    'is_sculpture',
    'is_installation',
    'is_object',
    'is_performance',
    'is_mixed_media',
    'is_participative',
    'is_sound',
    'is_internet',
    'is_interdisciplinary',
    'is_focus_visual',
    'is_focus_sciences',
    'is_focus_economics',
    'is_energy',
    'is_roman',
    'is_theather',
    'is_literature_both',
    'is_proposed'
  ];
    protected $casts = [
          'is_painting' => 'boolean',
          'is_graphic' => 'boolean',

      ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function media()
    {
        return $this->hasMany('App\Models\Medium');
    }


    /**
     * Count Media belonging to offer
     *
     * @param  int  $application_id
     * @param  int  $type 1,2,3,4
     *
     */
    public function countMedia($application_id, $type)
    {
        $mediaCount = Medium::where('application_id', $application_id)->where('type', $type)->count();
        return $mediaCount;
    }

    public function deleteApplication($user_id)
    {

      $apps = $this::where('user_id', $user_id)->get();
      foreach ($apps as $app) {

        $app->delete();
                dd($app);
        die;
      }

    }


}
