<noscript>
<h3>Achtung !!! Ihr Browser unterstüzt kein Javascript, bitte aktivieren Sie es!!!</h3>
</noscript>

<div class="row">
  @php
    //dd($appinfos);
  @endphp
    @if ($appinfo->application_info_id == 1)
        <div class="col-md-12 alert alert-info">
        {!! Helper::simple_format_text($appinfos->info_de) !!}
        </div>

    @endif
    @if ($appinfo->application_info_id == 3)
      <div class="col-md-12 alert alert-info">
   <h3>Sie sind angemeldet. Sie können eine Bewerbung für folgende Schwerpunkte erstellen:</h3>
   </div>
   <!--<div class="col-md-10">-->


      <div class="col-md-12"><a class="btn btn-success btn-lg start" role="button" href="{{ route('applications.create', ['activity_id' => 1]) }}">{!! trans('titles.application_art') !!} <i class="fa fa-picture-o" aria-hidden="true"></i></a></div>
      <!--<div class="col-md-12">Experimentelle Komposition</div>-->
      <!--<div class="col-md-12"><a class="btn btn-warning btn-lg" role="button" href="{{ route('applications.create', ['activity_id' => 5]) }}">{!! trans('titles.application_comp') !!} <i class="fa fa-music" aria-hidden="true"></i></a></div>-->
      <!--<div class="col-md-12">Literatur</div>-->
      <div class="col-md-12"><a class="btn btn-info btn-lg start" role="button" href="{{ route('applications.create', ['activity_id' => 4]) }}">{!! trans('titles.start_application_literature') !!} <i class="fa fa-book" aria-hidden="true"></i> </a></div>
      <div class="col-md-12 front-page-logged-in-advice" style="">Nachdem Sie das Formular ausgefüllt haben, können Sie die Medien zu Ihrer Bewerbung hochladen.
        Nach dem Hochladen der Medien sind keine weiteren Schritte notwendig um am Bewerbungsverfahren teilzunehmen. Sie können die Daten der Bewerbung noch bis
        zum Bewerbungsschluss bearbeiten und ergänzen.
      </div>

    @endif

    @if ($appinfo->application_info_id == 2)
      <div class="col-md-12 alert alert-info">
      <h3>Sie sind angemeldet. Sie können eine Bewerbung für folgende Schwerpunkte erstellen:</h3>
      </div>
        <div class="col-md-12">Kunst, Wissenschaft, Wirtschaft</div>
        <div class="col-md-12"><a class="btn btn-info btn-lg" role="button" href="{{ route('applications.create', ['activity_id' => 3]) }}">{!! trans('titles.application_kww') !!} <i class="fa fa-book" aria-hidden="true"></i> </a></div>

      <div class="col-md-12 front-page-logged-in-advice" style="">Nachdem Sie das Formular ausgefüllt haben, können Sie die Medien zu Ihrer Bewerbung hochladen.
        Nach dem Hochladen der Medien sind keine weiteren Schritte notwendig um am Bewerbungsverfahren teilzunehmen. Sie können die Daten der Bewerbung noch bis
        zum Bewerbungsschluss bearbeiten und ergänzen.
      </div>
        @endif

 </div>
