
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
    
  @if(isset($order->id))

    <form class="form-material" action="{{ route('laundrylogs.create') }}" method="post" enctype="multipart/form-data">
   
    {!! csrf_field() !!}

    <div class="form-group">
    <label for="name">Order:</label><br>
      <select class="form-control" id="orderdetails_id" name="orderdetails_id">
          <option value="" disabled selected>Please select Order</option>

      @foreach ($orders as $order)

      <option value="{{ $order->id }}"  @if(@$order_details->id == $order->id) {{'selected'}} @endif>{{ $order->userdetails->first_name.' '.$order->userdetails->last_name }}</option>

      @endforeach

      </select>
      <br>
      @if($errors->first('service'))
      <span class="text text-danger">* {{ $errors->first('service') }}</span>
      @endif
      </div>

      <div class="form-group">
      <label for="name">Date:</label>
      <input type="text"  class="form-control " id="date" placeholder="Enter date" name="date" value="<?php echo date("Y-m-d"); ?>" readonly>

      </div>




      <div class="form-group">
      <label for="name">User:</label><br>
      <input type="text"  class="form-control" name="username" value="@if(isset($order_details->user->username)){{ $order_details->user->username }}@endif" readonly>
      <br>



      </div>

      <div class="form-group">
      <label for="name">Weight Plan(in lbs):</label>
      <input type="text"  class="form-control" id="weight_plan"  name="weight_plan" value="{{ $laundrylogsdata->weight_plan}}" readonly>
      </div>

      <div class="form-group">
      <label for="name">Weight Received:</label>
      <input type="text" disabled="" max="50" min="1"  class="form-control allow_decimal" id="weight_received" placeholder="Enter weight received" name="weight_received" value="{{ $laundrylogsdata->weight_received}}">
      <input type="hidden" name="weightovercharged" class="weightovercharged" id="weightovercharged" value="{{ $overweightcharge->charge}}">
      @if($errors->first('weight_received'))
      <span class="text text-danger">* {{ $errors->first('weight_received') }}</span>
      @endif
      </div>

      <div class="form-group">
      <label for="name">Over Weight:</label>
      <input type="text" readonly=""  class="form-control" id="overweight" placeholder="Enter overweight" name="overweight" value="{{ $laundrylogsdata->overweight}}">
      @if($errors->first('overweight'))
      <span class="text text-danger">* {{ $errors->first('overweight') }}</span>
      @endif
      </div>

      <div class="form-group">
      <label for="name">Over Charged:</label>
      <input type="text"  class="form-control" readonly="" id="overcharged" placeholder="Enter overcharged" name="overcharged" value="{{ $laundrylogsdata->overcharged}}">
      @if($errors->first('overcharged'))
      <span class="text text-danger">* {{ $errors->first('overcharged') }}</span>
      @endif
      </div>
      <div class="form-group">
      <label for="name">Comment:</label>
      <input type="text" maxlength="250" class="form-control" readonly="" id="comment" placeholder="Enter comment" required="" name="comment" value="@if(isset($laundrylogsdata->comments)){{ $laundrylogsdata->comments }}@else{{ old('comment')}}@endif">
      @if($errors->first('comment'))
      <span class="text text-danger">* {{ $errors->first('comment') }}</span>
      @endif
      </div>

      <div class="form-group">
        <label for="name">Image:</label><br>
        @if(isset($laundrylogsdata->image))
          <img id="blah" src="{{ $laundrylogsdata->image }}" alt="your image" width="150" height="150">
        @else
          <img id="blah" src="{{asset('images/preview-icon.png')}}" alt="your image" width="150" height="150">
        @endif
        <br><br>
        
      @if($errors->first('image'))
      <span class="text text-danger">* {{ $errors->first('image') }}</span>
      @endif
      </div>

  </form>
  @else


  @if(isset($data->id))
    <h2>Edit Laundry Log</h2>
    @else
    <h2>New Laundry Log</h2>
    @endif
  @if(isset($data->id))
    <form class="form-material" action="{{ route('laundrylogs.update',$data->id) }}" method="post" enctype="multipart/form-data">
    @else
   <form class="form-material" action="{{ route('laundrylogs.create') }}" method="post" enctype="multipart/form-data">
  @endif
    {!! csrf_field() !!}

    <div class="form-group">
      <label for="name">Order:</label><br>
        <select class="form-control" id="orderdetails_id" name="orderdetails_id">
            <option value="" disabled selected>Please select Order</option>

        @foreach ($orders as $order)

        <option value="{{ $order->id }}"  @if(@$order_details->id == $order->id) {{'selected'}} @endif>{{ $order->userdetails->first_name.' '.$order->userdetails->last_name }}</option>

        @endforeach

        </select>
<br>
    @if($errors->first('service'))
    <span class="text text-danger">* {{ $errors->first('service') }}</span>
    @endif
    </div>

    <div class="form-group">
      <label for="name">Date:</label>
      <input type="text"  class="form-control " id="date" placeholder="Enter date" name="date" value="<?php echo date("Y-m-d"); ?>" readonly>
    
    </div> 
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
      <input type="text" max="50" min="1"  class="form-control allow_decimal" id="weight_received" placeholder="Enter weight received" name="weight_received" value="@if(isset($data->weight_received)){{$data->weight_received}}@else{{old('weight_received')}}@endif">
      <input type="hidden" name="weightovercharged" class="weightovercharged" id="weightovercharged" value="{{ $overweightcharge->charge}}">
    @if($errors->first('weight_received'))
    <span class="text text-danger">* {{ $errors->first('weight_received') }}</span>
    @endif
    </div>

    <div class="form-group">
      <label for="name">Over Weight:</label>
      <input type="text" readonly=""  class="form-control" id="overweight" placeholder="Enter overweight" name="overweight" value="@if(isset($data->overweight)){{ $data->overweight }} @else {{ old('overweight')}} @endif">
    @if($errors->first('overweight'))
    <span class="text text-danger">* {{ $errors->first('overweight') }}</span>
    @endif
    </div>

    <div class="form-group">
      <label for="name">Over Charged:</label>
      <input type="text"  class="form-control" readonly="" id="overcharged" placeholder="Enter overcharged" name="overcharged" value="@if(isset($data->overcharged)){{ $data->overcharged }} @else {{ old('overcharged')}}  @endif">
    @if($errors->first('overcharged'))
    <span class="text text-danger">* {{ $errors->first('overcharged') }}</span>
    @endif
    </div>
    <div class="form-group">
      <label for="name">Comment:</label>
      <input type="text" maxlength="250" class="form-control" readonly="" id="comment" placeholder="Enter comment" required="" name="comment" value="@if(isset($data->comment)){{ $data->comment }}@else{{ old('comment')}}@endif">
    @if($errors->first('comment'))
    <span class="text text-danger">* {{ $errors->first('comment') }}</span>
    @endif
    </div>

    <div class="form-group">
        <label for="name">Image:</label><br>
        @if(isset($data->image))
          <img id="blah" src="{{ $data->image }}" alt="your image" width="150" height="150">
        @else
          <img id="blah" src="{{asset('images/preview-icon.png')}}" alt="your image" width="150" height="150">
        @endif
        <br><br>
        <input type="file" accept="image/*" required=""  class="form-control" readonly="" id="upload_image" name="upload_image">
      @if($errors->first('image'))
      <span class="text text-danger">* {{ $errors->first('image') }}</span>
      @endif
      </div>

    <div class="form-group" id="appendDataDiv">
      <label for="name">Dryclean:</label>
      <br>
        <button type="button" class="btn btn-info" id="select-items" data-toggle="modal" data-target="#myModal">Select Dry Clean Items</button>

    </div>
    <li style="margin: 10px;"><b><u> Final Charge $<span id="totalll">0</span> </u></b></li>

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
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
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

<a href="{{ route('laundrylogs.index') }}" class="btn btn-default" >Cancel</a>

</form>
@endif
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

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#upload_image").change(function() {
  readURL(this);
});

</script>

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
            $('#totalll').text(totall);

    $('#username').bind('keyup change',function(){
        var username = $(this).val();
        // alert(username)
        $.ajax({
            type:"get",
            url:"{{ route('laundrylogs.getorderdetails') }}",
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

         //console.log(weightplan);
        var difference = weightreceived - weightplan;
        // alert(difference);
        // return false;
         $('#overweight').val(0)
         $('#overcharged').val(0)
        if(difference > 0){
          $("#comment").attr("readonly", false);
          $("#image").attr("readonly", false);
          var overweightcharge = "{{ $overweightcharge->charge }}";
            console.log(overweightcharge); 
            //return false;
            var overcharge = difference*overweightcharge;
            // var overcharged = overcharge.toFixed(2);
            $('#overweight').val(difference.toFixed(1))
            $('#overcharged').val(overcharge.toFixed(1));

            // alert(overcharge)
            // alert(($('#totalll').text()))
            if($('#totalll').text() != ''){
                var pervious = parseInt($('#totalll').text());
            }else{
                var pervious = 0;
            }

            var totall = overcharge 
            $('#totalll').text(totall.toFixed(1))

            $('input[name="total"]').val(totall.toFixed(1))
        }else{
            $('#totalll').text('0')

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
          url:"{{ route('getDrycleanTotal') }}",
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

      orderdetails_id =  $(this).val();
      window.location.href = "?orderdetails_id="+orderdetails_id; 
           
        
});
});
</script>
@endsection
