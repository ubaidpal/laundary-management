
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
    <h2>Edit Laundry Plan</h2>
    @else
    <h2>New Laundry Plan</h2>
    @endif
  @if(isset($data->id))
<form class="form-material" action="{{ route('laundryplans.update',$data->id) }}" method="post" enctype="multipart/form-data">
    @else
   <form class="form-material" action="{{ route('laundryplans.create') }}" method="post">
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
      <label for="name">Weight Allowed per Week:</label>
      <input type="text"  onkeypress="return isNumber()" step="0.01" min="0" class="form-control" id="weight" placeholder="Enter weight" name="weight" value="@if(isset($data->weight)){{ $data->weight }}@endif">
    @if($errors->first('weight'))
    <span class="text text-danger">* {{ $errors->first('weight') }}</span>
    @endif
    </div>

    <div class="form-group">
      <label for="name">Price per Month:</label>
      <input type="number" step="0.01" class="form-control" id="price" placeholder="Enter price" name="price" value="@if(isset($data->price)){{ $data->price }}@endif">
    @if($errors->first('price'))
    <span class="text text-danger">* {{ $errors->first('price') }}</span>
    @endif
    </div>

<input type="submit" class="btn btn-primary" value="submit">

<a href="{{ route('laundryplans.index') }}" class="btn btn-default" >Cancel</a>

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
