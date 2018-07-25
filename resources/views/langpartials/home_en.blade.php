

 <noscript>
 <h3>Warning. Please activate Javascript</h3>
 </noscript>

 <div class="row">
   @php
     //dd($appinfos);
   @endphp
     @if ($appinfo->application_info_id == 1)
         <div class="col-md-12 alert alert-info">
         {!! Helper::simple_format_text($appinfos->info_en) !!}
         </div>
     @endif
     @if ($appinfo->application_info_id == 3)
       <div class="col-md-12 alert alert-info">
     <h3>You are logged in. You can now create an application in the field of:</h3>
    </div>
    <!--<div class="col-md-10">-->

    <div class="col-md-12"><a class="btn btn-success btn-lg start" role="button" href="{{ route('applications.create', ['activity_id' => 1]) }}">{!! trans('titles.application_art') !!} <i class="fa fa-picture-o" aria-hidden="true"></i></a></div>
    <!--<div class="col-md-12">Experimentelle Komposition</div>-->
    <!--<div class="col-md-12"><a class="btn btn-warning btn-lg" role="button" href="{{ route('applications.create', ['activity_id' => 5]) }}">{!! trans('titles.application_comp') !!} <i class="fa fa-music" aria-hidden="true"></i></a></div>-->
    <!--<div class="col-md-12">Literatur</div>-->
    <div class="col-md-12"><a class="btn btn-info btn-lg start" role="button" href="{{ route('applications.create', ['activity_id' => 4]) }}">{!! trans('titles.start_application_literature') !!} <i class="fa fa-book" aria-hidden="true"></i> </a></div>
    After you've filled out the application form, you can upload media to your application.
      After you've uploaded the media there are no further steps needed to participate in the online application. During
      the application period you can change application details and media until application deadline. After that you can only
      change you profile data.


     @endif

     @if ($appinfo->application_info_id == 2)
       <div class="col-md-12 alert alert-info">
       <h3>You are logged in. You can now create an application in the field of:</h3>
       </div>
       <div class="col-md-12">Arts, sciences and economics</div>
       <div class="col-md-12"><a class="btn btn-info btn-lg" role="button" href="{{ route('applications.create', ['activity_id' => 3]) }}">{!! trans('titles.application_kww') !!} <i class="fa fa-book" aria-hidden="true"></i> </a></div>

       <div class="col-md-12 front-page-logged-in-advice" style="">  After you've filled out the application form, you can upload media to your application.
           After you've uploaded the media there are no further steps needed to participate in the online application. During
           the application period you can change application details and media until application deadline. After that you can only
           change you profile data.
            </div>

       </div>
         @endif

  </div>
