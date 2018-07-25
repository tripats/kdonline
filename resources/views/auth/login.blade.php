@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                  <p class="text-center margin-bottom-2">
                    @if ( App::getLocale() == 'en')
                      @include('langpartials.new_password_en')
                    @elseif ( App::getLocale() == 'de' )
                      @include('langpartials.new_password_de')
                    @endif
                  </p>
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{!! trans('usersmanagement.labelEmail') !!} </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{!! trans('usersmanagement.password') !!}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {!! trans('usersmanagement.remember') !!}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group margin-bottom-3">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {!! trans('usersmanagement.login') !!}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {!! trans('usersmanagement.forgot-password') !!}
                                </a>
                            </div>
                        </div>

                        <p class="text-center margin-bottom-2">
                          @if ( App::getLocale() == 'en')
                            @include('langpartials.register_social_en')
                          @elseif ( App::getLocale() == 'de' )
                            @include('langpartials.register_social_de')
                          @endif
                        </p>


                        @include('partials.socials-icons')

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
