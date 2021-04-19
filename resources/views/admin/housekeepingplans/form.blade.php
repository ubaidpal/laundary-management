
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
    <h2>Edit HouseKeeping Plan</h2>
    @else
    <h2>New HouseKeeping Plan</h2>
    @endif
  @if(isset($data->id))
<form class="form-material" action="{{ route('housekeepingplans.update',$data->id) }}" method="post" enctype="multipart/form-data">
    @else
   <form class="form-material" action="{{ route('housekeepingplans.create') }}" method="post">
    @endif
    {!! csrf_field() !!}


    <div class="form-group">
      <label for="name">Plan Description:</label><br>
        <textarea class="form-control" name="description">@if(isset($data->description)){{ $data->description }}@endif</textarea>
    @if($errors->first('description'))
    <span class="text text-danger">* {{ $errors->first('description') }}</span>
    @endif
    </div>


    <div class="form-group">
      <label for="name">Bedroom Cleaning Allowed:</label>
      <input type="text"  onkeypress="return isNumber()" step="0.01" min="0" class="form-control" id="bedroom" placeholder="Enter bedroom" name="bedroom" value="@if(isset($data->bedroom)){{ $data->bedroom }}@endif">
    @if($errors->first('bedroom'))
    <span class="text text-danger">* {{ $errors->first('bedroom') }}</span>
    @endif
    </div>

    <div class="form-group">
      <label for="name">Frequency:</label>
      <input type="text"  class="form-control" id="frequency" placeholder="Enter frequency" name="frequency" value="@if(isset($data->frequency)){{ $data->frequency }}@endif">
    @if($errors->first('frequency'))
    <span class="text text-danger">* {{ $errors->first('frequency') }}</span>
    @endif
    </div>

    <div class="form-group">
      <label for="name">Price per Cleaning:</label>
      <input type="number" step="0.01" class="form-control" id="price" placeholder="Enter price" name="price" value="@if(isset($data->price)){{ $data->price }}@endif">
    @if($errors->first('price'))
    <span class="text text-danger">* {{ $errors->first('price') }}</span>
    @endif
    </div>

<input type="submit" class="btn btn-primary" value="submit">

<a href="{{ route('housekeepingplans.index') }}" class="btn btn-default" >Cancel</a>

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
