@extends('layouts.app')

@section('template_title')
    Künstlerdorf Online Bewerbung / Application
@endsection

@section('template_fastload_css')
@endsection

@php
  /** check applcation ID 1 ist offline 2 kww und 3 artist in residence **/
  $appinfo = \App\Models\ApplicationConfig::first();
@endphp


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
  					<div class="panel-heading">
            <h1>{!! trans('titles.welcome') !!}</h1>
          </div>
        </div>

        <div class="col-md-8 panel panel-default">

                @if(App::getLocale() == 'en')
                  @markdown($appinfos->info_en)
                @endif
                @if(App::getLocale() == 'de')
                  @markdown($appinfos->info_de)
                @endif
        </div>

        <div class="col-md-4">

                      @if(App::getLocale() == 'en')
                        <b>Stipends funded by:</b>
                      @endif
                      @if(App::getLocale() == 'de')
                        <b>Stipendiengeber:</b>
                      @endif
                      <div class="row" style="height:10px">
                      </div>


              <div class="col-md-2"><a href="http://www.nrw.de"><img src="{{asset('/images/NRW_MFKJKS_RGB.png')}}"></a></div>
              <div class="clearfix"></div>
                <div class="row" style="height:20px"></div>
              <div class="col-md-2"><a href="http://www.kunststiftung-nrw.de"><img src="{{asset('/images/logo_ks.gif')}}"></a></div>
              <div class="clearfix"></div>
                <div class="row" style="height:20px"></div>
              <div class="col-md-2"><a href="http://www.lvr.de"><img src="{{asset('/images/logo_lvr.gif')}}"></div>
              <div class="clearfix"></div>
                <div class="row" style="height:20px"></div>
              <div class="col-md-2"><a href="http://www.stiftung-kuenstlerdorf.de/"><img src="{{asset('/images/logo_kd.jpg')}}"></div>
              <div class="clearfix"></div>
                <div class="row" style="height:20px"></div>
              <div class="col-md-2"><a href="http://www.nrw.de"><img src="{{asset('/images/NRW_MFKJKS_RGB.png')}}"></a></div>
          </div>
        </div>
        <div class="col-md-12" >
          @if(App::getLocale() == 'en')
            <b>The foundation is held by:</b>
          @endif
          @if(App::getLocale() == 'de')
            <b>Träger der Stiftung sind:</b>
          @endif
        </div>
        
        <div class="col-md-3">
              <a href="http://www.nrw-stiftung.de/"><img src="{{asset('/images/logo_nrwstiftung_neu.gif')}}"></a>
        </div>

        <div class="col-md-3">
          <a href="http://www.nrw.de/"><img src="{{asset('/images/logo_nrw.jpg')}}"></a>
        </div>

        <div class="col-md-3">
          <img src="{{asset('/images/xx_lwl.jpg')}}">
        </div>

        <div class="col-md-3">

        </div>

        <div class="clearfix"></div>

        <div class="col-md-3">
              <a href="http://www.kreis-borken.de/"><img src="{{asset('/images/xx_borken.jpg')}}"></a>
        </div>

        <div class="col-md-3">
          <a href="http://www.schoeppingen.de/"><img src="{{asset('/images/xx_schoepp.jpg')}}"></a>
        </div>

        <div class="col-md-3">
          <a href="http://www.stiftung-kuenstlerdorf.de/foerderverein/"><img src="{{asset('/images/xx_foerder.jpg')}}"></a>
        </div>
        <div class="col-md-3">
        </div>

    </div>
</div>

@endsection

@section('footer_scripts')


@endsection
