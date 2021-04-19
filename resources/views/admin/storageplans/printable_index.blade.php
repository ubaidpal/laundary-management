@extends('layouts.app')

@section('content')
<div class="container-fuild">
    <div class="card">
    <div class="card-body">
    <div>
  <h2 class="pull-left">Manage Storage Plans</h2>
     
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

  <table class="table" id="myTable">
    <thead>
      <tr>
        <th>S.no</th>
        <th>Plan</th>
        <th>Price($)</th>
        <th>Status</th> 
      </tr>
    </thead>
    <tbody>
        @php $j = 1; @endphp
      @foreach ($data as $details)
        <tr>
        <td>{{$j++}}</td>
        <td>{{$details->description}}</td>
        <td>{{$details->price}}</td>
       <td>@if($details->status == 1)<a href="{{ route('storageplans.status',[$details->id,0]) }}" class="text-success">{{ 'Activated' }}</a> @else <a href="{{ route('storageplans.status',[$details->id,1]) }}" class="text-danger"> {{ 'Inactived' }} </a> @endif</td>
         
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
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<script>

  $('#myTable').DataTable({
    info: false,
    paging: false,
    sort: true,
      dom: 'Bfrtip',
      buttons: [
          {
              extend: 'print',
              title: 'Manage Storage Plans',  
              footer: 'true',
              autoPrint: 'false', 
          }
      ]
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
