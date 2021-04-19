@extends('layouts.app')
@section('content')

<div class="container-fuild">

    <div class="card">
    <div class="card-body">

  <h2>My Profile</h2>
  <form class="form-material" method="post" action="{{route('profile.update')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="name">Image:</label><br>
      @if(isset($data->profile_image))
        <img id="blah" src="{{$data->profile_image}}" alt="your image" width="150" height="150">
      @else
        <img id="blah" src="{{asset('images/preview-icon.png')}}" alt="your image" width="150" height="150">
      @endif
      <br><br>
      <input type="file" class="form-control w-45" id="imgInp" name="upload_image">
      @if($errors->first('profile_image'))
      <span class="text text-danger">* {{ $errors->first('profile_image') }}</span>
      @endif
    </div>


    <div class="form-group ">
      <label for="name">Name:</label>
    <input type="text" class="form-control" id="first_name" placeholder="Enter name" name="first_name" value="{{ $data->first_name }}">
    </div>

    <div class="form-group ">
      <label for="name">Contact:</label>
    <input type="text" class="form-control" id="contact" placeholder="Enter contact" name="contact" value="{{ $data->contact }}">
    </div>

    <div class="form-group ">
      <label for="email">Email:</label>
    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ $data->email }}">
    </div>


    <button type="submit" class="btn btn-default">Submit</button>
  </form>

</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});

</script>

@endsection
