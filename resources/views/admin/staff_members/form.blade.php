
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
      @if(isset($data->id))
      <h2>Edit Staff Member</h2>
      @else
      <h2>New Staff Member</h2>
      @endif
<hr>

@if (isset($data->id))
    <form class="form-material" action="{{ route('staff_members.update',$data->id) }}" enctype="multipart/form-data"  method="post">
@else
    <form class="form-material" action="{{ route('staff_members.create') }}" enctype="multipart/form-data"  method="post">
@endif


  {!! csrf_field() !!}


    <div class="row">  
      <div class="form-group col-md-6">
        <label for="name">Profile Image:</label><br>
        @if(isset($data->image) || !empty($data->profile_image))
          <img id="blah" src="{{asset('images/staff_members').'/'.$data->profile_image}}" alt="your image" width="100" >
        @else
          <img id="blah" src="{{asset('images/preview-icon.png')}}" alt="your image" width="100">
        @endif
        <br><br>
        <input type="file" class="form-control" id="imgInp" name="upload_image">
        @if($errors->first('upload_image'))
        <span class="text text-danger">* {{ $errors->first('upload_image') }}</span>
        @endif
      </div>
    </div>
    <div class="row">  
        <div class="form-group col-md-6"> 
        <label for="name"> Name:</label>
      <input type="text" class="form-control " id="name" placeholder="Enter name" name="name" value="@if(isset($data->name)){{ $data->name }}@else{{ old('name') }}@endif">
      @if($errors->first('name'))
      <span class="text text-danger">* {{ $errors->first('name') }}</span>
      @endif
      </div>

      <div class="form-group col-md-6">
        <label for="name">Email:</label>
        @if(isset($data->id))
          <input type="text" class="form-control " disabled id="email" placeholder="Enter email" name="email" value="@if(isset($data->email)){{ $data->email }}@else{{ old('email') }}@endif">

        @else
          <input type="text" class="form-control " id="email" placeholder="Enter email" name="email" value="@if(isset($data->email)){{ $data->email }}@else{{ old('email') }}@endif">

        @endif
      @if($errors->first('email'))
      <span class="text text-danger">* {{ $errors->first('email') }}</span>
      @endif
      </div>
    </div>

    <div class="row">  
        <div class="form-group col-md-6"> 
        <label for="name">Password:</label>
        <input type="password" class="form-control " id="password" placeholder="Enter password" name="password" value="@if(isset($data->password)){{ $data->password }}@else{{ old('password') }}@endif">
        @if($errors->first('password'))
        <span class="text text-danger">* {{ $errors->first('password') }}</span>
        @endif
        </div>

       <div class="form-group col-md-6">
          <label for="name">Contact:</label>
        <input type="text" class="form-control" onkeypress="return isNumber()" id="contact" placeholder="Enter contact" name="contact" value="@if(isset($data->contact)){{ $data->contact }}@else{{ old('contact') }}@endif">
        @if($errors->first('contact'))
        <span class="text text-danger">* {{ $errors->first('contact') }}</span>
        @endif
        </div>
    </div>

    <div class="row">  
       <!--  <div class="form-group col-md-6"> 
        <label for="name">Address:</label>
      <input type="text" class="form-control " autocomplete="on" id="autocomplete" placeholder="Enter address" name="address" value="@if(isset($data->address)){{ $data->address }}@else{{ old('address') }}@endif">
      @if($errors->first('address'))
      <span class="text text-danger">* {{ $errors->first('address') }}</span>
      @endif
      </div> -->
       
    <input type="hidden" class="form-control " autocomplete="on" id="latitude" readonly name="latitude" value="@if(isset($data->latitude)){{ $data->latitude }}@else{{ old('latitude') }}@endif">

    <input type="hidden" class="form-control " autocomplete="on" id="longitude" readonly name="longitude" value="@if(isset($data->longitude)){{ $data->longitude }}@else{{ old('longitude') }}@endif">

  
       
  </div>
     <div class="row">  
        <div class="form-group col-md-6"> 
      <label for="name">Role Assignment:</label>
        <select class="form-control" name="role_assignment">
            <option value="Laundry"> Laundry </option>
            <option value="Housekeeping"> Housekeeping </option>
            <option value="Storage"> Storage </option>
            <option value="Laundry"> Genral Manager </option>
            <option value="Housekeeping"> Supervisior </option>
            <option value="Storage"> Vendor </option>
        </select>
    @if($errors->first('role_assignment'))
    <span class="text text-danger">* {{ $errors->first('role_assignment') }}</span>
    @endif
    </div>
     <div class="form-group col-md-6"> 
      <label for="name">School Assignment:</label>
    <input type="text" class="form-control " autocomplete="on" id="school_assignment" name="school_assignment" value="@if(isset($data->school_assignment)){{ $data->school_assignment }}@else{{ old('school_assignment') }}@endif">
    @if($errors->first('school_assignment'))
    <span class="text text-danger">* {{ $errors->first('school_assignment') }}</span>
    @endif
    </div>

    </div>



    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('staff_members.index') }}" class="btn btn-default">Cancel</a>
  </form>
</div>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link href="{{asset('assets/plugins/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/clockpicker/dist/jquery-clockpicker.min.css')}}" rel="stylesheet">


    <script src="{{asset('assets/plugins/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/bootstrap-select/bootstrap-select.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/multiselect/js/jquery.multi-select.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
<script src="{{asset('assets/plugins/clockpicker/dist/jquery-clockpicker.min.js')}}"></script>
<script src="{{asset('assets/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-asColorPicker-master/libs/jquery-asColor.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js')}}"></script>
    <!-- Date Picker Plugin JavaScript -->


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAeE84dgZLx40n1DwZUS6Cggul9dARQhtk&libraries=places"></script><script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAeE84dgZLx40n1DwZUS6Cggul9dARQhtk&libraries=places"></script>

<script>
      var geocoder = new google.maps.Geocoder();
      var input = document.getElementById('autocomplete');
      var autocomplete = new google.maps.places.Autocomplete(input);
      var address = document.getElementById('autocomplete').value;

      google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng();
            //alert("This function is working!");
            //alert(place.name);
           // alert(place.address_components[0].long_name);

        });

</script>

<script>

  var type = $(this). children("option:selected"). val();
  if(type == '1'){
    $('#commission_percentage').css('display','none');
    $('#commission_flat').css('display','block');
  }else{
    $('#commission_percentage').css('display','block');
    $('#commission_flat').css('display','none');
  }

$('#type').change(function(){
    var type = $(this). children("option:selected"). val();
    if(type == '1'){
      $('#commission_percentage').css('display','none');
      $('#commission_flat').css('display','block');
    }else{
      $('#commission_percentage').css('display','block');
      $('#commission_flat').css('display','none');
    }
  });

$('.clockpicker').clockpicker({
        donetext: 'Done',
    }).find('input').change(function() {
        console.log(this.value);
    });

  $(".select2").select2();
        $('.selectpicker').selectpicker();

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


<script>
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
