@extends('layouts.app')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<div class="container-fuild">
    <div class="card">
    <div class="card-body">
    <div style="display: flow-root;">
    <h2 class="pull-left">Manage Orders</h2>

<a href="{{route('staff.orders.all',['type'=>'storage'])}}" class="btn @if(\Request::segment(3) == 'storage') btn-primary @endif pull-right mt-20"> Storage Orders </a>
<a href="{{route('staff.orders.all',['type'=>'housekeeping'])}}" class="btn @if(\Request::segment(4) == 'housekeeping') btn-primary @endif  pull-right mt-20" style="margin-right: 5px;"> HouseKeeping Orders </a>
<a href="{{route('staff.orders.all',['type'=>'laundry'])}}" class="btn @if(\Request::segment(4) == 'laundry') btn-primary @endif pull-right mt-20" style="margin-right: 5px;"> Laundry Orders </a>
<a href="{{route('staff.orders.all')}}" class="btn @if(\Request::segment(4) == '') btn-primary @endif pull-right mt-20" style="margin-right: 5px;"> All Orders </a>


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

  <table class="table" id=myTable>
    <thead>
      <tr>
        <th>S.no</th>
        <th>Date</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>School</th>
        <th>Service</th>
        <th>Plan</th>
        <th width="200px">Order Status</th>
        <th>Action</th>
        
      </tr>
    </thead>
    <tbody>
        @php $j =  1; @endphp
      @foreach ($data as $details)
        <tr>
        <td>{{$j++}}</td>
        <td>{{ $details->order_date.' '.$details->order_time}} </td>
        <td>{{ $details->user->first_name}} </td>
        <td>{{ $details->user->last_name}} </td>
        <td>{{ $details->user->school_name }}</td>
        <td>{{ $details->service  }}</td>
        <td>
            
            {{ @$details->plan->description  }}
            
        </td>
        <td >
          <select class="form-control orderstatus" data-id="{{ $details->id }}" style="height: auto; width:100px" >
            <option value="0" disabled="" @if($details->order_status == '0'){{ 'selected' }}@endif  >New Order</option>
            <option value="1" @if($details->order_status == '1'){{ 'selected' }}@endif >Inprogress</option>
            <option value="2" @if($details->order_status == '2'){{ 'selected' }}@endif >Completed</option>
            <option value="3" @if($details->order_status == '3'){{ 'selected' }}@endif >Cancel</option>
        </select>

        </td>
        <td>
            <a href="{{ route('staff.orders.view', $details->id) }}"> <i class="mdi mdi-eye   text-default"></i> </a>&nbsp;&nbsp;&nbsp;
            <a class="delete" href="{{ route('staff.orders.single.delete', $details->id) }}"><i class="icon-trash text-default"></i> </a>
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
          setTimeout(function(){  $(".hideClass").hide('slow'); },4000);
    })
</script>

<script>

    $(document).on('change','.orderstatus',function(){
       orderstatus =  $('.orderstatus').val();
         
        var id = $(this).data('id');
          var accept_status = $(this).val();
        if (!confirm("Are you sure want to change status?")) {
              $(this).val(orderstatus); //set back
              return;                  //abort!
          }  
          console.log(id,accept_status);
          $.ajax({
              type:"get",
              url: "{{route('staff.orders.updateStatus')}}",
              data:{id:id,accept_status:accept_status},
              success:function(result){
                  // location.reload();
                  console.log(result.status)
                  orderstatus =accept_status;
                  window.location.reload(true);
              }
          }) 
    })
    $(document).ready(function(){
          //setTimeout(function(){  $(".hideClass").hide('slow'); },4000);


    });
</script>



@endsection
