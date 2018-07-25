@extends('layouts.app')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
@section('template_title')
  Ajax Media Uplaod Test
@endsection

@section('template_fastload_css')
@endsection

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">

            Ajax Media Upload

            <a href="/users" class="btn btn-info btn-xs pull-right">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
              Back <span class="hidden-xs">to</span><span class="hidden-xs"> Users</span>
            </a>

          </div>
          <div class="panel-body">
            <form action="{{ route('catagory_add') }}" enctype="multipart/form-data" method="POST">

             	<div class="alert alert-danger print-error-msg" style="display:none">
                   <ul></ul>
               </div>

               <input type="hidden" name="_token" value="{{ csrf_token() }}">

               <div class="form-group">
                 <label>Alt Title:</label>
                 <input type="text" name="title" class="form-control" placeholder="Add Title">
               </div>

           	<div class="form-group">
                 <label>Image:</label>
                 <input type="file" name="image" class="form-control">
               </div>

               <div class="form-group">
                 <button class="btn btn-success upload-image" type="submit">Upload Image</button>
               </div>

             </form>

           </div>

           <script type="text/javascript">
             $("body").on("click","catagory_add",function(e){
               $(this).parents("form").ajaxForm(options);
             });

             var options = {
               complete: function(response)
               {
               	if($.isEmptyObject(response.responseJSON.error)){
               		$("input[name='title']").val('');
               		alert('Image Upload Successfully.');
               	}else{
               		printErrorMsg(response.responseJSON.error);
               	}
               }
             };

             function printErrorMsg (msg) {
           	$(".print-error-msg").find("ul").html('');
           	$(".print-error-msg").css('display','block');
           	$.each( msg, function( key, value ) {
           		$(".print-error-msg").find("ul").append('<li>'+value+'</li>');
           	});
             }
           </script>
@endsection

@section('footer_scripts')
@endsection
