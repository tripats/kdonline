@extends('layouts.app')

@section('template_title')
    Create a new application / eine neue Bewerbung erstellen
@endsection

@section('template_fastload_css')
@endsection

@section('content')

<div class="container">
      <div class = "row">
            <div class="col-sm-12">
                {!! Form::model($medium, ['route' => ['media.update', $medium->id], 'method' => 'PUT']) !!}

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        {!! Form::label('title', __('application.title')) !!}
                        {!! Form::text('title', null, ['class' => 'form-control']) !!}
                        <small class="text-danger">{{ $errors->first('title') }}</small>
                    </div>
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        {!! Form::label('description', trans('media.description')) !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                        <small class="text-danger">{{ $errors->first('description') }}</small>
                    </div>
                    @if (Auth::user()->profile->profile_public == 1)
                      @php
                        $options = array(0,1);
                        $selected_value = 0;
                      @endphp
                      {{Form::hidden('international',0)}}
                      <div class="form-group has-feedback {{ $errors->has('international') ? ' has-error ' : '' }}">
                          {!! Form::label('international', __('application.mark'), array('class' => 'col-sm-4 control-label')) !!}
                        <div class="col-sm-6">
                            {!! Form::checkbox('international', 1, null, ['id' => 'international']) !!} {{ __('application.international')}}
                              @if ($errors->has('international'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('international') }}</strong>
                                  </span>
                              @endif
                        </div>
                      </div>
                      @else
                        {{ Form::hidden('international', '0') }}
                    @endif
                    <div class="btn-group pull-right">

                        {!! Form::submit(__('media.update'), ['class' => 'btn btn-success']) !!}
                    </div>

                {!! Form::close() !!}
          </div>
      </div>
</div>
@endsection

@section('footer_scripts')

@endsection
