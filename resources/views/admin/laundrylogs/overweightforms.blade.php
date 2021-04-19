
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
    <h2>Edit overcharge</h2>
    @else
    <h2>Add overcharge</h2>
    @endif
  @if(isset($data->id))
<form class="form-material" action="{{ route('laundrylogs.overweightupdate',$data->id) }}" method="post" enctype="multipart/form-data">
    @else
   <form class="form-material" action="{{ route('laundrylogs.overweightcreate') }}" method="post">
    @endif
    {!! csrf_field() !!} 

    <div class="form-group">
      <label for="name">lbs:</label>
      <input type="text"  readonly="" class="form-control" id="lbs_item"  name="lbs_item" value="@if(isset($data->lbs_per_item)){{$data->lbs_per_item }}@else{{old('lbs_item')}}@endif" placeholder="Enter lbs">
      @if($errors->first('lbs_item'))
        <span class="text text-danger">* {{ $errors->first('lbs_item') }}</span>
      @endif
    </div> 

    <div class="form-group">
      <label for="name">Over Charged:</label>
      <input type="text" min="1"  class="form-control allow_decimal" id="overcharged" placeholder="Enter overcharged" name="overcharged" value="@if(isset($data->charge)){{ $data->charge }}@else{{old('overcharged')}}@endif">
    @if($errors->first('overcharged'))
    <span class="text text-danger">* {{ $errors->first('overcharged') }}</span>
    @endif
    </div> 

<input type="hidden" name="drycleaning">
<input type="hidden" name="total">

<input type="submit" class="btn btn-primary" value="submit">

<a href="{{ route('laundrylogs.overweightindex') }}" class="btn btn-default" >Cancel</a>

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
        //alert(difference);
         $('#overweight').val(0)
         $('#overcharged').val(0)
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
        //alert($(this).val());
       // ("#orderdetails_ids").val($(this).val());
      orderdetails_id =  $(this).val();
     // orderdetails_id = 1
     window.location.href = "?orderdetails_id="+orderdetails_id; 
           
        
});
});
</script>
@endsection
