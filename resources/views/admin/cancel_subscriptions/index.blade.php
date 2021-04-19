@extends('layouts.app')

@section('content')
<style>
  .show-read-more .more-text{
        display: none;
    }
    table.dataTable, table.dataTable th, table.dataTable td {
    box-sizing: content-box !important;
    word-break: normal !important;
}

</style>
<div class="container-fuild">
    <div class="card">
    <div class="card-body">
    <div>
  <h2 class="pull-left">Manage Cancelations</h2>
   
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
        <th>Reason</th>
        <th>Description</th>
        <th>Username</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @php $j = 1; @endphp
      @foreach ($data as $details)
        <tr>
        <td>{{$j++}}</td>
        <td>{{$details->reason}}</td>
        <td class="show-read-more">{{$details->description}}</td>
        <td>{{$details->subscription->user->username}}</td>
        @if(\Auth::user()->type == 'ADMIN')
        <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('subscription.view', $details->id) }}"> <i class="mdi mdi-eye text-default"></i> </a>&nbsp;&nbsp;&nbsp;
            {{-- <a class="delete" href="{{ route('laundryplans.delete', $details->id) }}"><i class="icon-trash text-default"></i> </a> --}}
        </td>
        @else<td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('staff.subscription.view', $details->id) }}"> <i class="mdi mdi-eye text-default"></i> </a>&nbsp;&nbsp;&nbsp;
            {{-- <a class="delete" href="{{ route('laundryplans.delete', $details->id) }}"><i class="icon-trash text-default"></i> </a> --}}
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
              title: 'Manage Fees',  
              footer: 'true',
              autoPrint: 'false', 
              exportOptions: {
                    columns: [ 0, 1,2,3]
                } 
          },
           
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
<script>
$(document).ready(function(){
    var maxLength = 50;
    $(".show-read-more").each(function(){
        var myStr = $(this).text();
        if($.trim(myStr).length > maxLength){
            var newStr = myStr.substring(0, maxLength);
            var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
            $(this).empty().html(newStr);
            $(this).append(' <a href="javascript:void(0);" class="read-more">Read more...</a>');
            $(this).append('<span class="more-text">' + removedStr + '</span>');
        }
    });
    $(".read-more").click(function(){
        $(this).siblings(".more-text").contents().unwrap();
        $(this).remove();
    });
});
</script>
@endsection
