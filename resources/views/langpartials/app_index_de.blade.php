<noscript>
<h3>Achtung !!! Ihr Browser unterstüzt kein Javascript, bitte aktivieren Sie es!!!</h3>
</noscript>

@php
  /** check applcation ID 1 ist offline 2 kww und 3 artist in residence **/
  $appinfo = \App\Models\ApplicationConfig::first();
@endphp



@if ($appinfo->application_info_id == 3)
<!--<div class="row">
   <div class="col-md-1"></div>
   <div class="col-md-2"><a class="btn btn-success btn-md" role="button" href="{{ route('applications.create', ['activity_id' => 1]) }}">{!! trans('titles.application_art') !!} <i class="fa fa-picture-o" aria-hidden="true"></i></a></div>
   <div class="col-md-1"></div>
   <div class="col-md-2"><a class="btn btn-warning btn-md" role="button" href="{{ route('applications.create', ['activity_id' => 5]) }}">{!! trans('titles.application_comp') !!} <i class="fa fa-music" aria-hidden="true"></i></a></div>
   <div class="col-md-1"></div>
   <div class="col-md-2"><a class="btn btn-info btn-md" role="button" href="{{ route('applications.create', ['activity_id' => 4]) }}">{!! trans('titles.start_application_literature') !!} <i class="fa fa-book" aria-hidden="true"></i> </a></div>
   <div class="col-md-1"></div>
 </div>
-->
 <div class="row">
    <div class="col-md-4"><a class="btn btn-success btn-md" role="button" href="{{ route('applications.create', ['activity_id' => 1]) }}">{!! trans('titles.application_art') !!} <i class="fa fa-picture-o" aria-hidden="true"></i></a></div>
    <div class="col-md-2"></div>
    <!--<div class="col-md-4"><a class="btn btn-warning btn-md" role="button" href="{{ route('applications.create', ['activity_id' => 5]) }}">{!! trans('titles.application_comp') !!} <i class="fa fa-music" aria-hidden="true"></i></a></div>-->
    <div class="col-md-4"><a class="btn btn-info btn-md" role="button" href="{{ route('applications.create', ['activity_id' => 4]) }}">{!! trans('titles.start_application_literature') !!} <i class="fa fa-book" aria-hidden="true"></i> </a></div>
    <div class="col-md-2"></div>
  </div>
@endif
@if ($appinfo->application_info_id == 2)
<div class="row">
   <div class="col-md-4"></div>
   <div class="col-md-4"><a class="btn btn-success btn-lg" role="button" href="{{ route('applications.create', ['activity_id' => 3]) }}">{!! trans('titles.application_kww') !!} <i class="fa fa-book" aria-hidden="true"></i> </a></div>
   <div class="col-md-4"></div>
 </div>
@endif
<!--
<div class="row">
  <div class="col-md-12">
    <div class="alert info">{!! trans('titles.application_overview') !!}</div>
  </div>
</div>
-->
