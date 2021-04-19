@extends('layouts.app')

@section('content')

<style>
.table th{
    /* width:25%; */
    font-weight: 600;
    text-transform: uppercase;
}
</style>

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<div class="container-fuild">
  <div class="card">
    <div class="card-body">

  <div style="display: flow-root;">
    <h2 class="pull-left">View Charge</h2>
  <a href="{{route('transactions.index')}}" class="btn btn-default pull-right mt-20">Go Back</a>
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
<table class="table">
 <th>Items</th> 
    <tr>
        <th>Sno.</th>
        <th>Addon.</th>
        <th>Price</th>
        <th>Quantity</th>
        
    </tr>
    @php $j=1; @endphp
  @if($data->addonsDetail)
    @foreach ($data->addonsDetail as $item)
        <tr>
            <td>{{$j}}</td>
            <td>{{$item['addon_name']}}</td>
            <td>{{$item['price']}}</td>
            <td>{{$item['quantity']}}</td>
        </tr>
        @php $j++; @endphp
    @endforeach
    @endif
      @if($data->addonsDetail)
    <tr></tr>
       <tr>
        <th>Addon Total</th>
           <td colspan="6">{{$data->addonsTotalPrice}}</td>
       </tr>
     @endif  
</table>

@if($data->drycleanItems)
 <h2>Dryclean Items </h2>
<table class="table table-border table-striped">

    <tr>
        <th>Sno.</th>
        <th>Addon </th>
        <th>Quantity</th>
    </tr>
    @php $j=1; @endphp
   
    @foreach ($data->drycleanItems as $addon)
        <tr>
            <td>{{$j}}</td>
            <td>{{$addon['dryclean_name']}}</td>
            <td>{{$addon['quantity']}}</td>
        </tr>
        @php $j++; @endphp
    @endforeach
    

</table>
@endif


@if($data->specialRequestAddons)

<table class="table table-border table-striped">
<h2>Special Requests </h2>
    <tr>
        <th>Sno.</th>
        <th>Addon </th>
        <th>Price</th>
        <th>Quantity</th>
    </tr>
    @php $j=1; @endphp
    @foreach ($data->specialRequestAddons as $addon_s)  
        <tr>
            <td>{{$j}}</td>
            <td>{{$addon_s['addon_name']}}</td>
            <td>${{$addon_s['price']}}</td>
            <td>{{$addon_s['quantity']}}</td>
        </tr>
        @php $j++; @endphp
    @endforeach
     
    <tr></tr>
       <tr>
        <th>Special Request Total</th>
           <td colspan="6">{{$data->specialRequestPrice}}</td>
       </tr>
</table>
@endif

<table class="table">
  <th>Invoice Total :- &nbsp;&nbsp;&nbsp;${{ $data->total_amount }}</th> 
  <tr>
       <th>Order Id</th>
       <th>Subtotal</th>
      <th>Discount</th>
      <th>(tax rate)</th>
      <th>Tax</th>
      <th>Service Fee</th>
      <th>Total </th>
  </tr>

 <tr>
 <td>
        
      ORD{{ $data->id }}
        
    </td>
  <td>$
        <?php
            if(isset($data->tax)){
                $tax = ($data->total_amount * $data->tax) / 100;
                $subtotal = $data->total_amount - $tax;
                echo $subtotal;
            }else{
                $tax = 0;
                echo $data->total_amount;
            }
        ?>
    </td>
  
  <td>
        <?php
            echo '$'.(($data->coupon_price != null) ? $data->coupon_price : '0');
        ?>
    </td>
  
  <td>
        <?php
            echo (isset($data->tax)) ? $data->tax.' %' : 'N/A';
        ?>
  </td>
  
  <td>
        @if($data->subscription->tax) {{$data->subscription->tax}} @else {{'0'}} @endif
  </td>

    <td>
        @if($data->subscription->service_fee) {{$data->subscription->service_fee}} @else {{'0'}} @endif
   </td>
 
  <td>
        <?php
            echo $data->total_amount;
        ?>
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
