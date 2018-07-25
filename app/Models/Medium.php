<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medium extends Model
{
    protected $casts = [
    'user_id' => 'int',
    'application_id' => 'int',
  ];

    protected $fillable = [
    'user_id',
    'application_id',
    'title',
    'file_name_org',
    'file_name',
    'type',
    'description',
    'is_videolink',
    'international'
  ];

    public function sf_guard_user()
    {
        return $this->belongsTo(\App\Models\SfGuardUser::class, 'user_id');
    }

    public function application()
    {
        return $this->belongsTo(\App\Models\Application::class);
    }
}
