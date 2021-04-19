
@extends('layouts.app')

@section('content')
<style>
.w-45{
       width:45%;
}
.w-15{
       width:15%;
}
.ml-15{
    margin-left:15px;
}
</style>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.css" integrity="sha256-G5PTdPgo4SQMURj4T5iUmc8SZE0yEaxMhmAVt/AWxnU=" crossorigin="anonymous" />

<div class="container-fuild ml-15" >
    <div class="card">
    <div class="card-body">

    @if(isset($data->id))
        <h2>Edit CMS Page</h2>
    @else
        <h2>Add CMS Page</h2>
    @endif

    @if(isset($data->id))
        <form class="form-material" action="{{ route('cmspages.update',$data->id) }}" method="post">
    @else
        <form class="form-material" action="{{ route('cmspages.create') }}" method="post">
    @endif
    {!! csrf_field() !!}

    <div class="form-group">
      <label for="name">Url:</label>
      <input type="text" class="form-control " id="url" autocomplete="off"  placeholder="Enter Url" name="url" value=@if(isset($data->url)){{ $data->url }}@else{{ old('url') }}@endif>
    @if($errors->first('url'))
    <span class="text text-danger">* {{ $errors->first('url') }}</span>
    @endif
    </div>

    <div class="form-group">
      <label for="name">Title:</label>
      <input type="text" class="form-control " id="title" autocomplete="off"  placeholder="Enter Title" name="title" value="@if(isset($data->title)){{ $data->title }}@else{{ old('title') }}@endif">
    @if($errors->first('title'))
    <span class="text text-danger">* {{ $errors->first('title') }}</span>
    @endif
    </div>

    <?php
    // $replace = [
    //     '&amp;' => '&', '&quot;' => '"', '&apos;' => "'", '&gt;' => '>', '&lt;' => '<', '&ldquo;' => '“', '&rdquo;' => '”'
    // ];
    ?>

    <div class="form-group">
      <label for="name">Description:</label>
      <textarea class="form-control" id="description" autocomplete="off" placeholder="Enter Description" name="description">@if(isset($data->description)){{$data->description}}@endif</textarea>
    @if($errors->first('description'))
    <span class="text text-danger">* {{ $errors->first('description') }}</span>
    @endif
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
    <a href="{{ route('cmspages.index') }}" class="btn btn-default">Cancel</a>
  </form>
</div>
    </div>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){

          $("#url").keypress(function (e) {

            if($(this).val().length >= 15){
                return false;
            }

            if (e.which == 32 && e.which != 0 ) {
                alert('No Space Allowed');
                return false;
            }
        });



        })
        </script>


<script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script src="{{ asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>


    <script>
        $('textarea').ckeditor();

        $(document).ready(function () {



        //called when key is pressed in textbox
       /* $("#url").keypress(function (e) {
            alert('asdsa');
            if (e.which == 32 && e.which != 0 ) {
                alert('space');
            }
        }); */
        });

    </script>

@endsection
