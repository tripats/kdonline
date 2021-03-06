<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@if (trim($__env->yieldContent('template_title')))@yield('template_title') | @endif {{ config('app.name', Lang::get('titles.app')) }}</title>
        <meta name="description" content="">
        <meta name="author" content="kuenstlerdorf online">
        <link rel="shortcut icon" href="/favicon.ico">

        {{-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --}}
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        {{-- Fonts --}}
        @yield('template_linked_fonts')

        {{-- Styles --}}
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
        @yield('template_linked_css')

        <style type="text/css">
            @yield('template_fastload_css')

            @if (Auth::User() && (Auth::User()->profile) && (Auth::User()->profile->avatar_status == 0))
                .user-avatar-nav {
                    background: url({{ Gravatar::get(Auth::user()->email) }}) 50% 50% no-repeat;
                    background-size: auto 100%;
                }
            @endif

        </style>

        {{-- Scripts --}}
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>

        @if (Auth::User() && (Auth::User()->profile) && $theme->link != null && $theme->link != 'null')
            <link rel="stylesheet" type="text/css" href="{{ $theme->link }}">
        @endif

        @yield('head')

    </head>
    <body class="<?php echo Route::current()->getName();?>">
        <div id="app">

            @include('partials.nav')

            <div class="container">

                @include('partials.form-status')

            </div>

            @yield('content')

        </div>

        {{-- Scripts --}}
        <script src="{{ mix('/js/app.js') }}"></script>
        {{--
        {!! HTML::script('//maps.googleapis.com/maps/api/js?key='.env("GOOGLEMAPS_API_KEY").'&libraries=places&dummy=.js', array('type' => 'text/javascript')) !!}
        --}}
        @yield('footer_scripts')
        <footer>	<div class="row">
  <div class="container text-center">
    <h5>
      @if ( App::getLocale() == 'en')
        <p>The copyright of the pictures,audio recordings and videos published by the artists, who occupy the creatorship, on this page remains at the creators. Their application and duplication in other electronical or printed publications isn`t allowed without the explicit affirmation of the creatorT</p>

      @elseif ( App::getLocale() == 'de' )
        <p>Das Copyright für die auf diesen Seiten veröffentlichten und in der Urheberschaft bei den jeweiligen KünstlerInnen selbst liegenden Bildern, Tonwerken und Videos verbleibt bei den jeweiligen Urhebern. Ihre Verwendung oder eine Vervielfältigung in anderen elektronischen oder gedruckten Veröffentlichungen ist ohne ausdrückliche Zustimmung der/des jeweiligen Urheberin/Urhebers nicht zulässig.      </p>

      @endif
      </h5>
  </div>
  </div></footer>
</html>
