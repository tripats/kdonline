@extends('layouts.app')

@section('template_title')
    Image upload / Bilder Upload
@endsection

@section('template_fastload_css')
@endsection

@section('content')

<link rel="stylesheet" href="/css/light-modal.min.css">

<div class="container">
    <div class="row">
      @php
        $mediacount = $application->countMedia($id,1);
      @endphp
      @if ($mediacount < Config::get('application.max_image_count'))
        <div class="col-md-12">
          @if ( App::getLocale() == 'en')

            @include('langpartials/image_en')

          @elseif ( App::getLocale() == 'de' )

            @include('langpartials/image_de')

          @endif
          <div class="panel panel-default">
              <div class="panel-heading">
                <div style="display: flex; justify-content: space-between; align-items: center;">



          {!! Form::model($media, ['route' => ['imagestore', $application->id], 'method' => 'PUT', 'files' => true, 'enctype' => 'multipart/form-data', 'id' => 'image-upload']) !!}
          <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
              {!! Form::label('title', trans('media.title')) !!}
              {!! Form::text('title', null, ['class' => 'form-control']) !!}
              <small class="text-danger">{{ $errors->first('title') }}</small>
          </div>
          <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
              {!! Form::label('description', trans('media.description')) !!}
              {!! Form::textarea('description', '', ['class' => 'form-control']) !!}
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
                      {!! Form::checkbox('international', 1, false, ['id' => 'international']) !!} {{ __('application.international')}}
                        @if ($errors->has('international'))
                            <span class="help-block">
                                <strong>{{ $errors->first('international') }}</strong>
                            </span>
                        @endif
                  </div>
                </div>
                @else

                  {{ Form::hidden('international', 0) }}
              @endif
    <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">

        {!! Form::file('file', ['required' => 'required','accept'=>'image/jpeg']) !!}

        <small class="text-danger">{{ $errors->first('file') }}</small>
        {!! Form::hidden('type', $type) !!}
    </div>
          {!! Form::submit(trans('media.uploadpicture') , ['class' => 'btn btn-info pull-right']) !!}
          {!! Form::close() !!}
        </div>


    </div>
  </div>

    </div>

@else
  <div class="col-md-12 alert alert-info">
    @if ( App::getLocale() == 'en')

      @include('langpartials/maxmedia_en')

    @elseif ( App::getLocale() == 'de' )

      @include('langpartials/maxmedia_de')
    @endif
  </div>
@endif
</div>
  <div class="row">
        <div class="panel-heading">
        @foreach ($media as $medium)
              <div class="col-sm-12">

                  <div class="col-md-6">
                    <a href="#image-modal{{ $medium->id }}" class="btn"><img src="{{ asset('storage/media/images_medium/'.$medium->file_name) }}" class="small-img"></a>
                    <div class="light-modal" id="image-modal{{ $medium->id }}" role="dialog" aria-labelledby="light-modal-label" aria-hidden="false">
                            <div class="light-modal-content animated zoomInUp">
                                <img src="{{ asset('storage/media/images_large/'.$medium->file_name) }}" alt="from unsplash">
                                <a href="#" class="light-modal-close-icon" aria-label="close">&times;</a>
                                <div class="light-modal-caption">{!! $medium->title !!}</div>
                            </div>
                        </div>
                  </div>

                <div class="col-md-6">

                        <div class="caption">
                          <h2>{!! $medium->title !!}</h2>

                          {!! Helper::simple_format_text($medium->description) !!}
                        </div>

              {!! Form::open(array('url' => 'deleteimage/' . $medium->id, 'method'=> 'DELETE', 'class' => '', 'btn btn-danger btn-md pull-right' => 'tooltip', 'title' => 'Delete')) !!}
                  {!! Form::hidden('_method', 'DELETE') !!}
                  {!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-md pull-right','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => __('media.delete_media'), 'data-message' => __('media.delete_media_long'))) !!}
              {!! Form::close() !!}

              {!! Form::open(array('url' => 'media/'.$medium->id.'/edit', 'method'=> 'GET', 'class' => 'edit', 'data-toggle' => 'tooltip', 'title' => 'Edit ')) !!}
                  {!! Form::submit(__('application.editdescription'), ['class' => 'btn btn-info btn-md pull-right']) !!}
              {!! Form::close() !!}

                 </div>

            </div>
          @endforeach
        </div>

      </div>
</div>

@endsection
  @include('modals.modal-delete')
@section('footer_scripts')

  @include('scripts.delete-modal-script')
  @include('scripts.save-modal-script')
@endsection
