@extends('layouts.app')

@section('content')

<style>
  .w35{
    width: 35%;
  }
  .message{
    width: 50%;
    margin: 20px;
    margin-left: 0px;
  }

</style>

<div class="container-fuild">
  <div class="card">
    <div class="card-body">
    <div>
  <h2 class="pull-left">Manage Transactions</h2>
  <a href="{{ route('transactions.indexDateBetween') }}" class="btn btn-primary pull-right mt-20">Check Manually</a>

  <a href="{{ route('transactions.indexDaily') }}" class="btn btn-blue pull-right mt-20">Today's Transactions</a>
  <a href="{{ route('transactions.index') }}" class="btn btn-blue pull-right mt-20">All Transactions</a>
</div>

  <div class="clearfix"></div>
  <div class="pull-right">
    <form class="form-material" action="{{ route('transactions.check') }}" method="post">
      {!! csrf_field() !!}
     <div class="row">


    <div class="form-group col-md-5">
      <label for="transactionFrom">Transaction From:</label>
    <input required="" type="text" class="mydatepicker form-control "  name="transactionFrom" value="{{$transactionFrom ?? ''}}">

    </div>
    <div class="form-group col-md-5">
      <label for="transactionTo">Transaction To:</label>
    <input required="" type="text" class="mydatepicker form-control "  name="transactionTO" value="{{$transactionTO ?? ''}}">

    </div>
    <div class="form-group col-md-2">
      <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Check</button>

    </div>

    </div>
  </form>
  </div>
  <br>
  @if(Session::has('success'))
  <div class="message alert alert-success hideClass" style="padding:5px;width:50%">
    {{ Session::get('success')  }}
  </div>
  @endif
    @if(Session::has('error'))
  <div class="message alert alert-danger hideClass"  style="padding:5px;width:50%">
    {{ Session::get('error')  }}
  </div>
  @endif

  <table class="table" id="myTable">
    <thead>
      <tr>
        <th>S.no</th>
        <th>Customer Name</th>
        <th>Restaurant Name</th>
        {{-- <th>Admin Amount</th>
        <th>Total Amount</th>
        <th>Payment Type</th>
        <th>payment Date</th> --}}
        <th>Transaction Id</th>
        <th>View</th>
      </tr>
    </thead>
    <tbody>
        @php $j = 1; @endphp
      @foreach ($data as $details)
        <tr>
        <td>{{$j++}}</td>
        <td>{{$details->order->user->name}}</td>
        <td>{{$details->order->restaurant->name}}</td>
        {{-- <td>{{$details->admin_commission}}</td>
        <td>{{$details->total_amount}}</td>
        <td>{{$details->payment_type}}</td>
        <td>{{$details->created_at}}</td> --}}
        <td>{{$details->transaction_id}}</td>
        <td>
            <a href="{{ route('transactions.view', $details->id) }}"> <i class="mdi mdi-eye text-default"></i> </a>&nbsp;
            </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  {{-- <span class="mr-15 mt-10 pull-right">{{ $data->links() }}</span> --}}

</div>
  </div>
</div>

<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<link href="{{asset('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">

<script src="{{asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
<script src="{{asset('assets/plugins/moment/moment.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>

<script src="{{asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>




<script>

  $('#myTable').DataTable();

jQuery('.mydatepicker, #datepicker').datepicker({
    format: 'yyyy/mm/dd',
});

$(document).ready(function(){
    $('.delete').click(function(){
        var r = confirm("Are you sure!");
        if (r == true) {
            return true;
        } else {
            return false;
        }
    });

    setTimeout(function(){  $(".hideClass").hide('slow'); },4000);
});


</script>

@endsection
