@extends('layouts.app')

@section('template_title')
    Application Configuration
@endsection

@section('template_fastload_css')
@endsection

@section('content')


  @section('content')

  	<div class="container">
  		<div class="row">
  			<div class="col-md-10 col-md-offset-1">
  				<div class="panel panel-default">
            <div class="panel-heading">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                  Konfiguration der Bewerbungsphase
              </div>
            </div>
          </div>
  					<div class="panel-body">

  								<div class="tab-content">
                  {!! Form::model($applicationconfig, ['route' => ['applicationconfig.update', $applicationconfig->id], 'method' => 'PUT']) !!}

  									<div class="tab-pane fade in active edit_profile">

  										<div class="row">
  											<div class="col-sm-12">
                          <div class="form-group has-feedback {{ $errors->has('year') ? ' has-error ' : '' }}">
                            {!! Form::label('application_year', 'Bewerbung für das Jahr:' , array('class' => 'col-sm-4 control-label')); !!}
                            <div class="col-sm-6">
                              <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                                  {!! Form::text('application_year', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                  <small class="text-danger">{{ $errors->first('year') }}</small>
                              </div>
                                  @if ($errors->has('year'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('year') }}</strong>
                                      </span>
                                  @endif
                            </div>
                          </div>
                          <div class="form-group has-feedback {{ $errors->has('year') ? ' has-error ' : '' }}">
                            {!! Form::label('Bewerbungsphase','Bewerbungsphase:' , array('class' => 'col-sm-4 control-label')); !!}
                            <div class="col-sm-6">
                              <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">

                                              {!! Form::radio('application_info_id', 1,  null, [
                                                  'class' => 'form-control',
                                                  'value'    => '1',
                                              ]) !!} Offline
                                          </label>
                                  </div>
                                  <a class="btn btn-xs btn-info btn-block" href="{{ route('applicationinfos.edit', ['id' => 1]) }}">Text auf der Frontpage bearbeiten</span></a>
                                  <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">


                                                  {!! Form::radio('application_info_id', 2,  null, [
                                                      'class' => 'form-control',
                                                      'value'    => '2',
                                                  ]) !!} Kww
                                              </label>
                                      </div>
                                      <a class="btn btn-xs btn-info btn-block" href="{{ route('applicationinfos.edit', ['id' => 2]) }}">Text auf der Frontpage bearbeiten</span></a>
                                      <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">


                                                      {!! Form::radio('application_info_id', 3,  null, [
                                                          'class' => 'form-control',
                                                          'value'    => '3',
                                                      ]) !!} Artist in Residence
                                                  </label>
                                          </div>
                                          <a class="btn btn-xs btn-info btn-block" href="{{ route('applicationinfos.edit', ['id' => 3]) }}">Text auf der Frontpage bearbeiten</span></a>
                              </div>

                            </div>
                          </div>
  											</div>

                        <div class="btn-group pull-right">
                            {!! Form::submit( 'Update der Daten', ['class' => 'btn btn-success']) !!}
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
