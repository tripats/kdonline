<noscript>
<h3>Please activate javascript</h3>
</noscript>

@php
  /** check applcation ID 1 ist offline 2 kww und 3 artist in residence **/
  $appinfo = \App\Models\ApplicationConfig::first();
@endphp
  <div style="display: flex; justify-content: space-between; align-items: center;">
    @if ($appinfo->application_info_id == 3)
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
   <div class="col-md-4"><a class="btn btn-info btn-lg" role="button" href="{{ route('applications.create', ['activity_id' => 3]) }}">{!! trans('titles.application_kww') !!} <i class="fa fa-book" aria-hidden="true"></i> </a></div>
   <div class="col-md-4"></div>
 </div>
@endif

</div>
