@extends('layouts.app')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<div class="container-fuild">
    <div class="card">
    <div class="card-body">
    <div style="display: flow-root;">
    <h2 class="pull-left">Manage Building</h2>
  <a href="{{route('buildings.single')}}" class="btn btn-primary pull-right mt-20">Add Building</a>
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
        <th>School Name</th>
        <th>Building</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @php $j =  1;
        @endphp
      @foreach ($data as $details)
       
        <tr>
        <td>{{$j++}}</td>
        <td>{{$details->school->school_name }} </td>
        <td>{{$details->building }} </td>
        <td>
            <a href="{{ route('buildings.editForm', $details->id) }}"> <i class="mdi mdi-account-edit   text-default"></i> </a>&nbsp;&nbsp;&nbsp;
            <a class="delete" href="{{ route('buildings.delete', $details->id) }}"><i class="icon-trash text-default"></i> </a>
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


@endsection
