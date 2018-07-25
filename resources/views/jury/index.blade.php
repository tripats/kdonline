@extends('layouts.app')

@section('template_title')
    Übersicht aller Bewerbungen
@endsection
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">

        <div class="row" style="height:20px"></div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      Übersicht über die Bewerbungen
                          @level(5)
                          {!! Form::open(array('route' => 'jurypropose_reset', 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Reset')) !!}
                              {!! Form::hidden('_method', 'DELETE') !!}
                              {!! Form::button('Alle Jury Vorschläge zurücksetzen', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => __('application.reset_proposals'), 'data-message' => __('application.reset_proposals_long'))) !!}
                          {!! Form::close() !!}

                          {!! Form::open(['method' => 'POST', 'route' => 'search_user', 'class' => 'form-horizontal']) !!}
                              {!! Form::text('findcustomer', null, ['class' => 'form-control', 'required' => 'required']) !!}
                              {!! Form::submit('Suche Bewerber');!!}
                          {!! Form::close() !!}

                          @endlevel(5)

                    </div>
                       <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="panel-body">
                      {{ $applications->links() }}
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-condensed data-table">
                                <thead>
                                    <tr>
                                       <th>{!! trans('titles.appid') !!}</th>
                                        <th>{!! trans('titles.foaw') !!}</th>
                                        <th>{!! trans('titles.name') !!} </th>
                                        <th>{!! trans('titles.email') !!} </th>
                                        <th>{!! trans('titles.application_show') !!}</th>
                                        <th>{!! trans('titles.year') !!} </th>
                                        <th>Jury Vorschlag</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($applications as $application)
                                      <tr>
                                          <td>{{$application->id}}</td>
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
                                                {{ $application->user->first_name }} {{ $application->user->last_name }}
                                            </td>
                                            <td>
                                                {{ $application->user->email }}
                                            </td>

                                              <td><a class="btn btn-xs btn-info btn-block" href="{{ route('jury.show', ['id' => $application->id])}}">{!! trans('titles.application_show') !!} </a></td>


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
                                            @level(5)
                                            <td>
                                              <div>


                                              {!! Form::model($application, ['route' => ['applications.update', $application->id] , 'class' => 'form-horizontal', 'method' => 'PUT']) !!}

                                              <div id="{{$application->id}}">
                                              {!! Form::radio('is_proposed', 1,  null, [
                                                  'name'=>'is_proposed',
                                                  'value'    => '1',
                                              ]) !!} j
                                              {!! Form::radio('is_proposed', 0,  null, [
                                                  'name'=>'is_proposed',
                                                  'value'    => '0',
                                              ]) !!}  n

                                            </div>
                                            <div id="message-{{$application->id}}"></div>
                                            </form>

                                            </td>
                                            @endlevel(5)

                                            @level(3)
                                            <td>
                                              @if ($application->is_proposed == 1)
                                                  <i class="fa fa-check"></i>
                                              @endif
                                            </td>
                                            @endlevel(3)

                                      </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $applications->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
  @include('modals.modal-delete')
@section('footer_scripts')


  @include('scripts.delete-modal-script')
  @include('scripts.save-modal-script')
@endsection
