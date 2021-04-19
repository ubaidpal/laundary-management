@extends('layouts.app')

@section('content')

<style>
th{
    width:20%;
    font-weight: 700;
}
</style>

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<div class="container-fuild">
  <div class="card">
    <div class="card-body">

  <div style="display: flow-root;">
    <h2 class="pull-left">View Staff Member</h2>
  <a href="{{route('staff_members.index')}}" class="btn btn-default pull-right mt-20">Go Back</a>
  </div>


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

<table class="table table-border table-striped">

<tr>
    <th>
         Image
    </th>
    <td>
        @if (!empty($data->profile_image))
            <img src="{{ asset('images/staff_members').'/'.$data->profile_image  }}" width=100>
        @else
            <img src="{{ asset('images/users').'/'.'default-user.png'  }}" width=100 >
        @endif

    </td>
</tr>


<tr>
    <th>
        Name
    </th>
    <td>
        {{ $data->name }}
    </td>
</tr>

<tr>
    <th>
        Email
    </th>
    <td>
        {{ $data->email }}
    </td>
</tr>

<tr>
    <th>
        Contact
    </th>
    <td>
        {{ $data->contact }}
    </td>
</tr>

<tr>
    <th>
        Address
    </th>
    <td>
        {{ $data->address }}
    </td>
</tr>


<tr>
    <th>
        School Assignment
    </th>
    <td>
        {{ $data->school_assignment }}
    </td>
</tr>

<tr>
    <th>
        Role Assignment
    </th>
    <td>
        {{ $data->role_assignment }}
    </td>
</tr>


<tr>
    <th>
        Action
    </th>
    <td>
        @if($data->status == 1)<a  href="{{ route('staff_members.status',[$data->id,0]) }}" class="text-success">{{ 'Block' }}</a> @else <a href="{{ route('staff_members.status',[$data->id,1]) }}" class="text-danger "> {{ 'Unblock' }} </a> @endif
    </td>
</tr>



</table>


  </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
          setTimeout(function(){  $(".hideClass").hide('slow'); },4000);
    });
    </script>

@endsection
