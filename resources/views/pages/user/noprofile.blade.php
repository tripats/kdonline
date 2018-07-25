@extends('layouts.app')

@section('template_title')
    {{ Auth::user()->name }} no profile / kein Profil
@endsection

@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 alert alert-info">

              <h3>
              @if(App::getLocale() == 'en')
                You need to fill out your <i class="fa fa-link"></i>{!! HTML::link(url('/profile/'.Auth::user()->name), trans('titles.profile')) !!} <i class="fa fa-user"></i> before you can start an application.
              @endif
              @if(App::getLocale() == 'de')
                Sie müssen erst Ihr <i class="fa fa-link"></i>{!! HTML::link(url('/profile/'.Auth::user()->name), trans('titles.profile')) !!} <i class="fa fa-user"></i> vollständig ausfülllen, bevor Sie eine Bewerbung anlegen können.
              @endif
            </h3>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
@endsection
