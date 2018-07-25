@extends('layouts.app')

@section('template_title')
    FAQ
@endsection

@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

        @include('langpartials.faq')

            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
@endsection
