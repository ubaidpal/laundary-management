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

    
        <h2>How it work for {{ $type }}</h2>
        <form class="form-material" action="{{ route('how_it_work.create') }}" method="post">
    
            {!! csrf_field() !!} 
            
           
            <input type="hidden" name="plan_type" value="{{ $type }}">
            <div class="form-group">
            <label for="name">Title:</label><br>
            <input type="text" class="form-control" required="" placeholder="Enter title" name="title[]" value="{{ old('title')}}">
            @if($errors->first('title'))
            <span class="text text-danger">* {{ $errors->first('title') }}</span>
            @endif
            </div>
            <div class="form-group">
            <label for="name">Description:</label><br>
            <textarea  class="form-control" required="" placeholder="Enter description" name="description[]">{{ old('description')}}</textarea>
            @if($errors->first('description'))
            <span class="text text-danger">* {{ $errors->first('description') }}</span>
            @endif
            </div> <div class="form-group">
            <label for="name">Title:</label><br>
            <input type="text" class="form-control" required="" placeholder="Enter title" name="title[]" value="{{ old('title')}}">
            @if($errors->first('title'))
            <span class="text text-danger">* {{ $errors->first('title') }}</span>
            @endif
            </div>
            <div class="form-group">
            <label for="name">Description:</label><br>
            <textarea  class="form-control" required="" placeholder="Enter description" name="description[]">{{ old('description')}}</textarea>
            @if($errors->first('description'))
            <span class="text text-danger">* {{ $errors->first('description') }}</span>
            @endif
            </div> <div class="form-group">
            <label for="name">Title:</label><br>
            <input type="text" class="form-control" required="" placeholder="Enter title" name="title[]" value="{{ old('title')}}">
            @if($errors->first('title'))
            <span class="text text-danger">* {{ $errors->first('title') }}</span>
            @endif
            </div>
            <div class="form-group">
            <label for="name">Description:</label><br>
            <textarea  class="form-control" required="" placeholder="Enter description" name="description[]">{{ old('description')}}</textarea>
            @if($errors->first('description'))
            <span class="text text-danger">* {{ $errors->first('description') }}</span>
            @endif
            </div> 
            <button type="submit" class="btn btn-default">Submit</button>
            <a href="{{ route('how_it_work') }}" class="btn btn-default">Cancel</a>
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
        //$('textarea').ckeditor();

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
