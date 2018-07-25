<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            {{-- Collapsed Hamburger --}}
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">{!! trans('titles.toggleNav') !!}</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            {{-- Branding Image --}}
            <a class="navbar-brand" href="{{ url('/') }}">

                {!! trans('titles.app') !!}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            {{-- Left Side Of Navbar --}}
            <ul class="nav navbar-nav">
                @role('admin')
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Admin <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li {{ Request::is('applicationconfig','applicationconfig') ? 'class=active' : null }}>{!! HTML::link(url('/applicationconfig'), Lang::get('titles.adminApplicationConfig')) !!}</li>
                            <li {{ Request::is('users', 'users/' . Auth::user()->id, 'users/' . Auth::user()->id . '/edit') ? 'class=active' : null }}>{!! HTML::link(url('/users'), Lang::get('titles.adminUserList')) !!}</li>
                            <li {{ Request::is('users/create') ? 'class=active' : null }}>{!! HTML::link(url('/users/create'), Lang::get('titles.adminNewUser')) !!}</li>
                            <li {{ Request::is('themes','themes/create') ? 'class=active' : null }}>{!! HTML::link(url('/themes'), Lang::get('titles.adminThemesList')) !!}</li>
                            <li {{ Request::is('logs') ? 'class=active' : null }}>{!! HTML::link(url('/logs'), Lang::get('titles.adminLogs')) !!}</li>
                            <li {{ Request::is('php') ? 'class=active' : null }}>{!! HTML::link(url('/php'), Lang::get('titles.adminPHP')) !!}</li>
                            <li {{ Request::is('routes') ? 'class=active' : null }}>{!! HTML::link(url('/routes'), Lang::get('titles.adminRoutes')) !!}</li>
                        </ul>
                    </li>
                @endrole
                @php
                  /** check applcation ID 1 ist offline 2 kww und 3 artist in residence **/
                  $appinfo = \App\Models\ApplicationConfig::first();

                @endphp

                @level(3)
                    <li><a href="{{ route('jury.index') }}">{!! trans('titles.jury') !!}</a></li>
                      <li><a href="{{ route('jury.art') }}">Jury Kunst</a></li>
                        <li><a href="{{ route('jury.literature') }}">Jury Literatur</a></li>
                @endlevel



                @level(1)

                   @if ((Auth::user()->activated == true) && (Auth::user()->checkProfile() == true))
                        @if ($appinfo->application_info_id == 2)
                            <li><a href="{{ route('applications') }}">{!! trans('titles.application_kww_nav') !!}</a></li>
                        @endif
                        @if ($appinfo->application_info_id == 3)
                            <li><a href="{{ route('applications') }}">{!! trans('titles.application_start') !!} <i class="fa fa-picture-o" aria-hidden="true"></i> </a></li>
                          @endif
                    @endif
                  @endlevel

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{ Config::get('languages')[App::getLocale()]['name'] }}
                        <img src="/flags/{{ Config::get('languages')[App::getLocale()]['flag'] }}">
                          </a>
                          <ul class="dropdown-menu">
                            @foreach (Config::get('languages') as $lang => $language)
                              @if ($lang != App::getLocale())
                                <li>
                                  <a href="{{ route('lang.switch', $lang) }}">{{$language['name']}} <img src=" {{asset('/flags/'.$language['flag']) }} "></a>
                                </li>
                              @endif
                            @endforeach
                          </ul>
                        </li>

            </ul>

            {{-- Right Side Of Navbar --}}
            <ul class="nav navbar-nav navbar-right">
                {{-- Authentication Links --}}
                <li><a href="{{ route('faq') }}">FAQ</a></li>

                @if (Auth::guest())
                    <li><a href="{{ route('privacy') }}">{!! trans('titles.privacy') !!}</a></li>
                  <li><a href="{{ route('login') }}">{!! trans('titles.login') !!}</a></li>
                    <li><a href="{{ route('register') }}">{!! trans('titles.register') !!}</a></li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">

                            @if ((Auth::User()->profile) && Auth::user()->profile->avatar_status == 1)
                                <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}" class="user-avatar-nav">
                            @else
                                <div class="user-avatar-nav"></div>
                            @endif

                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li {{ Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'class=active' : null }}>
                                {!! HTML::link(url('/profile/'.Auth::user()->name), trans('titles.profile')) !!}
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {!! trans('titles.logout') !!}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
