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
                                                <a class="btn btn-xs btn-info btn-block" href="{{ URL::to('jury/show/' . $application->id . '') }}" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">{!! trans('titles.edit') !!}/</span><span class="hidden-xs hidden-sm hidden-md">Bewerbung/Profil/Vita anschauen</span>
                                                </a>
                                            </td>

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


                                      </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
