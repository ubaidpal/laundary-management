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
    <h2 class="pull-left">View User</h2>
  <a href="{{route('users.index')}}" class="btn btn-default pull-right mt-20">Go Back</a>
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
        Profile Image
    </th>
    <td>
        @if (!empty($data->profile_image))
            <img src="{{ asset('images/users').'/'.$data->profile_image  }}" width=100>
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
        {{ $data->first_name.' '.$data->last_name }}
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
        Date of Birth
    </th>
    <td>
        {{ $data->dob }}
    </td>
</tr>

<tr>
    <th>
        Username
    </th>
    <td>
        {{ $data->username }}
    </td>
</tr>

<tr>
    <th>
        School Name
    </th>
    <td>
        {{ $data->school_name }}
    </td>
</tr>


<tr>
    <th>
        Live in Campus
    </th>
    <td>
        @if($data->in_campus == 0){{ 'No' }} @else {{ 'Yes' }}@endif
    </td>
</tr>

@if($data->in_campus == 1)

<tr>
    <th>
        Hall Name
    </th>
    <td>
        {{ $data->hall }}
    </td>
</tr>


<tr>
    <th>
        Room Number
    </th>
    <td>
        {{ $data->room_number }}
    </td>
</tr>

@else

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
        City
    </th>
    <td>
        {{ $data->city }}
    </td>
</tr>


<tr>
    <th>
        Zipcode
    </th>
    <td>
        {{ $data->zipcode }}
    </td>
</tr>


<tr>
    <th>
        Country
    </th>
    <td>
        {{ $data->country }}
    </td>
</tr>


<tr>
    <th>
        Doorcode
    </th>
    <td>
        {{ $data->doorcode }}
    </td>
</tr>
@endif

<tr>
    <th>
        Parent Name
    </th>
    <td>
        {{ $data->pname }}
    </td>
</tr>

<tr>
    <th>
        Parent Email
    </th>
    <td>
        {{ $data->pemail }}
    </td>
</tr>

<tr>
    <th>
        Parent Contact
    </th>
    <td>
        {{ $data->pcontact }}
    </td>
</tr>

<tr>
    <th>
        Credit Card Type
    </th>
    <td>
        {{ $data->card_type }}
    </td>
</tr>

<tr>
    <th>
        Credit Card Number
    </th>
    <td>
        {{ $data->card_number }}
    </td>
</tr>

<tr>
    <th>
        Credit Card Expiry
    </th>
    <td>
        {{ $data->card_month.'/'.$data->card_month  }}
    </td>
</tr>

<tr>
    <th>
        Credit Card CVV
    </th>
    <td>
        {{ $data->card_cvv  }}
    </td>
</tr>

<tr>
    <th>
        Gratiuty
    </th>
    <td>
        {{ $data->gratuity  }}
    </td>
</tr>

<tr>
    <th>
        Action
    </th>
    <td>
        <!-- @if($data->status == 1)<a  href="{{ route('users.status',[$data->id,0]) }}" class="text-success">{{ 'Block' }}</a> @else <a href="{{ route('users.status',[$data->id,1]) }}" class="text-danger "> {{ 'Unblock' }} </a> @endif  &nbsp;&nbsp;&nbsp;&nbsp;  -->
        <a href="{{ route('users.edit', $data->id) }}"> End subscription </a>&nbsp;
        <a href="{{ route('users.edit', $data->id) }}"> Edit</a>&nbsp;
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
