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
  <a href="{{ route('transactions.indexDateBetween') }}" class="btn btn-blue pull-right mt-20">Check Manually</a>

  <a href="{{ route('transactions.indexDaily') }}" class="btn btn-primary pull-right mt-20">Today's Transactions</a>
  <a href="{{ route('transactions.index') }}" class="btn btn-blue pull-right mt-20">All Transactions</a>
</div>
  <div class="clearfix"></div>
  <div class="pull-right">
    <a href="#" class="btn btn-blue pull-right mt-20">
        <span>Closing balance</span><br>
    ${{$closing_admin_commission}}</a>
    <a href="#" class="btn btn-blue pull-right mt-20">
        <span>Opening balance</span><br>
    ${{$opening_admin_commission}}</a>
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
<script>

  $('#myTable').DataTable();

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
})
</script>

@endsection
