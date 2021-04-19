
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
  @if(isset($usersss->id))
   
  <form class="form-material" action="{{ route('emergencymessage.usersmessageupdate') }}" method="post" enctype="multipart/form-data">
  <input type="hidden" name="message_id" value="{{ $usersss->id }}">
    @else
   <form class="form-material" action="{{ route('emergencymessage.create') }}" method="post">
    @endif

@else
   @if(isset($usersss->id))
   
  <form class="form-material" action="{{ route('staff.emergencymessage.usersmessageupdate') }}" method="post" enctype="multipart/form-data">
  <input type="hidden" name="message_id" value="{{ $usersss->id }}">
    @else
   <form class="form-material" action="{{ route('staff.emergencymessage.create') }}" method="post">
    @endif
@endif

    {!! csrf_field() !!} 
    <div class="form-group">
      <label for="name"> Users:</label>

     <select id="users_name" name="users_name[]" multiple class="form-control users_names_ids" >
       
      <?php  if(isset($usersss->user_id)){ 
        $users_ids = explode(',',$usersss->user_id);   
      } ?>
      @foreach($data as $val) 
        <option value="{{ $val->id }}" @if(isset($users_ids) && in_array($val->id,$users_ids)){{ 'selected' }} @endif >{{ $val->first_name}} {{$val->last_name }}</option>
      @endforeach
     </select>

      @if($errors->first('users_name'))
    <span class="text text-danger">* {{ $errors->first('users_name') }}</span>
    @endif
      </div>
       
    <div class="form-group">
      <label for="name"> Date:</label>
      <input type="text"  class="form-control mydatepicker" id="date" placeholder="Enter date" name="date" value="{{old('date')}}">
    @if($errors->first('date'))
    <span class="text text-danger">* {{ $errors->first('date') }}</span>
    @endif
    </div>

   {{-- <div class="form-group">
      <label for="name">Time:</label>
      <input type="time"id="timpicker" class="form-control timpicker" placeholder="Enter time" name="time" value="@if(isset($usersss->time)){{ $usersss->time }}@else{{ old('time') }}@endif">
    @if($errors->first('time'))
    <span class="text text-danger">* {{ $errors->first('time') }}</span>
    @endif
    </div> --}}
     <div class="form-group">
      <label for="name">Message:</label>
      <textarea class="form-control" name="message" placeholder="Enter message">@if(isset($usersss->message)){{ $usersss->message }}@else{{ old('message') }}@endif</textarea> <!-- type="text"id="timpicker" class="form-control timpicker" placeholder="Enter time" name="time" value=""> -->
      @if($errors->first('message'))
        <span class="text text-danger">* {{ $errors->first('message') }}</span>
      @endif
    </div>
<input type="submit" class="btn btn-primary" value="submit">
 @if(\Auth::user()->type == 'ADMIN')
<a href="{{ route('emergencymessage.usersindex') }}" class="btn btn-default" >Cancel</a>
@else
<a href="{{ route('staff.emergencymessage.usersindex') }}" class="btn btn-default" >Cancel</a>
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

$("#date").datetimepicker({ 
  format:'YYYY-MM-DD hh:mm A',  
  minDate:new Date() 
});
 
   

    @if(isset($usersss->id)) 
     var $dateTime = '{{ $usersss->date." ".$usersss->time }}';
     $("#date").val($dateTime);
    @endif

   
 

</script>

@endsection
