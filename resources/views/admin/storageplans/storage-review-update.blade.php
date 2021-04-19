
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
  <div class="container-fuild ml-15">
    <div class="card">
    <div class="card-body">
  @if(isset($data->id))
    <h2>Edit Message</h2>
    @else
    <h2>New Message</h2>
    @endif
   <form class="form-material" action="{{ route('storage.review.update') }}" method="post">
   
    {!! csrf_field() !!}


    <div class="form-group">
      <label for="name">Message:</label><br>
        <textarea class="form-control" name="message">@if(isset($data->message)){{ $data->message }}@endif</textarea>
    @if($errors->first('message'))
    <span class="text text-danger">* {{ $errors->first('message') }}</span>
     @endif
    </div>


    

<input type="submit" class="btn btn-primary" value="submit">



</form>
</div>
    </div>
  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57) ) {
        if(charCode == 110){
            return true;
        }else{
            return false;
        }
        // return false;
    }
    if(document.getElementById('weight').value.length >= 4){
        return false
    }
    return true;
}

</script>

@endsection
