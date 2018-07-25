<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationConfig extends Model
{
    protected $table = 'application_config';
    protected $fillable = [
      'application_info_id',
      'application_year'
      ];
}
