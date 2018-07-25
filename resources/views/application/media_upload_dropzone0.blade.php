@extends('layouts.app')

@section('template_title')
    Create a new application / eine neue Bewerbung erstellen
@endsection

@section('template_fastload_css')
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.css" rel="stylesheet">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.js"></script>
  {!! HTML::script('https://code.jquery.com/jquery-2.1.4.min.js') !!}

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Upload Multiple Images using dropzone.js and Laravel</h1>
            <h2>Images <span id="photoCounter"></span></h2>
            {!! Form::model($application, ['route' => ['mediastore', $application->id], 'method' => 'PUT', 'files' => true, 'enctype' => 'multipart/form-data', 'class' => 'dropzone', 'id' => 'image-upload']) !!}
            <div>
                <h3>Upload Multiple Image By Click On Box</h3>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<script type="text/javascript">
        //Dropzone.autoDiscover = false;
      
        Dropzone.options.imageUpload = {
            maxFilesize         :       10,
            maxFiles            :       20,
            addRemoveLinks: true,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            removedfile: function(file) {
              $.ajax({
             type: 'POST',
             url: '/upload/delete',
             data: {id: file.name, _token: $('_token').val()},
             dataType: 'html',
             success: function(data){
                 var rep = JSON.parse(data);
                 if(rep.code == 200)
                 {
                     photo_counter--;
                     $("#photoCounter").text( "(" + photo_counter + ")");
                 }

             }
           })

        }
      };

</script>

@endsection

@section('footer_scripts')

@endsection
