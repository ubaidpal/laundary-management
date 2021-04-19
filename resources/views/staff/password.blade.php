@extends('layouts.app')

@section('content')

<style>
    .w-45{
        width:45%;
    }
    .mt-20{
        margin-top: 20px;
    }
</style>
<div class="container-fuild">
  <div class="card">
    <div class="card-body">


  <h2 style="display:inline-block">Change Password</h2>
<a href="{{ route('staff.home') }}" class="btn btn-default pull-right mt-20">Back to Dashboard</a>
@if(\Session::get('success'))
  <div class="alert alert-success hideClass"  style="padding:5px;width:50%">
    {{ Session::get('success')  }}
  </div>
  @endif
  @if(Session::has('error'))
  <div class="alert alert-danger hideClass"  style="padding:5px;width:50%">
    {{ Session::get('error')  }}
  </div>
  @endif

  <hr>


  <form class="form-material" action="{{ route('staff.password.update') }}" method="post">
    {!! csrf_field() !!}

    <div class="form-group">
      <label for="email">Old Password:</label>
      <input type="password" class="form-control" id="old_password"  name="old_password" >
    @if($errors->has('old_password'))
    <span class="text-danger">*{{ $errors->first('old_password')}}</span>
    @endif
    </div>
    <div class="form-group">
      <label for="email">New Password:</label>
      <input type="password" class="form-control" id="password"  name="password" >
      @if($errors->has('password'))
    <span class="text-danger">*{{ $errors->first('password')}}</span>
    @endif
    </div>

    <div class="form-group">
      <label for="email">Confirm Password:</label>
      <input type="password" class="form-control" id="con_password" name="password_confirmation" >
    </div>

      <button type="submit" class="btn btn-default">Submit</button>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  </form>
    </div>
  </div></div>

<script>
$(document).ready(function(){
  setTimeout(function(){ $('.hideClass').hide(1000); },2000);
});
</script>

@endsection
