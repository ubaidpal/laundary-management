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
        <h2>Edit Building</h2>
    @else
        <h2>Add Building</h2>
    @endif

    @if(isset($data->id))
        <form class="form-material" action="{{ route('buildings.update',$data->id) }}" method="post">
    @else
        <form class="form-material" action="{{ route('buildings.create') }}" method="post">
    @endif
    {!! csrf_field() !!}

    <div class="form-group">
      <label for="name"> School Name: </label>
      <select name="school_id" class="form-control">
        @foreach ($schools as $school)
            <option value="{{ $school->id }}" @if(isset($data->school_id) && $data->school_id == $school->id) selected @endif > {{ $school->school_name }} </option>
        @endforeach
      </select>
    @if($errors->first('school_id'))
    <span class="text text-danger">* {{ $errors->first('school_id') }}</span>
    @endif
    </div>

    <div class="form-group">
      <label for="name"> Building: </label>
      <input type="text" class="form-control " id="building" autocomplete="off"  placeholder="Enter building" name="building" value="@if(isset($data->building)){{ $data->building }}@else{{ old('building') }}@endif">
    @if($errors->first('building'))
    <span class="text text-danger">* {{ $errors->first('building') }}</span>
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
