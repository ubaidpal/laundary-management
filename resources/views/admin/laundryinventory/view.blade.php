@extends('layouts.app')

@section('content')

<style>
th{
    width:20%;
    font-weight: 700;
}
span.plan_BINS {
    padding: 16px;
    margin: 0px 0px;
}

.table td:last-child {
    text-align: right !important;
}
.table th:last-child {
    text-align: right;
}

</style>

<?php //echo $data->subscription->cart->dorm_name;die();  ?>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<div class="container-fuild" id="printabledata">
  <div class="card">
    <div class="card-body">

  <div style="display: flow-root;">
    <h2 class="pull-left">View Inventary</h2>
      @if(\Auth::user()->type == 'ADMIN')
      <a href="{{route('laundrylogs.inventoryindex')}}" class="btn btn-default pull-right mt-20">Go Back</a>
      <a href="#" class="btn btn-default pull-right mt-20 " onclick="printReport()">Print</a>
      @else
      <a href="{{route('staff.orders.index')}}" class="btn btn-default pull-right mt-20">Go Back</a>
      @endif
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

    <table class="table table-border table-striped" id="">
     
    @if($data->service == 'Laundry') 
        
        <table class="table table-border table-striped">
            <h2>Order Items </h2>
            <tr>
                <th>Sno.</th>
                <th>Item name</th>
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
                <th>Total</th>
            </tr>
            @php $j=1; @endphp
            @if($data->drycleanItems)
            @foreach ($data->drycleanItems as $addon)
                <tr>
                    <td>{{$j}}</td>
                    <td>{{$addon['dryclean_name']}}</td>
                    <td>{{$addon['price']}}</td>
                    <td>{{$addon['quantity']}}</td>
                    <td>{{$addon['quantity'] * $addon['price']}}</td>
                </tr>
                @php $j++; @endphp
            @endforeach
            @endif
        </table>
    @endif

    @if($data->service == 'Housekeeping') 

        @if(!empty($data->addonsDetail))
            <table class="table table-border table-striped">
                <h2>Addon Items </h2>
                <tr>
                    <th>Sno.</th>
                    <th>Iten name </th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                @php $j=1; @endphp
                @foreach ($data->addonsDetail as $addon)  
                    <tr>
                        <td>{{$j}}</td>
                        <td>{{$addon['addon_name']}}</td>
                        <td>${{$addon['price']}}</td>
                        <td>{{$addon['quantity']}}</td>
                        <td>{{$addon['quantity'] * $addon['price']}}</td>
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
        @endif

        @if(!empty($data->specialRequestAddons))
            <table class="table table-border table-striped">
            <h2>Special Requests </h2>
                <tr>
                    <th>Sno.</th>
                    <th>Item name </th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                @php $j=1; @endphp
                @foreach ($data->specialRequestAddons as $addon_s)  
                    <tr>
                        <td>{{$j}}</td>
                        <td>{{$addon_s['addon_name']}}</td>
                        <td>${{$addon_s['price']}}</td>
                        <td>{{$addon_s['quantity']}}</td>
                        <td>{{$addon_s['quantity'] * $addon_s['price']}}</td>
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
    @endif

    @if($data->service == 'Storage')

        <hr>
        <table class="table table-border table-striped">
            @if(!empty($data->addonsDetail))

                <table class="table table-border table-striped">
                    <h2>Items in order </h2>
                    <tr>
                        <th>Sno. <span class="plan_BINS">{{ $data->plan->description }} ( ${{$data->plan->price }})</span></th>
                        <!-- <th></th> -->
                        <th>Item name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                    @php $j=1; @endphp
                    @foreach ($data->addonsDetail as $addon) 

                         
                        <tr>
                            <td>{{$j}}</td>
                            <!-- <td></td> -->
                            <td>{{$addon['addon_name']}}</td>
                            <td>{{$addon['quantity']}}</td>
                            <td>${{$addon['price']}}</td>
                            <td>{{$addon['quantity'] * $addon['price']}}</td>
                        </tr>
                        @php $j++; @endphp
                    @endforeach
                    
                    
                   <tr>
                    <th>Large Items Total</th>
                       <td colspan="4" style="text-align: right;">{{$data->addonsTotalPrice}}</td>
                   </tr> 
                </table>
            @endif 
        </table>
    @endif 
    </table>
  </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script>
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

<script type="text/javascript">
    function printReport()
    {
        
         $("#printabledata").print();
    }

    
</script>

@endsection
