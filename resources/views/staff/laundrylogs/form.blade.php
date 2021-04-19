
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
    <h2>Edit Laundry Log</h2>
    @else
    <h2>New Laundry Log</h2>
    @endif
  @if(isset($data->id))
<form class="form-material" action="{{ route('staff.laundrylogs.update',$data->id) }}" method="post" enctype="multipart/form-data">
    @else
   <form class="form-material" action="{{ route('staff.laundrylogs.create') }}" method="post">
    @endif
    {!! csrf_field() !!}

    <div class="form-group">
      <label for="name">Order:</label><br>
        <select class="form-control" id="orderdetails_id" name="orderdetails_id" style="width:25%">
            <option value="" disabled selected>Please select Order</option>

        @foreach ($orders as $order)

        <option value="{{ $order->id }}"  @if(@$order_details->id == $order->id) {{'selected'}} @endif>ORD{{ $order->id }}</option>

        @endforeach

        </select>
<br>
    @if($errors->first('service'))
    <span class="text text-danger">* {{ $errors->first('service') }}</span>
    @endif
    </div>

    <div class="form-group">
      <label for="name">Date:</label>
      <input type="text"  class="form-control " id="date" placeholder="Enter date" name="date" value="@if(isset($order_details->order_date)){{ $order_details->order_date }}@endif" readonly>
    
    </div>


  {{--   <input type="hidden" id="orderdetails_ids" name="orderdetails_id" value=""> --}}

    {{-- <div class="form-group">
      <label for="name">User Name:</label>
      <input type="text"  class="form-control" id="username" placeholder="Enter username" name="username" value="@if(isset($data->username)){{ $data->username }}@endif">
    @if($errors->first('username'))
    <span class="text text-danger">* {{ $errors->first('username') }}</span>
    @endif
    </div> --}}

    <div class="form-group">
      <label for="name">User:</label><br>
      <input type="text"  class="form-control" name="username" value="@if(isset($order_details->user->username)){{ $order_details->user->username }}@endif" readonly>
<br>

    

    </div>

    <div class="form-group">
      <label for="name">Weight Plan(in lbs):</label>
      <input type="text"  class="form-control" id="weight_plan"  name="weight_plan" value="@if(isset($order_details->plan->weight)) {{ $order_details->plan->weight }}@endif" readonly>
    </div>

    <div class="form-group">
      <label for="name">Weight Received:</label>
      <input type="number" max="50"  class="form-control" id="weight_received" placeholder="Enter weight received" name="weight_received" value="@if(isset($data->weight_received)){{ $data->weight_received }}@endif">
    @if($errors->first('weight_received'))
    <span class="text text-danger">* {{ $errors->first('weight_received') }}</span>
    @endif
    </div>

    <div class="form-group">
      <label for="name">Over Weight:</label>
      <input type="text"  class="form-control" id="overweight" placeholder="Enter overweight" name="overweight" value="@if(isset($data->overweight)){{ $data->overweight }}@endif">
    @if($errors->first('overweight'))
    <span class="text text-danger">* {{ $errors->first('overweight') }}</span>
    @endif
    </div>

    <div class="form-group">
      <label for="name">Over Charged:</label>
      <input type="text"  class="form-control" id="overcharged" placeholder="Enter overcharged" name="overcharged" value="@if(isset($data->overcharged)){{ $data->overcharged }}@endif" readonly>
    @if($errors->first('overcharged'))
    <span class="text text-danger">* {{ $errors->first('overcharged') }}</span>
    @endif
    </div>

    <div class="form-group" id="appendDataDiv">
      <label for="name">Dryclean:</label>
      <br>
        <button type="button" class="btn btn-info" id="select-items" data-toggle="modal" data-target="#myModal">Select Dry Clean Items</button>

    </div>
    <li style="margin: 10px;"><b><u> Final Charge :- $<span id="totalll">0</span> </u></b></li>

    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" >Select Dryclean Items</h4>
      </div>
      <div class="modal-body">
        <p>Select Items</p>

        @foreach ($drycleans as $item)
        <div style="display:inline-block;width:100%">
            <b><p class="pull-left" >{{$item->description}}</p></b>
        <select data-id="{{$item->id}}" class="select-dryclean pull-right">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>

        @endforeach


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="submit" data-dismiss="modal">Submit</button>
      </div>
    </div>

  </div>
</div>

<input type="hidden" name="drycleaning">
<input type="hidden" name="total">

<input type="submit" class="btn btn-primary" value="submit">

<a href="{{ route('staff.laundrylogs.index') }}" class="btn btn-default" >Cancel</a>

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
     format: 'yyyy-mm-dd',
});


$(document).ready(function(){

var totall = $('#overcharged').val();
            $('#totalll').text(totall)

    $('#username').bind('keyup change',function(){
        var username = $(this).val();
        // alert(username)
        $.ajax({
            type:"get",
            url:"{{ route('staff.laundrylogs.getorderdetails') }}",
            data:{username:username},
            success:function(result){
                // console.log(result);
                if(result.length < 1){
                    alert('No plan is selected by this user!')
                }
                $('#weight_plan').val(result.weight)
                $('#orderdetails_id').val(result.id)
                // $('#username').val(result.username)
            }
        })
    })

    $('#weight_received').keyup(function(){

        var weightplan = $('#weight_plan').val();
            if(weightplan == ''){
                return alert('Please select Order first')
            }

        var weightreceived = $(this).val();

        var difference = weightreceived - weightplan;
        // console.log(difference);
         $('#overweight').val(0)
        if(difference > 0){
            var overcharge = difference*1.99;
            $('#overweight').val(difference)
            $('#overcharged').val(overcharge);

            // alert(overcharge)
            // alert(($('#totalll').text()))
            if($('#totalll').text() != ''){
                var pervious = parseInt($('#totalll').text());
            }else{
                var pervious = 0;
            }

            var totall = overcharge + pervious
            $('#totalll').text(totall.toFixed(2))

            
             $('input[name="total"]').val(totall.toFixed(2))
        }else{
            $('#totalll').text(0)

            $('input[name="total"]').val(0)
        }


    })

    var array = [];
    var arrayquantity = [];

    $('#select-items').click(function(){
        var array = [];
        var arrayquantity = [];
      //  console.log($('.select-dryclean').val('0'));
    })

    $('.select-dryclean').change(function(){

      // console.log(array)

        var drycleaning_id = $(this).data('id');
        var drycleaning_quantity = $(this).val();
        if(drycleaning_quantity == 0){
          return false;
        }

        array.push(drycleaning_id+ '-'+drycleaning_quantity);
        // arrayquantity.push(drycleaning_quantity);

        var previous_ids = $('input[name="drycleaning"]').val(array);
        // var previous_quantity = $('input[name="drycleaning"]').attr('data-quantity',arrayquantity);

    })

    $('#submit').click(function(){
      array = [];
        var data = $('input[name="drycleaning"]').val()
        $.ajax({
          url:"{{ route('staff.getDrycleanTotal') }}",
          type:"get",
          data:{data:data},
          success: function(result){

            $('#appendDataDiv').html(`
                <label for="name">Dryclean:</label>
                    <br>
                <button type="button" class="btn btn-info" id="select-items" data-toggle="modal" data-target="#myModal">Select Dry Clean Items</button>
            `)

            $('#select-items').click(function(){
                var array = [];
                var arrayquantity = [];
              // console.log($('.select-dryclean').val('0'));
            })

            var length = result.description.length

            for(var i=0;i<length;i++){
                $('#appendDataDiv').append(`
            <li style="margin: 10px;">`+ result.description[i] +`   *    `+ result.quantity[i]  +`      </li>
                `)
            }

            var totall = result.total + parseInt($('#totalll').text());
            console.log(result.total)
            console.log($('#totalll').text())


                $('#totalll').text(totall)
                $('input[name="total"]').val(totall)
          }
        })


    })

})

</script>
<script type="text/javascript">
$(document).ready(function() {
    $("#orderdetails_id").change(function(){
        //alert($(this).val());
       // ("#orderdetails_ids").val($(this).val());
      orderdetails_id =  $(this).val();
     // orderdetails_id = 1
     window.location.href = "?orderdetails_id="+orderdetails_id; 
           
        
});
});
</script>
@endsection
