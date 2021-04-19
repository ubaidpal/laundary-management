@extends('layouts.app')

@section('content')

<style>
th{
    width:20%;
    font-weight: 700;
}
</style>
<?php //echo $data->subscription->cart->dorm_name;die();  ?>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<div class="container-fuild">
  <div class="card">
    <div class="card-body">

  <div style="display: flow-root;">
    <h2 class="pull-left">View Order</h2>
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
        Order Id
    </th>
    <td>
        ORD{{ $data->id }}
    </td>
</tr>
@if($data->service == 'Laundry') 

<table class="table table-border table-striped">


<tr>
    <th>
        Service
    </th>
    <td>
        {{ $data->service }}
    </td>
</tr>


<tr>
    <th>
        Plan
    </th>
    <td>
       {{ $data->plan->description }}( ${{$data->plan->price }}) 
    </td>
</tr>

<tr>
    <th>
        Date
    </th>
    <td>

        {{ $data->order_date }}
    </td>
</tr>

<tr>
    <th>
        Time
    </th>
    <td>
        {{ $data->order_time }}
    </td>
</tr>

<tr>
    <th>
        Drycleaning
    </th>
    <td>
        @if(@$data->cart->is_dryclean == '0'){{ 'No' }}@else{{ 'Yes' }} @endif
    </td>
</tr>

<tr>
    <th>
        Insurance
    </th>
    <td>
        @if(!empty($data->insurance_price)) ${{$data->insurance_price}} @endif
        @if(!empty($data->plan_type)) {{$data->plan_type}} @endif
    </td>

      
    
</tr>

<tr>
    <th>
        Dropoff Date
    </th>
    <td>
         {{ $data->subscription->cart->dropoff_date }}
    </td>
</tr>

<tr>
    <th>
        Dropoff Time
    </th>
    <td>
         {{ $data->subscription->cart->dropoff_time }}
    </td>
</tr>

<tr>
    <th>
        First Name
    </th>
    <td>
        {{ $data->user->first_name }}
    </td>
</tr>
<tr>
    <th>
        Last Name
    </th>
    <td>
        {{ $data->user->last_name }}
    </td>
</tr>
<tr>
    <th>
        Email
    </th>
    <td>
        {{ $data->user->email }}
    </td>
</tr>
<tr>
    <th>
        Phone Number
    </th>
    <td>
        {{ $data->user->contact }}
    </td>
</tr>
<tr>
    <th>
        School Name
    </th>
    <td>
        {{ $data->user->school_name }}
    </td>
</tr>



<tr>
    <th>
        Drom Name
    </th>
    <td>
        {{ $data->subscription->cart->dorm_name }}
    </td>
</tr>



@if($data->user->in_campus == '1')

<tr>
    <th>
        Hall Name
    </th>
    <td>
        {{ $data->user->hall }}
    </td>
</tr>

<tr>
    <th>
        Room Number
    </th>
    <td>
        {{ $data->user->room_number }}
    </td>
</tr>


@else

<tr>
    <th>
        Address
    </th>
    <td>
        {{ $data->user->address }}
    </td>
</tr>

<tr>
    <th>
        City
    </th>
    <td>
        {{ $data->user->city }}
    </td>
</tr>

<tr>
    <th>
        Zipcode
    </th>
    <td>
        {{ $data->user->zipcode }}
    </td>
</tr>


@endif


<tr>
    <th>
        Parent Name
    </th>
    <td>
         {{ $data->user->pfirst_name.' '.$data->user->plast_name }}
    </td>
</tr>

<tr>
    <th>
        Parent Email
    </th>
    <td>
        {{ $data->user->pemail }}
    </td>
</tr>

<tr>
    <th>
        Parent Contact
    </th>
    <td>
        {{ $data->user->pcontact }}
    </td>
</tr>



<tr>
    <th>
        Gratuity
    </th>
    <td>
        {{ $data->gratuity	 }}
    </td>
</tr>
<tr>
    <th>
        Tax
    </th>
    <td>
         {{ $data->subscription->tax   }}
    </td>
</tr>
<tr>
    <th>
        Service Fee
    </th>
    <td>
         {{ $data->subscription->service_fee   }}
    </td>
</tr>

<tr>
    <th>
        Total Amount
    </th>
    <td>
        {{ $data->subscription->total   }}
    </td>
</tr>

</table>

<table class="table table-border table-striped">
<h2>Order Items </h2>
    <tr>
        <th>Sno.</th>
        <th>Cloth.</th>
        <th>Quantity</th>
    </tr>
    @php $j=1; @endphp
    @if($data->laundryItems)
    @foreach ($data->laundryItems as $item)
        <tr>
            <td>{{$j}}</td>
            <td>{{$item['item_name']}}</td>
            <td>{{$item['quantity']}}</td>
        </tr>
        @php $j++; @endphp
    @endforeach
    @endif

</table>



<table class="table table-border table-striped">
<h2>Dryclean Items </h2>
    <tr>
        <th>Sno.</th>
        <th>Addon </th>
           <th>Price</th>
        <th>Quantity</th>
    </tr>
    @php $j=1; @endphp
    @if($data->drycleanItems)
    @foreach ($data->drycleanItems as $addon)
        <tr>
            <td>{{$j}}</td>
            <td>{{$addon['dryclean_name']}}</td>
            <td>{{$addon['price']}}</td>
            <td>{{$addon['quantity']}}</td>
        </tr>
        @php $j++; @endphp
    @endforeach
    @endif

</table>



@endif

@if($data->service == 'Housekeeping')

<table class="table table-border table-striped">

    <tr>
    <th>
        Service
    </th>
    <td>
        {{ $data->service }}
    </td>
</tr>


<tr>
    <th>
        Plan
    </th>
    <td>
        {{ $data->plan->description }}( ${{$data->plan->price }}) 
    </td>
</tr>


<tr>
    <th>
        Date
    </th>
    <td>
        {{ $data->order_date }}
    </td>
</tr>

<tr>
    <th>
        Time
    </th>
    <td>
        {{ $data->order_time }}
    </td>
</tr>

{{-- <tr>
    <th>
        Insurance:-
    </th>
    <td>
        @if(!empty($data->insurance_price)) ${{$data->insurance_price}} @endif
        @if(!empty($data->plan_type)) {{$data->plan_type}} @endif
    </td>

      
    
</tr> --}}


<tr>
    <th>
        Drom Name
    </th>
    <td>
        {{ $data->subscription->cart->address }}
    </td>
</tr>
<tr>
    <th>
         Address
    </th>
    <td>
        {{ $data->subscription->cart->address }}
    </td>
</tr>



@if($data->user->in_campus == '1')

<tr>
    <th>
        Hall Name
    </th>
    <td>
        {{ $data->user->hall }}
    </td>
</tr>

<tr>
    <th>
        Room Number
    </th>
    <td>
        {{ $data->user->room_number }}
    </td>
</tr>


@else



<tr>
    <th>
        City
    </th>
    <td>
        {{ $data->user->city }}
    </td>
</tr>

<tr>
    <th>
        Zipcode
    </th>
    <td>
        {{ $data->user->zipcode }}
    </td>
</tr>


@endif



<tr>
    <th>
        Parent Name
    </th>
    <td>
        {{ $data->user->pfirst_name.' '.$data->user->plast_name }}
    </td>
</tr>

<tr>
    <th>
        Parent Email
    </th>
    <td>
        {{ $data->user->pemail }}
    </td>
</tr>

<tr>
    <th>
        Parent Contact
    </th>
    <td>
        {{ $data->user->pcontact }}
    </td>
</tr>



<tr>
    <th>
        Gratuity
    </th>
    <td>
        {{ $data->gratuity   }}
    </td>
</tr>

<tr>
    <th>
        Tax
    </th>
    <td>
         {{ $data->subscription->tax   }}
    </td>
</tr>
<tr>
    <th>
        Service Fee
    </th>
    <td>
         {{ $data->subscription->service_fee   }}
    </td>
</tr>

<tr>
    <th>
        Total Amount
    </th>
    <td>
        {{ $data->subscription->total   }}
    </td>
</tr>

</table>



<table class="table table-border table-striped">
<h2>Addon Items </h2>
    <tr>
        <th>Sno.</th>
        <th>Addon </th>
        <th>Price</th>
        <th>Quantity</th>
    </tr>
    @php $j=1; @endphp
    @foreach ($data->addonsDetail as $addon)  
        <tr>
            <td>{{$j}}</td>
            <td>{{$addon['addon_name']}}</td>
            <td>${{$addon['price']}}</td>
            <td>{{$addon['quantity']}}</td>
        </tr>
        @php $j++; @endphp
    @endforeach
    @if($data->addonsDetail)
    <tr></tr>
       <tr>
        <th>Addon Total</th>
           <td colspan="6">{{$data->addonsTotalPrice}}</td>
       </tr>
     @endif  


</table>


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
     @if($data->specialRequestAddons)
    <tr></tr>
       <tr>
        <th>Special Request Total</th>
           <td colspan="6">{{$data->specialRequestPrice}}</td>
       </tr>
       @endif

</table>




@endif
@if($data->service == 'Storage')

<hr>
<table class="table table-border table-striped">

<tr>
    <th>
        Service
    </th>
    <td>
        {{ $data->service }}
    </td>
</tr>


<tr>
    <th>
        Plan
    </th>
    <td>
        {{ $data->plan->description }}( ${{$data->plan->price }}) 
    </td>
</tr>

<tr>
    <th>
        Large Item
    </th>
    <td>
        @if($data->large_item == '0'){{ 'No' }}@else{{ 'Yes' }}@endif
    </td>
</tr>


<tr>
    <th>
        Dropoff Date
    </th>
    <td>
        {{ $data->subscription->cart->dropoff_date }}
    </td>
</tr>

<tr>
    <th>
        Dropoff Time
    </th>
    <td>
        {{ $data->subscription->cart->dropoff_time }}
    </td>
</tr>

<tr>
    <th>
        Pickup Date
    </th>
    <td>
        {{ $data->subscription->cart->pickup_date }}
    </td>
</tr>

<tr>
    <th>
        Pickup Time
    </th>
    <td>
        {{ $data->subscription->cart->pickup_time }}
    </td>
</tr>
{{-- <tr>
    <th>
        Insurance:-
    </th>
    <td>
        @if(!empty($data->insurance_price)) ${{$data->insurance_price}} @endif
        @if(!empty($data->plan_type)) {{$data->plan_type}} @endif
    </td>

      
    
</tr> --}}



@if($data->user->in_campus == '1')

<tr>
    <th>
        Hall Name
    </th>
    <td>
        {{ $data->user->hall }}
    </td>
</tr>

<tr>
    <th>
        Room Number
    </th>
    <td>
        {{ $data->user->room_number }}
    </td>
</tr>


@else

<tr>
    <th>
        Address
    </th>
    <td>
        {{ $data->user->address }}
    </td>
</tr>

<tr>
    <th>
        City
    </th>
    <td>
        {{ $data->user->city }}
    </td>
</tr>

<tr>
    <th>
        Zipcode
    </th>
    <td>
        {{ $data->user->zipcode }}
    </td>
</tr>


@endif



<tr>
    <th>
        Parent Name
    </th>
    <td>
        {{ $data->user->pfirst_name.' '.$data->user->plast_name }}
    </td>
</tr>

<tr>
    <th>
        Parent Email
    </th>
    <td>
        {{ $data->user->pemail }}
    </td>
</tr>

<tr>
    <th>
        Parent Contact
    </th>
    <td>
        {{ $data->user->pcontact }}
    </td>
</tr>



<tr>
    <th>
        Gratuity
    </th>
    <td>
         {{ $data->subscription->grautity   }}
    </td>
</tr>

<tr>
    <th>
        Tax
    </th>
    <td>
         {{ $data->subscription->tax   }}
    </td>
</tr>
<tr>
    <th>
        Service Fee
    </th>
    <td>
         {{ $data->subscription->service_fee   }}
    </td>
</tr>

<tr>
    <th>
        Total Amount
    </th>
    <td>
        {{ $data->subscription->total   }}
    </td>
</tr>
 
@endif
@if(!empty($data->addonsDetail))

<table class="table table-border table-striped">
<h2>Large Items </h2>
    <tr>
        <th>Sno.</th>
        <th>Item </th>
        <th>Price</th>
        <th>Quantity</th>
    </tr>
    @php $j=1; @endphp
    @foreach ($data->addonsDetail as $addon)  
        <tr>
            <td>{{$j}}</td>
            <td>{{$addon['addon_name']}}</td>
            <td>${{$addon['price']}}</td>
            <td>{{$addon['quantity']}}</td>
        </tr>
        @php $j++; @endphp
    @endforeach
    
    <tr></tr>
       <tr>
        <th>Large Items Total</th>
           <td colspan="6">{{$data->addonsTotalPrice}}</td>
       </tr>
     


</table>
@endif 
<tr>
    <th>
        Assign Order 

    </th>
    <td>
        {{-- <select class="form-control" id="orderstatus" data-id="{{ $data->id }}" style="height: auto; width:30%" >
            <option value="0"  @if($data->order_status == '0'){{ 'selected' }}@endif >New Order</option>
            <option value="1" @if($data->order_status == '1'){{ 'selected' }}@endif >Inprogress</option>
            <option value="2" @if($data->order_status == '2'){{ 'selected' }}@endif >Cancel</option>
            <option value="2" @if($data->order_status == '3'){{ 'selected' }}@endif >Completed</option>
        </select> --}}
        <select class="form-control" id="orderstatus" data-id="{{ $data->id }}" style="height: auto; width:30%" >
            @if(empty($chk_order->staff_id))<option value="" disabled="" selected="">Select Staff Member</option>
            @foreach($staff_members as $staff_member)
            <option value="{{$staff_member->id}}"  @if($staff_member->id == @$chk_order->staff_id){{ 'selected' }}@endif >{{$staff_member->name}}</option>
            @endforeach
            @else
            <option value="" >{{$chk_order->staff->name}}</option>
            @endif

        </select>
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
        orderstatus =  $('#orderstatus').val();
        $('#orderstatus').change(function(){
            var order_id = $(this).data('id');
            var staff_id = $(this).val();
           // console.log(id,accept_status);
           if (!confirm("Are you sure want to assign this order?")) {
                $(this).val(orderstatus); //set back
                return;                  //abort!
            } 
            $.ajax({
                type:"get",
                url: "{{route('orders.assignOrder')}}",
                data:{order_id:order_id,staff_id:staff_id},
                success:function(result){
                    // location.reload();
                    location.reload(true);
                    console.log(result)
                }
            })
        })

    });
</script>

@endsection
