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
  {{-- <a href="{{ route('transactions.indexDateBetween') }}" class="btn @if(\Request::segment(3) == 'custom') btn-primary @endif pull-right mt-20">Check Manually</a> --}}
<?php //dd(Request()->type); ?>

  @if(\Auth::user()->type == 'ADMIN')
    <a href="{{ route('transactions.index',['type'=>'yearly']) }}" class="btn @if(Request()->type == 'yearly') btn-primary @endif pull-right mt-20">This Year</a>

    <a href="{{ route('transactions.index',['type'=>'monthly']) }}" class="btn @if(Request()->type == 'monthly') btn-primary @endif pull-right mt-20">This Month</a>

  <a href="{{ route('transactions.index',['type'=>'today']) }}" class="btn @if(Request()->type == 'today') btn-primary @endif pull-right mt-20">Today's Transactions</a>


  <a href="{{ route('transactions.index') }}" class="btn @if(Request()->type == '') btn-primary @endif  pull-right mt-20">All Transactions</a>
  </div>
  @else
     <a href="{{ route('staff.transactions.index',['type'=>'yearly']) }}" class="btn @if(Request()->type == 'yearly') btn-primary @endif pull-right mt-20">This Year</a>

    <a href="{{ route('staff.transactions.index',['type'=>'monthly']) }}" class="btn @if(Request()->type == 'monthly') btn-primary @endif pull-right mt-20">This Month</a>

  <a href="{{ route('staff.transactions.index',['type'=>'today']) }}" class="btn @if(Request()->type == 'today') btn-primary @endif pull-right mt-20">Today's Transactions</a>


  <a href="{{ route('staff.transactions.index') }}" class="btn @if(Request()->type == '') btn-primary @endif  pull-right mt-20">All Transactions</a>
  @endif
  <div class="clearfix"></div>
  <div class="pull-right">

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
        <th>Date</th>
        <th>Name</th>
        <th>School Name</th>
        <th>Plan</th>
        <th>Total amount</th>
        <th>View</th>
      </tr>
    </thead>
    <tbody>
        @php $j = 1; @endphp
      @foreach ($data as $details)

      <?php 
        // echo "<pre>"; print_r($details->plan->description);die();
      ?>
      <tr>
        <td>{{$j++}}</td>
        <td>{{date('Y-m-d',strtotime($details->created_at))}}</td>
        <td>{{$details->user->first_name.' '.$details->user->last_name }}</td>
        <td>{{$details->user->school['school_name']}}</td>
        <td>
             
            @if(isset($details->plan->description) && !empty($details->plan->description))
              {{ $details->plan->description }}
            @endif
        </td>
        <td>$
            {{$details->total_amount}}
        </td> 

        @if(\Auth::user()->type == 'ADMIN')
        <td>
            <a href="{{ route('transactions.view', $details->id) }}"> <i class="mdi mdi-eye text-default"></i> </a>&nbsp;
            <a href="{{ route('transactions.charge', $details->id) }}"> <i class="mdi mdi-currency-usd text-default"></i> </a>&nbsp;
            </td>
          @else
            <td>
            <a href="{{ route('staff.transactions.view', $details->id) }}"> <i class="mdi mdi-eye text-default"></i> </a>&nbsp;
            <a href="{{ route('staff.transactions.charge', $details->id) }}"> <i class="mdi mdi-currency-usd text-default"></i> </a>&nbsp;
            </td>
          @endif
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
