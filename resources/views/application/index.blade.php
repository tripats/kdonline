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
        @include('langpartials.app_index_en')
      @elseif ( App::getLocale() == 'de' )
        @include('langpartials.app_index_de')
      @endif
        </div>
        <div class="row" style="height:20px">
      </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      {!! trans('titles.overview') !!}

                    </div>

                    <div class="panel-body">

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-condensed data-table">
                                <thead>
                                    <tr>
                                        <th>{!! trans('titles.foaw') !!}</th>
                                        <th>{!! trans('titles.update') !!} </th>
                                        <th>{!! trans('titles.media_pictures') !!} </th>
                                        <th>{!! trans('titles.media_video') !!}</th>
                                        <th>{!! trans('titles.media_sound') !!}</th>
                                        <th>{!! trans('titles.pdf') !!} </th>
                                        <th>{!! trans('titles.year') !!} </th>
                                        <th>{!! trans('titles.delete') !!} </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($applications as $application)
                                      <tr>

                                          <td>
                                            @if ($application->activity_id == 1)
                                              {!! trans('titles.art') !!}
                                            @elseif ($application->activity_id == 2)
                                              {!! trans('titles.mixedmedia') !!}
                                            @elseif ($application->activity_id == 3)
                                              {!! trans('titles.kww') !!}
                                            @elseif ($application->activity_id == 4)
                                              {!! trans('titles.literature') !!}
                                            @elseif ($application->activity_id == 5)
                                              {!! trans('titles.composition') !!}
                                            @endif

                                          </td>

                                            <td>
                                                <a class="btn btn-xs btn-info btn-block" href="{{ URL::to('applications/' . $application->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">{!! trans('titles.edit') !!}/</span><span class="hidden-xs hidden-sm hidden-md">{!! trans('titles.update') !!}</span>
                                                </a>
                                            </td>
                                            @if ($application->activity_id <= 3)
                                            <td><a class="btn btn-xs btn-info btn-block" href="{{ route('imageupload', ['id' => $application->id, 'type' => 'image'])}}"><i class="fa fa-picture-o" aria-hidden="true"></i>{!! trans('titles.upload_image') !!} <span class="badge"> {{ $application->countMedia($application->id, 1) }} </span> <i class="fa fa-upload" aria-hidden="true"></i></span></a></td>

                                            <td><a class="btn btn-xs btn-info btn-block" href="{{ route('videoupload', ['id' => $application->id, 'type' => 'video'])}}"><i class="fa fa-video-camera" aria-hidden="true"></i>{!! trans('titles.upload_video') !!} <span class="badge"> {{ $application->countMedia($application->id, 2) }} </span> <i class="fa fa-upload" aria-hidden="true"></i></span></a></td>

                                            <td><a class="btn btn-xs btn-info btn-block" href="{{ route('audioupload', ['id' => $application->id, 'type' => 'audio'])}}"><i class="fa fa-music" aria-hidden="true"></i>{!! trans('titles.upload_sound') !!} <span class="badge"> {{ $application->countMedia($application->id, 3) }} </span> <i class="fa fa-upload" aria-hidden="true"></i></span></a></td>

                                            <td><a class="btn btn-xs btn-info btn-block" href="{{ route('pdfupload', ['id' => $application->id, 'type' => 'pdf'])}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>{!! trans('titles.upload_pdf') !!} <span class="badge"> {{ $application->countMedia($application->id, 4) }} </span> <i class="fa fa-upload" aria-hidden="true"></i></span></a></td>
                                          @endif

                                            @if ($application->activity_id == 4)
                                              <td></td><td></td><td></td>  <td><a class="btn btn-xs btn-info btn-block" href="{{ route('pdfupload', ['id' => $application->id, 'type' => 'pdf'])}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>{!! trans('titles.upload_pdf') !!} <span class="badge"> {{ $application->countMedia($application->id, 4) }} </span> <i class="fa fa-upload" aria-hidden="true"></i></span></a></td>
                                            @endif
                                          @if ($application->activity_id == 5)
                                            <td></td><td></td>  <td><a class="btn btn-xs btn-info btn-block" href="{{ route('audioupload', ['id' => $application->id, 'type' => 'audio'])}}"><i class="fa fa-music" aria-hidden="true"></i>{!! trans('titles.upload_sound') !!} <span class="badge"> {{ $application->countMedia($application->id, 3) }} </span> <i class="fa fa-upload" aria-hidden="true"></i></span></a><td></td></td>

                                          @endif
                                            <td>
                                                    @if ($application->year == \Carbon\Carbon::now()->year)
                                                        @php $labelClass = 'success';
                                                              $label = $application->application_year;
                                                        @endphp
                                                    @else
                                                        @php $labelClass = 'warning';
                                                              $label = $application->application_year;
                                                        @endphp

                                                    @endif


                                                    <span class="label label-{{$labelClass}}">{{ $label }}</span>

                                            </td>
                                            <td>
                                                {!! Form::open(array('url' => 'applications/' . $application->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => __('application.delete_app'), 'data-message' => __('application.delete_app_long'))) !!}
                                                {!! Form::close() !!}
                                            </td>

                                      </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                  @if ( App::getLocale() == 'en')
                    <h4>
                      Tip: To approve old applications in the current application process, open the old application under
                      "Edit / Change application" and save the application again.
                    </h4>
                  @elseif ( App::getLocale() == 'de' )
                <h4>Tipp: Um alte Bewerbungen im aktuellen Bewerbungsverfahren teilnehmen zu lassen, öffnen Sie die alte Bewerbung unter
                    "Bearbeiten/Bewerbung ändern" und speichern Sie die Bewerbung erneut ab.
                </h4>

                  @endif
                </div>
            </div>
        </div>
    </div>

@endsection
  @include('modals.modal-delete')
@section('footer_scripts')

  @if (count($applications) > 10)
      @include('scripts.datatables')
  @endif
  @include('scripts.delete-modal-script')
  @include('scripts.save-modal-script')
@endsection
