@extends('layouts.app')

@section('template_title')
    Create a new application / eine neue Bewerbung erstellen
@endsection

@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
      @if ( App::getLocale() == 'en')
        @include('langpartials.app_success_en')
      @elseif ( App::getLocale() == 'de' )
        @include('langpartials.app_success_de')
      @endif
        </div>
        <div class="row" style="height:20px">
      </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">

                    <div class="panel-body">
<!--
                      activity_id
                      1 Bildende Kunst
                      2 Mixed media
                      3 kww
                      4 Literatur
                      5 Composition
  -->
            @if ($application->activity_id == 1)
              <div class="col-sm-12" style="margin-top:20px;"><a class="btn btn-l btn-info btn-block" href="{{ route('imageupload', ['id' => $application->id, 'type' => 'image'])}}"><i class="fa fa-picture-o" aria-hidden="true"></i>{!! trans('titles.upload_image') !!} <span class="badge"> {{ $application->countMedia($application->id, 1) }} </span> <i class="fa fa-upload" aria-hidden="true"></i></span></a></div>
              <div class="col-sm-12" style="margin-top:20px;"><a class="btn btn-l btn-info btn-block" href="{{ route('videoupload', ['id' => $application->id, 'type' => 'video'])}}"><i class="fa fa-video-camera" aria-hidden="true"></i>{!! trans('titles.upload_video') !!} <span class="badge"> {{ $application->countMedia($application->id, 2) }} </span> <i class="fa fa-upload" aria-hidden="true"></i></span></a></div>
              <div class="col-sm-12" style="margin-top:20px;"><a class="btn btn-xl btn-info btn-block" href="{{ route('audioupload', ['id' => $application->id, 'type' => 'audio'])}}"><i class="fa fa-music" aria-hidden="true"></i>{!! trans('titles.upload_sound') !!} <span class="badge"> {{ $application->countMedia($application->id, 3) }} </span> <i class="fa fa-upload" aria-hidden="true"></i></span></a></div>
              <div class="col-sm-12" style="margin-top:20px;"><a class="btn btn-l btn-info btn-block" href="{{ route('pdfupload', ['id' => $application->id, 'type' => 'pdf'])}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>{!! trans('titles.upload_pdf') !!} <span class="badge"> {{ $application->countMedia($application->id, 4) }} </span> <i class="fa fa-upload" aria-hidden="true"></i></span></a></div>
            @elseif ($application->activity_id == 2)
              <div class="col-sm-12" style="margin-top:20px;"><a class="btn btn-l btn-info btn-block" href="{{ route('imageupload', ['id' => $application->id, 'type' => 'image'])}}"><i class="fa fa-picture-o" aria-hidden="true"></i>{!! trans('titles.upload_image') !!} <span class="badge"> {{ $application->countMedia($application->id, 1) }} </span> <i class="fa fa-upload" aria-hidden="true"></i></span></a></div>
              <div class="col-sm-12" style="margin-top:20px;"><a class="btn btn-l btn-info btn-block" href="{{ route('videoupload', ['id' => $application->id, 'type' => 'video'])}}"><i class="fa fa-video-camera" aria-hidden="true"></i>{!! trans('titles.upload_video') !!} <span class="badge"> {{ $application->countMedia($application->id, 2) }} </span> <i class="fa fa-upload" aria-hidden="true"></i></span></a></div>
              <div class="col-sm-12" style="margin-top:20px;"><a class="btn btn-xl btn-info btn-block" href="{{ route('audioupload', ['id' => $application->id, 'type' => 'audio'])}}"><i class="fa fa-music" aria-hidden="true"></i>{!! trans('titles.upload_sound') !!} <span class="badge"> {{ $application->countMedia($application->id, 3) }} </span> <i class="fa fa-upload" aria-hidden="true"></i></span></a></div>
              <div class="col-sm-12" style="margin-top:20px;"><a class="btn btn-l btn-info btn-block" href="{{ route('pdfupload', ['id' => $application->id, 'type' => 'pdf'])}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>{!! trans('titles.upload_pdf') !!} <span class="badge"> {{ $application->countMedia($application->id, 4) }} </span> <i class="fa fa-upload" aria-hidden="true"></i></span></a></div>
            @elseif ($application->activity_id == 3)
              <div class="col-sm-12" style="margin-top:20px;"><a class="btn btn-l btn-info btn-block" href="{{ route('imageupload', ['id' => $application->id, 'type' => 'image'])}}"><i class="fa fa-picture-o" aria-hidden="true"></i>{!! trans('titles.upload_image') !!} <span class="badge"> {{ $application->countMedia($application->id, 1) }} </span> <i class="fa fa-upload" aria-hidden="true"></i></span></a></div>
              <div class="col-sm-12" style="margin-top:20px;"><a class="btn btn-l btn-info btn-block" href="{{ route('videoupload', ['id' => $application->id, 'type' => 'video'])}}"><i class="fa fa-video-camera" aria-hidden="true"></i>{!! trans('titles.upload_video') !!} <span class="badge"> {{ $application->countMedia($application->id, 2) }} </span> <i class="fa fa-upload" aria-hidden="true"></i></span></a></div>
              <div class="col-sm-12" style="margin-top:20px;"><a class="btn btn-xl btn-info btn-block" href="{{ route('audioupload', ['id' => $application->id, 'type' => 'audio'])}}"><i class="fa fa-music" aria-hidden="true"></i>{!! trans('titles.upload_sound') !!} <span class="badge"> {{ $application->countMedia($application->id, 3) }} </span> <i class="fa fa-upload" aria-hidden="true"></i></span></a></div>
              <div class="col-sm-12" style="margin-top:20px;"><a class="btn btn-l btn-info btn-block" href="{{ route('pdfupload', ['id' => $application->id, 'type' => 'pdf'])}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>{!! trans('titles.upload_pdf') !!} <span class="badge"> {{ $application->countMedia($application->id, 4) }} </span> <i class="fa fa-upload" aria-hidden="true"></i></span></a></div>
            @elseif ($application->activity_id == 4)
              <div class="col-sm-12" style="margin-top:20px;"><a class="btn btn-l btn-info btn-block" href="{{ route('pdfupload', ['id' => $application->id, 'type' => 'pdf'])}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>{!! trans('titles.upload_pdf') !!} <span class="badge"> {{ $application->countMedia($application->id, 4) }} </span> <i class="fa fa-upload" aria-hidden="true"></i></span></a></div>
            @elseif ($application->activity_id == 5)
              <div class="col-sm-12" style="margin-top:20px;"><a class="btn btn-xl btn-info btn-block" href="{{ route('audioupload', ['id' => $application->id, 'type' => 'audio'])}}"><i class="fa fa-music" aria-hidden="true"></i>{!! trans('titles.upload_sound') !!} <span class="badge"> {{ $application->countMedia($application->id, 3) }} </span> <i class="fa fa-upload" aria-hidden="true"></i></span></a></div>

            @endif
          </div>

  </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
      @if ( App::getLocale() == 'en')
        @include('langpartials.app_success_bottom_en')
      @elseif ( App::getLocale() == 'de' )
        @include('langpartials.app_success_bottom_de')
      @endif
        </div>


@endsection
  @include('modals.modal-delete')
@section('footer_scripts')

  @include('scripts.delete-modal-script')
  @include('scripts.save-modal-script')
@endsection
