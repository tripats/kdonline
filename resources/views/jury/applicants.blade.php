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


                          {!! Form::open(['method' => 'POST', 'route' => 'search_user', 'class' => 'form-horizontal']) !!}
                              {!! Form::text('findcustomer', null, ['class' => 'form-control', 'required' => 'required']) !!}
                              {!! Form::submit('Suche Bewerber');!!}
                          {!! Form::close() !!}

                          @endlevel(5)

                    </div>
                       <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="panel-body">

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-condensed data-table">
                                <thead>
                                    <tr>
                                        <td>Id</td>
                                        <td>Name</td>
                                        <td>Email</td>
                                        <td>Bearbeiten</td>
                                        <td>Bewerbungen</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($applicants as $applicant)
                                      <tr>
                                          <td>{{$applicant->id}}</td>


                                            <td>
                                                {{ $applicant->first_name }} {{ $applicant->last_name }}
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $applicant->email }}" target="_top">{{ $applicant->email }}</a>
                                            </td>
                                              <td><a class="btn btn-xs btn-info btn-block" href="{{ route('users.show', ['id' => $applicant->id])}}">User anzeigen/bearbeiten </a></td>

                                            <td>
                                              <td><a class="btn btn-xs btn-info btn-block" href="{{ route('show_applications', ['id' => $applicant->id])}}">Zeige Bewerbungen</a></td>
                                            </td>
                                            @level(5)
                                            <td>

                                            </td>
                                            @endlevel(5)

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


  @include('scripts.delete-modal-script')
  @include('scripts.save-modal-script')
@endsection
