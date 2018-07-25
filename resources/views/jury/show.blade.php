@extends('layouts.app')

@section('template_title')
    Bewerbung anschauen
@endsection
<link rel="stylesheet" href="/css/light-modal.min.css">
@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">

        <div class="row" style="height:20px"></div>
        <div class="row">
          <div class="col-sm-8">

            <h3>                      Bewerbung von {!! $application->user->first_name !!} {!! $application->user->last_name !!}</h3>

            <!--begin tabs going in wide content -->
             <ul class="nav nav-tabs content-tabs" id="maincontent" role="tablist">
                <li class="active"><a href="#home" role="tab" data-toggle="tab">Dateien</a></li>
                <li><a href="#project" role="tab" data-toggle="tab">Projektbeschreibung</a></li>
                <li><a href="#profile" role="tab" data-toggle="tab">Profil / Vita</a></li>

             </ul><!--/.nav-tabs.content-tabs -->


             <div class="tab-content">

                <div class="tab-pane fade in active" id="home">
                                         <h3>Bilder</h3>
                  @foreach ($application->media  as $medium)
                    @if ($medium['type']==1)
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

                           </div>

                      </div>
                    @endif
                    @endforeach

                    <h3>Videos</h3>
                    @foreach ($application->media  as $medium)
                      @if ($medium['type']==2)
                          <div class="col-sm-12">

                              <div class="col-md-8">

                                        <video width="720" height="480" controls>
                                              <source src="{{ asset('storage/media/video/'.$medium->file_name) }}" type="video/mp4">

                                            Your browser does not support the video tag.
                                        </video>
                                        <div id="demoLightbox{{ $medium->id }}" class="lightbox fade"  tabindex="-1" role="dialog" aria-hidden="true">
                                          <div class='lightbox-dialog'>
                                              <div class='lightbox-content'>
                                                  <img src="{{ asset('storage/media/images_large/'.$medium->file_name) }}">
                                                  <div class='lightbox-caption'>
                                                      {{ $medium->file_name}}
                                                  </div>
                                              </div>
                                          </div>
                                        </div>


                                           </div>

                                      </div>
                        @endif
                     @endforeach

                     <h3>Audio Files</h3>
                     @foreach ($application->media  as $medium)
                       @if ($medium['type']==3)
                         <div class="col-sm-12">

                           <div class="col-md-6">
                                   <audio controls>
                                     <source src="{{ asset('storage/media/audio/'.$medium->file_name) }}" type="audio/mpeg">
                                       Your browser does not support the audio element.
                                   </audio>


                           </div>

                           <div class="col-md-6">

                                   <div class="caption">
                                     <h2>{!! $medium->title !!}</h2>

                                     {!! Helper::simple_format_text($medium->description) !!}
                                   </div>


                                      </div>

                                 </div>
                         @endif
                      @endforeach

                      <h3>PDF / Texte Download</h3>
                      @foreach ($application->media  as $medium)
                        @if ($medium['type']==4)
                          <div class="col-sm-12">

                            <div class="col-md-6">

                                @if($application->activity_id == 4)
                                  <a href="{{ asset('storage/media/literature_pdf/'.$medium->file_name) }}">{{ $medium->file_name_org }}</a>
                                @else
                                  <a href="{{ asset('storage/media/pdf/'.$medium->file_name) }}">{{ $medium->file_name_org }}</a>
                                @endif

                              </div>

                            <div class="col-md-6">

                                    <div class="caption">
                                      <h2>{!! $medium->title !!}</h2>

                                      {!! Helper::simple_format_text($medium->description) !!}
                                    </div>


                                       </div>

                                  </div>
                          @endif
                       @endforeach
                </div><!--/.tab-pane -->

                <div class="tab-pane fade" id="project">
                  <dl class="user-info">
                    <dt>Erwartungen:</dt>
                    <dd style="white-space: pre-wrap;">{{ $application->expectations }}</dd>
                    <dt>Projektbeschreibung:</dt>
                    <dd style="white-space: pre-wrap;">{{$application->description}}</dd>
                    <dt>Schwerpunkt:</dt>
                    @if ($application->activity_id == 1)
                      <dd>{!! trans('titles.art') !!}</dd>
                    @elseif ($application->activity_id == 2)
                      <dd>{!! trans('titles.mixedmedia') !!}</dd>
                    @elseif ($application->activity_id == 3)
                      <dd>{!! trans('titles.kww') !!}
                    @elseif ($application->activity_id == 4)
                      <dd>{!! trans('titles.literature') !!}</dd>
                    @elseif ($application->activity_id == 5)
                      <dd>{!! trans('titles.composition') !!}</dd>
                    @endif
                    <dt>Bewerbung für das Jahr:</dt>
                    <dd>{{ $application->application_year }}</dd>
                    <dt>Unterbringung Familie:</dt>
                    @if ($application->family == 0)
                      <dd>Nein</dd>
                    @else
                     <dd>Ja</dd>
                    @endif
                    <dt>Bevorzugter Start:</dt>
                    @if ($application->preferred_start == 1)
                      <dd>Erstes Halbjahr</dd>
                    @else
                     <dd>Zweites Halbjahr</dd>
                    @endif
                    <dt>Webseite / Homepage</dt>
                    <dd>{{ $application->homepage }}</dd>
                    <dt>Gewüschte Aufenthaltsdauer:</dt>
                    <dd>{{ $application->duration }} Monate</dd>
                    <dt>Darf auf internationaler Webseite veröffentlicht werden?</dt>
                    @if ($application->is_international == 1)
                      <dd>Ja</dd>
                    @else
                     <dd>Nein</dd>
                    @endif

                </dl>

                </div><!--/.tab-pane -->

                <div class="tab-pane fade" id="profile">
                  <dl class="user-info">
                    <dt>Name:</dt>
                  <h3>{!! $application->user->first_name !!} {!! $application->user->last_name !!}</h3>
                  <dt>Email:</dt>
                  <dd>{{ $application->user->email}}</dd>
                  <dt>Straße:</dt>
                  <dd>{{ $application->user->profile->street}}</dd>
                  <dt>PLZ:</dt>
                  <dd>{{ $application->user->profile->postcode}}</dd>
                  <dt>Land:</dt>
                  <dd>{{ $application->user->profile->country}}</dd>
                  <dt>Geburtstag:</dt>
                  <dd>{{ $application->user->profile->birthday}}</dd>
                  <dt>Geburtsort:</dt>
                  <dd>{{ $application->user->profile->birthplace}}</dd>
                  <dt>Festnetznummer:</dt>
                  <dd>{{ $application->user->profile->fixed_number}}</dd>
                  <dt>Handynummer:</dt>
                  <dd>{{ $application->user->profile->mobile_number}}</dd>
                  <dt>Homepage:</dt>
                  <dd>{{ $application->user->profile->homepage}}</dd>
                  <dt>Vita / C.V:</dt>
                  <dd style="white-space: pre-wrap;">{{ $application->user->profile->vita}}</dd>
                  <dt>Austellungen</dt>
                  <dd style="white-space: pre-wrap;">{{ $application->user->profile->exhibition}}</dd>
                </dl>
                </div><!--/.tab-pane -->


             </div><!--/.tab-content -->

          </div><!--/.col-sm-8 -->

       </div><!--/.row -->

    </div><!--/.container -->
  </div>

        </div>
    </div>

@endsection
  @include('modals.modal-delete')
@section('footer_scripts')

@endsection
