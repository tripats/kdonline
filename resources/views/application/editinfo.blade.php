@extends('layouts.app')

@section('template_title')
    Texte für Frontpage bearbeiten.
@endsection

@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                      {!! Form::model($applicationinfos, ['route' => ['applicationinfos.update', $applicationinfos->id] , 'class' => 'form-horizontal', 'method' => 'PUT']) !!}
                      <div class="form-group has-feedback {{ $errors->has('info_de') ? ' has-error ' : '' }}">
                          {!! Form::label('info_de', 'Infos Deutsch', array('class' => 'col-sm-4 control-label')) !!}
                        <div class="col-sm-12">
                            {!! Form::textarea('info_de', null, ['class' => 'form-control', 'required' => 'required']) !!}
                              @if ($errors->has('info_de'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('info_de') }}</strong>
                                  </span>
                              @endif
                        </div>
                      </div>

                      <div class="form-group has-feedback {{ $errors->has('info_en') ? ' has-error ' : '' }}">
                          {!! Form::label('info_en', 'Infos Englisch', array('class' => 'col-sm-4 control-label')) !!}
                        <div class="col-sm-12">
                            {!! Form::textarea('info_en', null, ['class' => 'form-control', 'required' => 'required']) !!}
                              @if ($errors->has('info_en'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('info_en') }}</strong>
                                  </span>
                              @endif
                        </div>
                      </div>

                        <div class="btn-group pull-right">
                            {!! Form::submit( 'Update Infos', ['class' => 'btn btn-success']) !!}
                        </div>

                      {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')

  @include('scripts.delete-modal-script')
  @include('scripts.save-modal-script')
@endsection
