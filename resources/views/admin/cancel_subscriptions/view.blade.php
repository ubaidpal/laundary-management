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
    <h2 class="pull-left">Subscription</h2>
    @if(\Auth::user()->type == 'ADMIN')
  <a href="{{route('subscription.cancelations')}}" class="btn btn-default pull-right mt-20">Go Back</a>@else
  <a href="{{route('staff.subscription.cancelations')}}" class="btn btn-default pull-right mt-20">Go Back</a>@endif
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
        Username
    </th>
    <td>
        {{ $data->subscription->user->username }}
    </td>
</tr>

<tr>
    <th>
        Start Date
    </th>
    <td>
        {{ $data->subscription->start }}
    </td>
</tr>

<tr>
    <th>
        End Date
    </th>
    <td>
        {{ $data->subscription->end }}
    </td>
</tr>

<tr>
    <th>
        Coupon
    </th>
    <td>
        {{ $data->subscription->coupon }}
    </td>
</tr>


<tr>
    <th>
        Total
    </th>
    <td>
        {{ $data->subscription->total }}
    </td>
</tr>

<tr>
    <th>
        Subtotal
    </th>
    <td>
        {{ $data->subscription->subtotal }}
    </td>
</tr>

<tr>
    <th>
        Reson
    </th>
    <td>
        {{ $data->reason }}
    </td>
</tr>

<tr>
    <th>
        Description
    </th>
    <td>
        {{ $data->description }}
    </td>
</tr>






</table>
    <form class="form-material" action="{{ route('cancelations.update') }}" method="post">
        @csrf
        <input type="hidden" name="cancelations_id" value="{{ $data->id }}">
        <div class="form-group">
            <label for="name">Action:</label>
            <select class="form-control" name="action">
                <option value="">Select</option>
                <option value="Contact to resolve" @if(old('action') == 'Contact to resolve') selected @elseif(isset($data->action) == 'Contact to resolve') {{'selected'}} @endif>Contact to resolve </option>
                <option value="No contact 5 attempts – cancel service" @if(old('action') == 'No contact 5 attempts – cancel service') selected @elseif(isset($data->action) == 'No contact 5 attempts – cancel service') {{'selected'}} @endif >No contact 5 attempts – cancel service</option>
                <option value="No desired resolution betweem customer – cancel service" @if(old('action') == 'No desired resolution betweem customer – cancel service') selected @elseif(isset($data->action) == 'No desired resolution betweem customer – cancel service') {{'selected'}} @endif >No desired resolution betweem customer – cancel service</option>
            </select>
            <span class="text text-danger"> {{ $errors->first('action') }}</span>
        </div>
        <div class="form-group">
            <label for="name">Resolution :</label>
            <select name="resolution" class="form-control">
                <option value="">Select</option>
                <option value="Full Refund" @if(old('resolution') == 'Full Refund') selected   @elseif(isset($data->resolution) == 'Full Refund') {{'selected'}} @endif>Full Refund </option>
                <option value="Prorated refund" @if(old('resolution') == 'Prorated refund') selected @elseif(isset($data->resolution) == 'Prorated refund') {{'selected'}}  @endif>Prorated refund </option>
                <option value="15% off next service" @if(old('resolution') == '15% off next service') selected @elseif(isset($data->resolution) == '15% off next service') {{'selected'}} @endif>15% off next service</option>
            </select>
            <span class="text text-danger"> {{ $errors->first('resolution') }}</span>
        </div>
        <div class="form-group">
            <label for="name">Notes:</label>
            <textarea name="notes" id="notes" class="form-control" placeholder="Enter notes">@if(isset($data->notes)) {{ $data->notes }} @else {{ old('notes')}} @endif</textarea>
            <label style="color:#000;" id="notes_chars">1000 characters left</label>
            <span class="text text-danger"> {{ $errors->first('notes') }}</span>
        </div>
     
        <button type="submit" class="btn btn-default">Submit</button>
    </form>

  </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        var maxLength = 1000;
        $('#notes').keyup(function() {
            var length = $(this).val().length;
            var length = maxLength-length;
            $('#notes_chars').text(length+' characters left');
        });
          setTimeout(function(){  $(".hideClass").hide('slow'); },4000);
    });
    </script>

@endsection
