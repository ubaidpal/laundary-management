
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
      @if(\Session::get('success'))
  <div class="alert alert-success hideClass" style="padding:5px;width:50%">
    {{ Session::get('success')  }}
  </div>
  @endif
  @if(Session::has('error'))
  <div class="alert alert-danger hideClass"  style="padding:5px;width:50%">
    {{ Session::get('error')  }}
  </div>
  @endif
    @if(\Auth::user()->type == 'ADMIN')
  @if(isset($schoolss->id))
<form class="form-material" action="{{ route('emergencymessage.school_update') }}" method="post" enctype="multipart/form-data">
  <input type="hidden" name="message_id" value="{{ $schoolss->id }}">
    @else
   <form class="form-material" action="{{ route('emergencymessage.school_create') }}" method="post">
    @endif
@else
   @if(isset($schoolss->id))
<form class="form-material" action="{{ route('staff.emergencymessage.school_update') }}" method="post" enctype="multipart/form-data">
  <input type="hidden" name="message_id" value="{{ $schoolss->id }}">
    @else
   <form class="form-material" action="{{ route('staff.emergencymessage.school_create') }}" method="post">
    @endif
@endif

    {!! csrf_field() !!} 
    
    
      <div class="form-group">
      <label for="name"> School :</label>
      <?php  if(isset($schoolss->school_id)){ 
        $school_ids = explode(',',$schoolss->school_id);   
      } ?>
     <select id="users_name" name="school_ids[]" multiple class="form-control schools_ids" >
       @foreach($schools as $val)
        <option value="{{ $val->id }}"@if(isset($school_ids) && in_array($val->id,$school_ids)){{ 'selected' }} @endif>{{ $val->school_name}}</option>
      @endforeach
     </select>
     @if($errors->first('school_ids'))
    <span class="text text-danger">* {{ $errors->first('school_ids') }}</span>
    @endif
      </div>
    <div class="form-group">
      <label for="name"> Date:</label>
      <input type="text"  class="form-control mydatepicker" id="date" placeholder="Enter date" name="date" value="{{ old('date') }}">
    @if($errors->first('date'))
    <span class="text text-danger">* {{ $errors->first('date') }}</span>
    @endif
    </div>

    {{--<div class="form-group">
      <label for="name">Time:</label>
      <input type="time" id="timpicker" class="form-control timpicker" placeholder="Enter time" name="time" value="@if(isset($schoolss->time)){{ $schoolss->time }}@else{{ old('date') }}@endif">
    @if($errors->first('time'))
    <span class="text text-danger">* {{ $errors->first('time') }}</span>
    @endif
    </div> --}}

    <div class="form-group">
      <label for="name">Message:</label>
      <textarea class="form-control timpicker" name="message" placeholder="Enter message">@if(isset($schoolss->message)){{ $schoolss->message }}@else{{ old('message') }}@endif</textarea> <!-- type="text"id="timpicker" class="form-control timpicker" placeholder="Enter time" name="time" value=""> -->
      @if($errors->first('message'))
        <span class="text text-danger">* {{ $errors->first('message') }}</span>
      @endif
    </div>

<input type="submit" class="btn btn-primary" value="submit">
  @if(\Auth::user()->type == 'ADMIN')
<a href="{{ route('emergencymessage.schoolindex') }}" class="btn btn-default" >Cancel</a>
@else
<a href="{{ route('staff.emergencymessage.schoolindex') }}" class="btn btn-default" >Cancel</a>
@endif
</form>
</div>
    </div>
  </div>


 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

 
 




<script>

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

/*jQuery('.mydatepicker, #datepicker').datepicker({
     format: 'yyyy-mm-dd',
     startDate: "+0m"
}); */

$("#date").datetimepicker({ 
  format:'YYYY-MM-DD hh:mm A',  
  minDate:new Date() 
});
$(document).ready(function(){
 /*$('#users_name').multiselect({
  nonSelectedText: 'Select Framework',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'400px'
 });*/
 
 });
 
@if(isset($schoolss->id)) 
     var $dateTime = '{{ $schoolss->date." ".$schoolss->time }}';
     $("#date").val($dateTime);
    @endif

</script>
  
@endsection
