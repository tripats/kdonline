<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationInfos extends Model
{
    protected $fillable = [
      'short_name',
      'full_name',
      'info_en',
      'info_de',
      'start_date',
      'end_date'
      ];
}
