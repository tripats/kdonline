@extends('layouts.app')

@section('template_title')
    Application Offline / keine Bewerbung zur Zeit möglich
@endsection

@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

              @if ( App::getLocale() == 'en')
                @include('langpartials.app_offline_en')
              @elseif ( App::getLocale() == 'de' )
                @include('langpartials.app_offline_de')
              @endif

            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
@endsection
