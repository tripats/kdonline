<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
      <div class="panel-heading">
          <div style="display: flex; justify-content: space-between; align-items: center;">
            @if ($appinfo->application_info_id == 2)
              {!! trans('titles.cna_kww') !!} {!! $app_year !!}
            @endif
            @if ($activity_id == 1)
              {!! trans('titles.cna_air') !!} {!! $app_year !!}
            @endif
            @if ($activity_id == 2)
              {!! trans('titles.cna_lit') !!} {!! $app_year !!}
            @endif
        </div>
      </div>
    </div>
@extends('layouts.app')

@section('template_title')
    Create a new application / eine neue Bewerbung erstellen
@endsection

@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <div style="display: flex; justify-content: space-between; align-items: center;">


                        </div>
                    </div>

                    <div class="panel-body">
                      {!! Form::open(['method' => 'POST', 'route' => 'application.store', 'class' => 'form-horizontal']) !!}
                          @php
                            $options = array('2','3','4');
                            $selected_value = 0;
                          @endphp
                          <div class="form-group{{ $errors->has('duration') ? ' has-error' : '' }}">
                              {!! Form::label('duration', __('application.duration')) !!}
                              {!! Form::select('duration', $options, $selected_value, ['class' => 'form-control', 'required' => 'required', 'multiple']) !!}
                              <small class="text-danger">{{ $errors->first('duration') }}</small>
                          </div>
                          {!! Form::hidden('activity_id', $activity_id) !!}
                          <div class="radio{{ $errors->has('preferred_start') ? ' has-error' : '' }}">
                              <div class="col-sm-offset-3 col-sm-9">
                                  <label for="preferred_start" class="radio">

                                    {!! Form::radio('preferred_start', 1,  null, [
                                      'class' => 'form-control',
                                      'id'    => 'radio_id',
                                      ]) !!}

                                      {{ __('application.first_half') }}
                                  </label>
                              </div>
                              <div class="col-sm-offset-3 col-sm-9">
                                  <label for="preferred_start" class="radio">

                                    {!! Form::radio('preferred_start', 2,  null, [
                                      'class' => 'form-control',
                                      'id'    => 'radio_id',
                                      ]) !!}

                                      {{ __('application.second_half') }}
                                  </label>
                              </div>

                              <div class="form-group{{ $errors->has('expectations') ? ' has-error' : '' }}">
                                  {!! Form::label('expectations', __('application.expectations')) !!}
                                  {!! Form::textarea('expectations', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                  <small class="text-danger">{{ $errors->first('expectations') }}</small>
                              </div>
                              @php
                                $options = array(0,1);
                                $selected_value = 0;
                              @endphp
                              <div class="form-group">
                                  <div class="checkbox{{ $errors->has('family') ? ' has-error' : '' }}">
                                      <label for="family">
                                          {!! Form::checkbox('family', null, null, ['id' => 'family']) !!} {{ __('application.family')}}
                                      </label>
                                  </div>
                                  <small class="text-danger">{{ $errors->first('family') }}</small>
                              </div>

                              @php
                                $options = array(0,1);
                                $selected_value = 0;
                              @endphp
                              <div class="form-group">
                                  <div class="checkbox{{ $errors->has('activity_id') ? ' has-error' : '' }}">
                                      <label for="activity_id">
                                          {!! Form::checkbox('activity_id', null, null, ['id' => 'activity_id']) !!} {{ __('application.activity')}}
                                      </label>
                                  </div>
                                  <small class="text-danger">{{ $errors->first('activity_id') }}</small>
                              </div>

                              <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                  {!! Form::label('description', __('application.description')) !!}
                                  {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                  <small class="text-danger">{{ $errors->first('description') }}</small>
                              </div>
                              <div class="form-group">
                                  <div class="checkbox{{ $errors->has('is_painting') ? ' has-error' : '' }}">
                                      <label for="is_painting">
                                          {!! Form::checkbox('is_painting', null, null, ['id' => 'is_painting']) !!} {{ __('application.is_painting')}}
                                      </label>
                                  </div>
                                  <small class="text-danger">{{ $errors->first('is_painting') }}</small>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="checkbox{{ $errors->has('is_graphic') ? ' has-error' : '' }}">
                                  <label for="is_graphic">
                                      {!! Form::checkbox('is_graphic', null, null, ['id' => 'is_graphic']) !!} {{ __('application.is_graphic')}}
                                  </label>
                              </div>
                              <small class="text-danger">{{ $errors->first('is_graphic') }}</small>
                          </div>
                          <div class="form-group">
                              <div class="checkbox{{ $errors->has('is_photography') ? ' has-error' : '' }}">
                                  <label for="is_photography">
                                      {!! Form::checkbox('is_photography', null, null, ['id' => 'is_photography']) !!} {{ __('application.is_photography')}}
                                  </label>
                              </div>
                              <small class="text-danger">{{ $errors->first('is_photography') }}</small>
                          </div>
                          <div class="form-group">
                              <div class="checkbox{{ $errors->has('is_video') ? ' has-error' : '' }}">
                                  <label for="is_video">
                                      {!! Form::checkbox('is_video', null, null, ['id' => 'is_video']) !!} {{ __('application.is_video')}}
                                  </label>
                              </div>
                              <small class="text-danger">{{ $errors->first('is_video') }}</small>
                          </div>
                          <div class="form-group">
                              <div class="checkbox{{ $errors->has('is_sculpture') ? ' has-error' : '' }}">
                                  <label for="is_sculpture">
                                      {!! Form::checkbox('is_sculpture', null, null, ['id' => 'is_sculpture']) !!} {{ __('application.is_sculpture')}}
                                  </label>
                              </div>
                              <small class="text-danger">{{ $errors->first('is_sculpture') }}</small>
                          </div>
                          <div class="form-group">
                              <div class="checkbox{{ $errors->has('is_installation') ? ' has-error' : '' }}">
                                  <label for="is_installation">
                                      {!! Form::checkbox('is_installation', null, null, ['id' => 'is_installation']) !!} {{ __('application.is_installation')}}
                                  </label>
                              </div>
                              <small class="text-danger">{{ $errors->first('is_installation') }}</small>
                          </div>
                          <div class="form-group">
                              <div class="checkbox{{ $errors->has('is_object') ? ' has-error' : '' }}">
                                  <label for="is_object">
                                      {!! Form::checkbox('is_object', null, null, ['id' => 'is_object']) !!} {{ __('application.is_object')}}
                                  </label>
                              </div>
                              <small class="text-danger">{{ $errors->first('is_object') }}</small>
                          </div>
                          <div class="form-group">
                              <div class="checkbox{{ $errors->has('is_performance') ? ' has-error' : '' }}">
                                  <label for="is_performance">
                                      {!! Form::checkbox('is_performance', null, null, ['id' => 'is_performance']) !!} {{ __('application.is_performance')}}
                                  </label>
                              </div>
                              <small class="text-danger">{{ $errors->first('is_performance') }}</small>
                          </div>
                          <div class="form-group">
                              <div class="checkbox{{ $errors->has('is_mixed_media') ? ' has-error' : '' }}">
                                  <label for="is_mixed_media">
                                      {!! Form::checkbox('is_mixed_media', null, null, ['id' => 'is_mixed_media']) !!} {{ __('application.is_mixed_media')}}
                                  </label>
                              </div>
                              <small class="text-danger">{{ $errors->first('is_mixed_media') }}</small>
                          </div>
                          <div class="form-group">
                              <div class="checkbox{{ $errors->has('is_participative') ? ' has-error' : '' }}">
                                  <label for="is_participative">
                                      {!! Form::checkbox('is_participative', null, null, ['id' => 'is_participative']) !!} {{ __('application.is_participative')}}
                                  </label>
                              </div>
                              <small class="text-danger">{{ $errors->first('is_participative') }}</small>
                          </div>
                          <div class="form-group">
                              <div class="checkbox{{ $errors->has('is_sound') ? ' has-error' : '' }}">
                                  <label for="is_sound">
                                      {!! Form::checkbox('is_sound', null, null, ['id' => 'is_sound']) !!} {{ __('application.is_sound')}}
                                  </label>
                              </div>
                              <small class="text-danger">{{ $errors->first('is_sound') }}</small>
                          </div>
                          <div class="form-group">
                              <div class="checkbox{{ $errors->has('is_internet') ? ' has-error' : '' }}">
                                  <label for="is_internet">
                                      {!! Form::checkbox('is_internet', null, null, ['id' => 'is_internet']) !!} {{ __('application.is_internet')}}
                                  </label>
                              </div>
                              <small class="text-danger">{{ $errors->first('is_internet') }}</small>
                          </div>

                          <div class="form-group">
                              <div class="checkbox{{ $errors->has('is_interdisciplinary') ? ' has-error' : '' }}">
                                  <label for="is_interdisciplinary">
                                      {!! Form::checkbox('is_interdisciplinary', null, null, ['id' => 'is_interdisciplinary']) !!} {{ __('application.is_interdisciplinary')}}
                                  </label>
                              </div>
                              <small class="text-danger">{{ $errors->first('is_interdisciplinary') }}</small>
                          </div>
                        <div class="form-group">
                            <div class="checkbox{{ $errors->has('is_focus_visual') ? ' has-error' : '' }}">
                                <label for="is_focus_visual">
                                    {!! Form::checkbox('is_focus_visual', null, null, ['id' => 'is_focus_visual']) !!} {{ __('application.is_focus_visual')}}l
                                </label>
                            </div>
                            <small class="text-danger">{{ $errors->first('is_focus_visual') }}</small>
                        </div>
                        <div class="form-group">
                            <div class="checkbox{{ $errors->has('is_focus_sciences') ? ' has-error' : '' }}">
                                <label for="is_focus_sciences">
                                    {!! Form::checkbox('is_focus_sciences', null, null, ['id' => 'is_focus_sciences']) !!} {{ __('application.is_focus_sciences')}}
                                </label>
                            </div>
                            <small class="text-danger">{{ $errors->first('is_focus_sciences') }}</small>
                        </div>
                        <div class="form-group">
                            <div class="checkbox{{ $errors->has('is_focus_economics') ? ' has-error' : '' }}">
                                <label for="is_focus_economics">
                                    {!! Form::checkbox('is_focus_economics', null, null, ['id' => 'is_focus_economics']) !!} {{ __('application.is_focus_economics')}}
                                </label>
                            </div>
                            <small class="text-danger">{{ $errors->first('is_focus_economics') }}</small>
                        </div>

                        <div class="form-group">
                            <div class="checkbox{{ $errors->has('is_energy') ? ' has-error' : '' }}">
                                <label for="is_energy">
                                    {!! Form::checkbox('is_energy', null, null, ['id' => 'is_energy']) !!} {{ __('application.is_energy')}}
                                </label>
                            </div>
                            <small class="text-danger">{{ $errors->first('is_energy') }}</small>
                        </div>

                          <div class="form-group">
                              <div class="checkbox{{ $errors->has('is_roman') ? ' has-error' : '' }}">
                                  <label for="is_roman">
                                      {!! Form::checkbox('is_roman', null, null, ['id' => 'is_roman']) !!} {{ __('application.is_roman')}}
                                  </label>
                              </div>
                              <small class="text-danger">{{ $errors->first('is_roman') }}</small>
                          </div>
                          <div class="form-group">
                              <div class="checkbox{{ $errors->has('is_theather') ? ' has-error' : '' }}">
                                  <label for="is_theather">
                                      {!! Form::checkbox('is_theather', null, null, ['id' => 'is_theather']) !!} {{ __('application.is_theather')}}
                                  </label>
                              </div>
                              <small class="text-danger">{{ $errors->first('is_theather') }}</small>
                          </div>
                          <div class="form-group">
                              <div class="checkbox{{ $errors->has('is_literature_both') ? ' has-error' : '' }}">
                                  <label for="is_literature_both">
                                      {!! Form::checkbox('is_literature_both', null, null, ['id' => 'is_literature_both']) !!} {{ __('application.is_literature_both')}}
                                  </label>
                              </div>
                              <small class="text-danger">{{ $errors->first('is_literature_both') }}</small>
                          </div>

                          <div class="btn-group pull-right">
                              {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!}
                              {!! Form::submit("Add", ['class' => 'btn btn-success']) !!}
                          </div>
                      {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')

  @include('scripts.delete-modal-script')
  @include('scripts.save-modal-script')
@endsection
