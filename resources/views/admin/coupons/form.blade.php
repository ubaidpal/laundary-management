
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
    <h2>Edit Coupon</h2>
    @else
    <h2>New Coupon</h2>
    @endif
  @if(isset($data->id))
<form class="form-material" action="{{ route('coupons.update',$data->id) }}" method="post" enctype="multipart/form-data">
    @else
   <form class="form-material" action="{{ route('coupons.create') }}" method="post">
    @endif
    {!! csrf_field() !!}

     <div class="form-group">
      <label for="name">Service:</label><br>
        <select class="form-control" required="" name="service">
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
      <label for="name">Code:</label><br>
        <textarea class="form-control" required="" name="code" placeholder="Enter code">@if(isset($data->code)){{ $data->code }}@else{{ old('code') }}@endif</textarea>
    @if($errors->first('code'))
    <span class="text text-danger">* {{ $errors->first('code') }}</span>
    @endif
    </div>

    <div class="form-group">
      <label for="name">Coupon type:</label><br>
      <select id="coupon_type" required="" name="coupon_type" class="form-control">
        <option value="">--Select--</option>
        <option value="1" @if(isset($data->coupon_type) && $data->coupon_type == '1'){{ "selected"}}@endif>Discount (In %)</option>
        <option value="2" @if(isset($data->coupon_type) && $data->coupon_type == '2'){{ "selected" }}@endif>Discount (In $)</option>
      </select>
      @if($errors->first('coupon_type'))
    <span class="text text-danger">* {{ $errors->first('coupon_type') }}</span>
    @endif
    </div>

    <div class="form-group" id="discount_per">
      <label for="name">Discount(In %):</label><br>
        <input type="number" class="form-control" name="discount_per" id="discount_pers" placeholder="Enter discount" value="@if(isset($data->discount)){{ $data->discount }}@else{{ old('discount')}}@endif"> 
    </div>

    <div class="form-group" id="discount_doller">
      <label for="name">Discount(In $):</label><br>
        <input type="number" class="form-control" name="discount_doller" id="discount_dollers" placeholder="Enter discount" value="@if(isset($data->discount)){{ $data->discount }}@else{{ old('discount')}}@endif"> 
    </div>

    <div class="form-group">
      <label for="name">Plan Description:</label><br>
        <textarea class="form-control" name="description" required="" placeholder="Enter plan description">@if(isset($data->description)){{ $data->description }}@else{{old('description')}}@endif</textarea>
    @if($errors->first('description'))
    <span class="text text-danger">* {{ $errors->first('description') }}</span>
    @endif
    </div>

    <div class="form-group">
      <label for="name">Minimum amount:</label>
      <input type="text"  class="form-control" required="" onkeypress="return isNumber()" id="total" placeholder="Enter total amount" name="total" value="@if(isset($data->total)){{ $data->total }}@else{{ old('total')}}@endif">
    @if($errors->first('total'))
    <span class="text text-danger">* {{ $errors->first('total') }}</span>
    @endif
    </div>

    <div class="form-group">
      <label for="name">Expiry Date:</label>
      <input type="text"  class="form-control mydatepicker" required="" id="expiry_date" placeholder="Enter expiry date" name="expiry_date" value="@if(isset($data->expiry_date)){{ $data->expiry_date }}@else{{ old('expiry_date')}}@endif">
    @if($errors->first('expiry_date'))
    <span class="text text-danger">* {{ $errors->first('expiry_date') }}</span>
    @endif
    </div>
    <div class="form-group">
      <label for="name">Image:</label><br>
      @if(isset($data->upload_icon))
        <img id="blah" src="{{ $data->upload_icon }}" alt="your image" width="150" height="150">
      @else
        <img id="blah" src="{{asset('images/preview-icon.png')}}" alt="your image" width="150" height="150">
      @endif
      <br><br>
      <input type="file" required="" accept="image/*" class="form-control w-45" id="imgInp" name="upload_icon">
      @if($errors->first('upload_icon'))
      <span class="text text-danger">* {{ $errors->first('upload_icon') }}</span>
      @endif
    </div>
<input type="submit" class="btn btn-primary" value="submit">

<a href="{{ route('coupons.index') }}" class="btn btn-default" >Cancel</a>

</form>
</div>
    </div>
  </div>


<link href="{{asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="{{asset('assets/plugins/moment/moment.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<!-- Date range Plugin JavaScript -->
<script src="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>

<script>

  $(function() {
      $('#discount_per').hide(); 
      $('#discount_doller').hide(); 
      $('#coupon_type').change(function(){
          if($('#coupon_type').val() == '1') {
              $("#discount_pers").prop('required',true);
              $('#discount_per').show(); 
              $('#discount_doller').hide(); 
          } else if($('#coupon_type').val() == '2') {
              $("#discount_dollers").prop('required',true);
              $('#discount_doller').show(); 
              $('#discount_per').hide(); 
          }else{
            $('#discount_per').hide(); 
            $('#discount_doller').hide(); 
          } 
      });
  });

function isNumber(evt) {

    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;

    if (charCode > 31 && (charCode < 48 || charCode > 57) ) {
        return false;
    }
    if(document.getElementById('total').value.length >= 4){
        return false
    }
    return true;
}

jQuery('.mydatepicker, #datepicker').datepicker({
     startDate: "+0d",
     format: 'yyyy-mm-dd',
});

</script>
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
