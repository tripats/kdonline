@extends('layouts.app')

@section('template_title')
    Create a new application / eine neue Bewerbung erstellen
@endsection

@section('template_fastload_css')
@endsection

@section('content')
  @php
    /** check application_info_id / 1 ist offline 2 kww und 3 artist in residence **/
    $appinfo = \App\Models\ApplicationConfig::first();
    $app_year = $appinfo->application_year;
  @endphp

  @section('content')

  	<div class="container">
  		<div class="row">
  			<div class="col-md-10 col-md-offset-1">
  				<div class="panel panel-default">
            <div class="panel-heading">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                  @if ($activity_id == 3)
                    {!! trans('titles.cna_kww') !!} {!! $app_year !!}
                  @endif
                  @if ($activity_id == 1)
                    {!! trans('titles.cna_air') !!} {!! $app_year !!}
                  @endif
                  @if ($activity_id == 4)
                    {!! trans('titles.cna_lit') !!} {!! $app_year !!}
                  @endif
                  @if ($activity_id == 5)
                    {!! trans('titles.cna_comp') !!} {!! $app_year !!}
                  @endif
              </div>
            </div>
          </div>
  					<div class="panel-body">

  								<div class="tab-content">
                    {!! Form::open(['method' => 'POST', 'route' => 'application.store', 'class' => 'form-horizontal']) !!}
                    {!! Form::hidden('activity_id', $activity_id) !!}
                    @php
                      $options = array('2','3','4');
                      $selected_value = 0;
                    @endphp
  									<div class="tab-pane fade in active edit_profile">
                      <!-- wenn nicht komposition duration einblenden -->
                        @if ($activity_id != 5)
  										<div class="row">
  											<div class="col-sm-12">
                          <div class="form-group has-feedback {{ $errors->has('duration') ? ' has-error ' : '' }}">
                            {!! Form::label('duration', __('application.duration') , array('class' => 'col-sm-4 control-label')); !!}
                            <div class="col-sm-6">
                              {!! Form::select('duration', $options, $selected_value, ['class' => 'form-control', 'required' => 'required', 'single']) !!}
                                  @if ($errors->has('duration'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('duration') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>
                        @endif

                          <!--  wenn AIS Auswahl von Präferenz für Stipendienbeginn -->
                          @php
                            $options = array('1' =>  __('application.fhy'),'2' => __('application.shy'));
                            $selected_value = 0;
                          @endphp
                              @if ($appinfo->application_info_id == 3)

                                  <div class="form-group has-feedback {{ $errors->has('preferred_start') ? ' has-error ' : '' }}">
                                    {!! Form::label('preferred_start', __('application.preferred_start') , array('class' => 'col-sm-4 control-label')); !!}
                                    <div class="col-sm-6">
                                      {!! Form::select('preferred_start', $options, $selected_value, ['class' => 'form-control', 'required' => 'required', 'single']) !!}
                                          @if ($errors->has('preferred_start'))
                                              <span class="help-block">
                                                  <strong>{{ $errors->first('preferred_start') }}</strong>
                                              </span>
                                          @endif
                                    </div>
                                  </div>
                              @endif
                              <!-- Ende von  wenn AIS Auswahl von Präferenz für Stipendienbeginn  -->

                          <!--  wenn AIS auswahl von Kunst Kategorie -->
                          @php
                            $options = array('1' =>  __('application.art'),'2' => __('application.mixed'));
                            $selected_value = 0;
                          @endphp
                              @if ($activity_id == 1)

                                  <div class="form-group has-feedback {{ $errors->has('preferred_start') ? ' has-error ' : '' }}">
                                    {!! Form::label('preferred_start', __('application.fow') , array('class' => 'col-sm-4 control-label')); !!}
                                    <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">

                                                    {!! Form::radio('activity_id', 1,  null, [
                                                        'class' => 'form-control', 'required' => 'required',
                                                        'value'    => '1',
                                                    ]) !!} {{ __('application.art') }}
                                                </label>
                                        </div>
                                        <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">


                                                        {!! Form::radio('activity_id', 2,  null, [
                                                            'class' => 'form-control', 'required' => 'required',
                                                            'value'    => '2',
                                                        ]) !!} {{ __('application.mixed') }}
                                                    </label>
                                            </div>
                                  </div>
                              @endif
                              <!-- ende von  wenn AIS auswahl von Kunst Kategorie  -->

                          <div class="form-group has-feedback {{ $errors->has('expectations') ? ' has-error ' : '' }}">
                              {!! Form::label('expectations', __('application.expectations'), array('class' => 'col-sm-4 control-label')) !!}
                            <div class="col-sm-6">
                                {!! Form::textarea('expectations', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                  @if ($errors->has('expectations'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('expectations') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>

                          @php
                            $options = array(0,1);
                            $selected_value = 0;
                          @endphp
                          <div class="form-group has-feedback {{ $errors->has('family') ? ' has-error ' : '' }}">
                              {!! Form::label('family', __('application.family_family'), array('class' => 'col-sm-4 control-label')) !!}
                            <div class="col-sm-6">
                                {!! Form::checkbox('family', 1, null, ['id' => 'family']) !!} {{ __('application.family')}}
                                  @if ($errors->has('family'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('family') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>

                          <div class="form-group has-feedback {{ $errors->has('description') ? ' has-error ' : '' }}">
                              {!! Form::label('description', __('application.description'), array('class' => 'col-sm-4 control-label')) !!}
                            <div class="col-sm-6">
                                {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                  @if ($errors->has('description'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('description') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>

                          <!--  check wenn artist in residence -->
                          @if ($activity_id == 1)

                          <div class="col-sm-10 control-label">{{__('application.hl')}}</div>
                          <div class="form-group has-feedback {{ $errors->has('is_painting') ? ' has-error ' : '' }}">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-6">
                                {!! Form::checkbox('is_painting', 1, null, ['id' => 'is_painting']) !!} {{ __('application.is_painting')}}
                                  @if ($errors->has('is_painting'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('is_painting') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>


                          <div class="form-group has-feedback {{ $errors->has('is_graphic') ? ' has-error ' : '' }}">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-6">
                                {!! Form::checkbox('is_graphic', 1, null, ['id' => 'is_graphic']) !!} {{ __('application.is_graphic')}}
                                  @if ($errors->has('is_graphic'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('is_graphic') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>
                          <div class="form-group has-feedback {{ $errors->has('is_photography') ? ' has-error ' : '' }}">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-6">
                                {!! Form::checkbox('is_photography', 1, null, ['id' => 'is_photography']) !!} {{ __('application.is_photography')}}
                                  @if ($errors->has('is_photography'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('is_photography') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>

                          <div class="form-group has-feedback {{ $errors->has('is_video') ? ' has-error ' : '' }}">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-6">
                                {!! Form::checkbox('is_video', 1, null, ['id' => 'is_video']) !!} {{ __('application.is_video')}}
                                  @if ($errors->has('is_video'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('is_video') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>

                          <div class="form-group has-feedback {{ $errors->has('is_sculpture') ? ' has-error ' : '' }}">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-6">
                                {!! Form::checkbox('is_sculpture', 1, null, ['id' => 'is_sculpture']) !!} {{ __('application.is_sculpture')}}
                                  @if ($errors->has('is_sculpture'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('is_sculpture') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>

                          <div class="form-group has-feedback {{ $errors->has('is_installation') ? ' has-error ' : '' }}">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-6">
                                {!! Form::checkbox('is_installation', 1, null, ['id' => 'is_installation']) !!} {{ __('application.is_installation')}}
                                  @if ($errors->has('is_installation'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('is_installation') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>

                          <div class="form-group has-feedback {{ $errors->has('is_object') ? ' has-error ' : '' }}">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-6">
                                {!! Form::checkbox('is_object', 1, null, ['id' => 'is_object']) !!} {{ __('application.is_object')}}
                                  @if ($errors->has('is_object'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('is_object') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>

                          <div class="form-group has-feedback {{ $errors->has('is_performance') ? ' has-error ' : '' }}">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-6">
                                {!! Form::checkbox('is_performance', 1, null, ['id' => 'is_performance']) !!} {{ __('application.is_performance')}}
                                  @if ($errors->has('is_performance'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('is_performance') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>

                          <div class="form-group has-feedback {{ $errors->has('is_mixed_media') ? ' has-error ' : '' }}">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-6">
                                {!! Form::checkbox('is_mixed_media', 1, null, ['id' => 'is_mixed_media']) !!} {{ __('application.is_mixed_media')}}
                                  @if ($errors->has('is_mixed_media'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('is_mixed_media') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>

                          <div class="form-group has-feedback {{ $errors->has('is_participative') ? ' has-error ' : '' }}">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-6">
                                {!! Form::checkbox('is_participative', 1, null, ['id' => 'is_participative']) !!} {{ __('application.is_participative')}}
                                  @if ($errors->has('is_participative'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('is_participative') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>

                          <div class="form-group has-feedback {{ $errors->has('is_sound') ? ' has-error ' : '' }}">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-6">
                                {!! Form::checkbox('is_sound', 1, null, ['id' => 'is_sound']) !!} {{ __('application.is_sound')}}
                                  @if ($errors->has('is_sound'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('is_sound') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>

                          <div class="form-group has-feedback {{ $errors->has('is_internet') ? ' has-error ' : '' }}">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-6">
                                {!! Form::checkbox('is_internet', 1, null, ['id' => 'is_internet']) !!} {{ __('application.is_internet')}}
                                  @if ($errors->has('is_internet'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('is_internet') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>

                          <div class="form-group has-feedback {{ $errors->has('is_interdisciplinary') ? ' has-error ' : '' }}">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-6">
                                {!! Form::checkbox('is_object', 1, null, ['id' => 'is_interdisciplinary']) !!} {{ __('application.is_interdisciplinary')}}
                                  @if ($errors->has('is_interdisciplinary'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('is_interdisciplinary') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>
                        @endif
                        <!--  ende wenn artist in residence -->

                        <!--  wenn kww -->
                        <!--  check wenn artist in residence -->
                        @if ($activity_id == 3)

                              <div class="col-sm-10 control-label">{!! __('application.kww_hl') !!}</div>

                          <div class="form-group has-feedback {{ $errors->has('is_focus_visual') ? ' has-error ' : '' }}">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-6">
                                {!! Form::checkbox('is_object', 1, null, ['id' => 'is_focus_visual']) !!} {{ __('application.is_focus_visual')}}
                                  @if ($errors->has('is_focus_visual'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('is_focus_visual') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>

                          <div class="form-group has-feedback {{ $errors->has('is_focus_sciences') ? ' has-error ' : '' }}">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-6">
                                {!! Form::checkbox('is_focus_sciences', 1, null, ['id' => 'is_focus_sciences']) !!} {{ __('application.is_focus_sciences')}}
                                  @if ($errors->has('is_focus_sciences'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('is_focus_sciences') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>

                          <div class="form-group has-feedback {{ $errors->has('is_focus_economics') ? ' has-error ' : '' }}">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-6">
                                {!! Form::checkbox('is_focus_economics', 1, null, ['id' => 'is_focus_economics']) !!} {{ __('application.is_focus_economics')}}
                                  @if ($errors->has('is_focus_economics'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('is_focus_economics') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>

                          <div class="form-group has-feedback {{ $errors->has('is_energy') ? ' has-error ' : '' }}">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-6">
                                {!! Form::checkbox('is_energy', 1, null, ['id' => 'is_energy']) !!} {{ __('application.is_energy')}}
                                  @if ($errors->has('is_energy'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('is_energy') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>
                        @endif
                        <!--  ende kww -->
                        <!-- wenn literatur -->
                        @if ($activity_id == 4)
                            <div class="col-sm-10 control-label">{!! __('application.lhl') !!}</div>
                          <div class="form-group has-feedback {{ $errors->has('is_roman') ? ' has-error ' : '' }}">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-6">
                                {!! Form::checkbox('is_roman', 1, null, ['id' => 'is_roman']) !!} {{ __('application.is_roman')}}
                                  @if ($errors->has('is_roman'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('is_roman') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>

                          <div class="form-group has-feedback {{ $errors->has('is_theather') ? ' has-error ' : '' }}">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-6">
                                {!! Form::checkbox('is_theather', 1, null, ['id' => 'is_theather']) !!} {{ __('application.is_theather')}}
                                  @if ($errors->has('is_theather'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('is_theather') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>

                          <div class="form-group has-feedback {{ $errors->has('is_literature_both') ? ' has-error ' : '' }}">
                            <div class="col-sm-4 control-label"></div>
                            <div class="col-sm-6">
                                {!! Form::checkbox('is_literature_both', 1, null, ['id' => 'is_literature_both']) !!} {{ __('application.is_literature_both')}}
                                  @if ($errors->has('is_literature_both'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('is_literature_both') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>
                          <!-- ende literatur -->
                        @endif
  											</div>

                        <div class="btn-group pull-right">
                            {!! Form::submit( trans('application.send'), ['class' => 'btn btn-success']) !!}
                        </div>
  										</div>


                  {!! Form::close() !!}



  													</div>
  												</div>
  										    </div>
  										</div>
  									</div>
  								</div>

  					</div>
  				</div>
  			</div>
  		</div>
  	</div>

  	@include('modals.modal-form')

  @endsection
