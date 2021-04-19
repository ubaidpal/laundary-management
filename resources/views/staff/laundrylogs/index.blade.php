@extends('layouts.app')

@section('content')
<div class="container-fuild">
    <div class="card">
    <div class="card-body">
    <div>
  <h2 class="pull-left">Manage Laundry logs</h2>
    <a href="{{ route('staff.laundrylogs.single') }}" class="btn btn-primary pull-right mt-20">Add Log</a>
    </div>
    <div class="clearfix"></div>
  <div class="pull-right">

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
 <a href="{{ route('staff.laundrylogs.export') }}" class="btn btn-primary mt-20">Export Data</a>
  <table class="table" id="myTable">
    <thead>
      <tr>
        <th>S.no</th>
        <th>Name</th>
        <th>Weight received</th>
        <th>Weight plan</th>
        <th>Overweight</th>
        <th>Overages</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @php $j = 1; @endphp
      @foreach ($data as $details)
        <tr>
        <td>{{$j++}}</td>
        <td>{{$details->order->user->first_name.' '.$details->order->user->last_name}}</td>
        <td>{{$details->weight_received}}lbs</td>
        <td>{{$details->weight_plan}}lbs</td>
        <td>{{$details->overweight}}lbs</td>
        <td>${{$details->total}}</td>

        <td>
            {{-- <a href="{{ route('staff.laundrylogs.showupdate', $details->id) }}"> <i class="mdi mdi-account-edit text-default"></i> </a>&nbsp;&nbsp;&nbsp; --}}
            <a class="delete" href="{{ route('staff.laundrylogs.delete', $details->id) }}"><i class="icon-trash text-default"></i> </a>
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
});
</script>

@endsection
