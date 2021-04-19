{{-- {{dd($errors->all())}} --}}
@extends('layouts.app')

@section('content')
<style>
.w-45{
       width:75%;
}
.w-15{
       width:15%;
}
.ml-15{
    margin-left:15px;
}
.h100{
    height: 100px;
}
</style>
<div class="container-fuild">
  <div class="card">
    <div class="card-body">
  <h2>Edit User</h2>
<hr>
@if(\Auth::user()->type == 'ADMIN')
<form class="form-material" action="{{ route('users.update',$data->id) }}" enctype="multipart/form-data"  method="post">
    @else
<form class="form-material" action="{{ route('staff.users.update',$data->id) }}" enctype="multipart/form-data"  method="post">
    @endif
    {!! csrf_field() !!}

    <div class="form-group">
      <label for="name">Profile Image:</label><br>
      @if(!empty($data->profile_image))
        <img id="blah" src="{{asset('images/users').'/'.$data->profile_image}}" alt="your image" width="100" >
      @else
        <img id="blah" src="{{asset('images/preview-icon.png')}}" alt="your image" width="100">
      @endif
      <br><br>
      <input type="file" class="form-control w-45" id="imgInp" name="upload_image">
      @if($errors->first('image'))
      <span class="text text-danger">* {{ $errors->first('image') }}</span>
      @endif
    </div>
    <div class="row">
        
        <div class="form-group col-md-6">
          <label for="name">First Name:</label>
          <input type="text" class="form-control " id="first_name" placeholder="Enter name" name="first_name" value="{{ $data->first_name }}">
        @if($errors->first('first_name'))
        <span class="text text-danger">* {{ $errors->first('first_name') }}</span>
        @endif
        </div>

        <div class="form-group col-md-6">
          <label for="name">Last Name:</label>
          <input type="text" class="form-control " id="last_name" placeholder="Enter last name" name="last_name" value="{{ $data->last_name }}">
        @if($errors->first('last_name'))
        <span class="text text-danger">* {{ $errors->first('last_name') }}</span>
        @endif
        </div>
    </div>

    <div class="form-group">
      <label for="name">Contact:</label>
      <input type="text" class="form-control " id="contact"    placeholder="Enter Contact" name="contact" value="{{ $data->contact }}" onkeypress="return isNumber(event)">
    @if($errors->first('contact'))
    <span class="text text-danger">* {{ $errors->first('contact') }}</span>
    @endif
    </div>


    <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control " id="email" placeholder="Enter email" name="email" value="{{ $data->email }}" readonly >
    @if($errors->first('email'))
    <span class="text text-danger">* {{ $errors->first('email') }}</span>
    @endif
    </div>

    <div class="form-group">
    <label for="email">Username:</label>
    <input type="text" class="form-control " id="username" placeholder="Enter username" name="username" value="{{ $data->username }}" >
    @if($errors->first('username'))
    <span class="text text-danger">* {{ $errors->first('username') }}</span>
    @endif
    </div>

    <div class="form-group">
    <label for="email">Date of Birth:</label>
    <input type="text" class="form-control mydatepicker" id="dob" placeholder="Enter Date of birth" name="dob" value="{{ $data->dob }}"  >
    @if($errors->first('dob'))
    <span class="text text-danger">* {{ $errors->first('dob') }}</span>
    @endif
    </div>

    <div class="form-group">
    <label for="email">School Name:</label>
    <input type="text" class="form-control " id="school_name" placeholder="Enter school name" name="school_name" value="{{ $data->school_name }}" >
    @if($errors->first('school_name'))
    <span class="text text-danger">* {{ $errors->first('school_name') }}</span>
    @endif
    </div>

    <div class="form-group">
    <label for="email">Do you live in campus:</label>
    <br>
    <select name="in_campus" id="campus" class="form-control" style="width: 30%">
        <option value="0" @if($data->in_campus == '0'){{'selected'}}@endif>No</option>
        <option value="1" @if($data->in_campus == '1'){{'selected'}}@endif>Yes</option>
    </select>
    @if($errors->first('in_campus'))
    <span class="text text-danger">* {{ $errors->first('in_campus') }}</span>
    @endif
    </div>

    <div id="in_campus" @if($data->in_campus == 1) style="display:block" @else style="display:none" @endif>
        <div class="form-group">
        <label for="email">Hall name:</label>
        <input type="text" class="form-control " id="hall" placeholder="Enter hall name" name="hall" value={{ $data->hall }} >
        @if($errors->first('hall'))
        <span class="text text-danger">* {{ $errors->first('hall') }}</span>
        @endif
        </div>

        <div class="form-group">
        <label for="email">Room number:</label>
        <input type="text" class="form-control " id="room_number" placeholder="Enter room number" name="room_number" value={{ $data->room_number }} >
        @if($errors->first('room_number'))
        <span class="text text-danger">* {{ $errors->first('room_number') }}</span>
        @endif
        </div>

    </div>


    <div id="not_in_campus" @if($data->in_campus == 0) style="display:block" @else style="display:none" @endif>

        <div class="form-group">
        <label for="email">Address:</label>
        <input type="text" class="form-control " id="address" placeholder="Enter address" name="address" value={{ $data->address }} >
        @if($errors->first('address'))
        <span class="text text-danger">* {{ $errors->first('address') }}</span>
        @endif
        </div>

        <div class="form-group">
        <label for="email">City:</label>
        <input type="text" class="form-control " id="city" placeholder="Enter city" name="city" value={{ $data->city }} >
        @if($errors->first('city'))
        <span class="text text-danger">* {{ $errors->first('city') }}</span>
        @endif
        </div>

        <div class="form-group">
        <label for="email">Zipcode:</label>
        <input type="text" class="form-control " id="zipcode" placeholder="Enter zipcode" name="zipcode" value={{ $data->zipcode }} >
        @if($errors->first('zipcode'))
        <span class="text text-danger">* {{ $errors->first('zipcode') }}</span>
        @endif
        </div>

        <div class="form-group">
        <label for="email">Country:</label>
        <input type="text" class="form-control " id="country" placeholder="Enter country" name="country" value={{ $data->country }} >
        @if($errors->first('country'))
        <span class="text text-danger">* {{ $errors->first('country') }}</span>
        @endif
        </div>

        <div class="form-group">
        <label for="email">Doorcode:</label>
        <input type="text" class="form-control " id="doorcode" placeholder="Enter doorcode" name="doorcode" value="{{ $data->doorcode }}" >
        @if($errors->first('doorcode'))
        <span class="text text-danger">* {{ $errors->first('doorcode') }}</span>
        @endif
        </div>

    </div>

 <div class="form-group">
        <label for="email">Parent Name:</label>
        <input type="text" class="form-control " id="pname" placeholder="Enter name" name="pname" value="{{ $data->pname }}">
        @if($errors->first('pname'))
        <span class="text text-danger">* {{ $errors->first('pname') }}</span>
        @endif
    </div>

        <div class="form-group">
        <label for="email">Parent Email:</label>
        <input type="text" class="form-control " id="pemail" placeholder="Enter email" name="pemail" value="{{ $data->pemail }}">
        @if($errors->first('pemail'))
        <span class="text text-danger">* {{ $errors->first('pemail') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="email">Parent Phone:</label>
        <input type="text" class="form-control " id="pcontact" placeholder="Enter contact" name="pcontact" value="{{ $data->pcontact }}">
        @if($errors->first('pcontact'))
        <span class="text text-danger">* {{ $errors->first('pcontact') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="email">Credit Card Type:</label>
        <select name="card_type" class="form-control">
        <option value="Visa" @if($data->card_type == 'Visa'){{ 'selected' }}@endif>Visa</option>
            <option value="Master" @if($data->card_type == 'Master'){{ 'selected' }}@endif>Mastercard</option>
            <option value="American express" @if($data->card_type == 'American express'){{ 'selected' }}@endif>Americal Express</option>
        </select>
        @if($errors->first('card_type'))
        <span class="text text-danger">* {{ $errors->first('card_type') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="email">Credit Card Number:</label>
        <input type="text" class="form-control " id="card_number" placeholder="Enter card number" name="card_number" value="{{ $data->card_number }}">
        @if($errors->first('card_number'))
        <span class="text text-danger">* {{ $errors->first('card_number') }}</span>
        @endif
    </div>

    <div>

    <div class="form-group">
        <label for="email">Month:</label>
        <input type="text" class="form-control " id="card_month" placeholder="Enter expiry month" name="card_month" value="{{ $data->card_month }}">
        @if($errors->first('card_month'))
        <span class="text text-danger">* {{ $errors->first('card_month') }}</span>
        @endif
    </div>

        <div class="form-group">
        <label for="email">Year:</label>
        <input type="text" class="form-control " id="card_year" placeholder="Enter card expiry year" name="card_year" value="{{ $data->card_year }}">
        @if($errors->first('card_year'))
        <span class="text text-danger">* {{ $errors->first('card_year') }}</span>
        @endif
    </div>


    <div class="form-group">
        <label for="email">CVV:</label>
        <input type="text" class="form-control " id="card_cvv" placeholder="Enter card cvv" name="card_cvv" value="{{ $data->card_cvv }}">
        @if($errors->first('card_cvv'))
        <span class="text text-danger">* {{ $errors->first('card_cvv') }}</span>
        @endif
    </div>


    </div>

    <div class="form-group">
        <label for="email">Gratuity:</label>
    <input type="number" min=0 max=10 class="form-control " id="gratuity" placeholder="Enter gratuity" name="gratuity" value="{{ $data->gratuity }}">
        @if($errors->first('gratuity'))
        <span class="text text-danger">* {{ $errors->first('gratuity') }}</span>
        @endif
    </div>

    <div class="clearfix"></div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
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

$('#campus').change(function(){
    if( $(this).val() == 0 ){
        $('#not_in_campus').css('display','block');
        $('#in_campus').css('display','none');
    }else{
        $('#in_campus').css('display','block');
        $('#not_in_campus').css('display','none');

    }
})


</script>


<script>

    $('.mydatepicker').datepicker({format: 'MM/DD/YYYY'});

    function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57) ) {
        return false;
    }
    if(document.getElementById('contact').value.length >= 17){
        return false;
    }
    return true;

}

</script>


@endsection
