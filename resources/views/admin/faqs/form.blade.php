
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

<div class="container-fuild">
    <div class="card">
    <div class="card-body">

    @if(isset($data->id))
        <h2>Edit Question</h2>
    @else
        <h2>Add Question</h2>
    @endif

    @if(isset($data->id))
        <form class="form-material" action="{{ route('faqs.update',$data->id) }}" method="post">
    @else
        <form class="form-material" action="{{ route('faqs.create') }}" method="post">
    @endif
    {!! csrf_field() !!}


    <div class="form-group">
      <label for="name">Service:</label><br>
        <select class="form-control" name="service" style="width:25%">
            <option value="" disabled selected>Please select service</option>
            <option value="Laundry" @if(isset($data->service) && $data->service == 'Laundry'){{ 'selected' }}@endif >Laundry</option>
            <option value="Housekeeping" @if(isset($data->service) && $data->service == 'Housekeeping'){{ 'selected' }}@endif>Housekeeping</option>
            <option value="Storage" @if(isset($data->service) && $data->service == 'Storage'){{ 'selected' }}@endif>Storage</option>
        </select>
<br>
    @if($errors->first('service'))
    <span class="text text-danger">* {{ $errors->first('service') }}</span>
    @endif
    </div>

    <div class="form-group">
      <label for="name">Question:</label>
      <input type="text" class="form-control " id="question" autocomplete="off"  placeholder="Enter question" name="question" value="@if(isset($data->question)){{ $data->question }}@else{{ old('question') }}@endif">
    @if($errors->first('question'))
    <span class="text text-danger">* {{ $errors->first('question') }}</span>
    @endif
    </div>

    <?php
    // $replace = [
    //     '&amp;' => '&', '&quot;' => '"', '&apos;' => "'", '&gt;' => '>', '&lt;' => '<', '&ldquo;' => '“', '&rdquo;' => '”'
    // ];
    ?>

    <div class="form-group">
      <label for="name">Description:</label>
      <textarea class="form-control " id="answer" autocomplete="off" placeholder="Enter answer" name="answer">@if(isset($data->answer)){{$data->answer}}@endif</textarea>
    @if($errors->first('answer'))
    <span class="text text-danger">* {{ $errors->first('answer') }}</span>
    @endif
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
    <a href="{{ route('faqs.index') }}" class="btn btn-default">Cancel</a>
  </form>
</div>
    </div>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){

          $("#url").keypress(function (e) {

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
