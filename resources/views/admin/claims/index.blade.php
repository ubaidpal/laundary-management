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
    .pt10{
      padding-top: 10px;
    }
      body {font-family: Arial, Helvetica, sans-serif;}
  * {box-sizing: border-box;}

  /* Set a style for all buttons */
  button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
  }

  button:hover {
    opacity:1;
  }

  /* Float cancel and delete buttons and add an equal width */
  .cancelbtn, .deletebtn {
    float: left;
    width: 50%;
  }

  /* Add a color to the cancel button */
  .cancelbtn {
    background-color: #ccc;
    color: black;
  }

  /* Add a color to the delete button */
  .deletebtn {
    background-color: #f44336;
  }

  /* Add padding and center-align text to the container */
  .container {
    padding: 16px;
    text-align: center;
  }

  /* The Modal (background) */
  .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: #474e5d;
    padding-top: 50px;
  }

  /* Modal Content/Box */
  .modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 40%; /* Could be more or less, depending on screen size */
  }

  /* Style the horizontal ruler */
  hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
  }
   
  /* The Modal Close Button (x) */
  .close {
    position: absolute;
    right: 35px;
    top: 15px;
    font-size: 40px;
    font-weight: bold;
    color: #f1f1f1;
  }

  .close:hover,
  .close:focus {
    color: #f44336;
    cursor: pointer;
  }

  /* Clear floats */
  .clearfix::after {
    content: "";
    clear: both;
    display: table;
  }
  .modal-backdrop {
          position: relative !important; 
  }
  /* Change styles for cancel button and delete button on extra small screens */
  @media screen and (max-width: 300px) {
    .cancelbtn, .deletebtn {
       width: 100%;
    }
  }

</style>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<div class="container-fuild">
    <div class="card">
    <div class="card-body">
    <div style="display: flow-root;">
    <h2 class="pull-left">Manage Claims</h2>
{{--
<a href="{{route('orders.storage')}}" class="btn @if(\Request::segment(3) == 'storage') btn-primary @endif pull-right mt-20"> Storage Orders </a>
<a href="{{route('orders.housekeep')}}" class="btn @if(\Request::segment(3) == 'housekeeping') btn-primary @endif  pull-right mt-20" style="margin-right: 5px;"> HouseKeeping Orders </a>
<a href="{{route('orders.laundry')}}" class="btn @if(\Request::segment(3) == 'laundry') btn-primary @endif pull-right mt-20" style="margin-right: 5px;"> Laundry Orders </a>
<a href="{{route('orders.all')}}" class="btn @if(\Request::segment(3) == 'all') btn-primary @endif pull-right mt-20" style="margin-right: 5px;"> All Orders </a>
 --}}

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
        <th>Order Id</th>
        <th>User Name</th>
        <th>Service</th>
        <th>Date Filed</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @php $j =  1; @endphp
      @foreach ($data as $details)
        <tr>
        <td>{{$j++}}</td>
        <td>ORD{{ $details->order->id}} </td>
        <td>{{ $details->user->first_name .' '. $details->user->last_name }} </td>
        <td>{{ $details->service }} </td>
        <td>{{ $details->date_filed }}</td>
        @if(\Auth::user()->type == 'ADMIN')
        <td>
            <select class="orderstatus" id="updatestatus" data-id="{{ $details->id }}">
                <option value="0" @if($details->status == '0'){{ 'selected' }} @endif>Pending</option>
                <option value="1" @if($details->status == '1'){{ 'selected' }} @endif>Resolved</option>
            </select>
        </td>
        <td>
            <a href="{{ route('claims.view', $details->id) }}"> <i class="mdi mdi-eye   text-default"></i> </a>&nbsp;&nbsp;&nbsp;
            <a class="delete deleteuserbutton" href="javascript:void(0)" data-userid="{{$details->id}}" data-url="{{ route('claims.delete') }}"><i class="icon-trash text-default"></i> </a>
        </td>
        @else
        <td>
            <select class="orderstatus" id="updatestatus" data-id="{{ $details->id }}">
                <option value="0" @if($details->status == '0'){{ 'selected' }} @endif>Pending</option>
                <option value="1" @if($details->status == '1'){{ 'selected' }} @endif>Resolved</option>
            </select>
        </td>
        <td>
            <a href="{{ route('staff.claims.view', $details->id) }}"> <i class="mdi mdi-eye   text-default"></i> </a>&nbsp;&nbsp;&nbsp;
            <a class="delete deleteuserbutton" href="javascript:void(0)" data-userid="{{$details->id}}" data-url="{{ route('staff.claims.delete') }}"><i class="icon-trash text-default"></i> </a>
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
<!-- Modal -->  
  <div id="id03" class="modal">
    <!-- <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal"></span> -->
    <form class="modal-content" action="" id="deleteuserform" method="post">
      @csrf
      <div class="container">
        <!-- <h1>Account active</h1> -->
        <p>Are you sure you want to delete this claim?</p> 
        <div class="form-group">
          <label for="name">Password:</label>
          <input type="password" required="" class="form-control " id="delete_user_password" placeholder="Enter password" name="password">
          <span class="text text-danger" id="delete_password_error"></span> 
        </div>
        <input type="hidden" id="delete_user_id" name="user_id" value=""> 
        <input type="hidden" id="delete_url" name="url" value=""> 
        <button type="button" class="cancelbtn cancelbtn3">Cancel</button>
        <button name="submit" class="deletebtn" id="deletebtn">Delete</button>
      </div>
    </form>
  </div>
<!-- modal end---->
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script> 
  // Delete account user
    $(document).on('click','.deleteuserbutton',function(e){ 
      e.preventDefault();
      var userId = $(this).attr('data-userid'); 
      var url = $(this).attr('data-url'); 
      $('#delete_url').val(url);
      $('#delete_user_id').val(userId); 
      $('#id03').modal('show'); 
    });  
    $(document).on('click','.cancelbtn3',function(e){ 
        e.preventDefault();
        $('#id03').modal('hide'); 
    });

    $(document).ready(function(){
      $('#deleteuserform').on('submit',function(event){ 
        event.preventDefault();
        var url = $('#delete_url').val();
        var user_id = $('#delete_user_id').val(); 
        var password = $('#delete_user_password').val();
        var formData = $(this).serialize(); 
        $.ajax({
          type:'POST',
          url: url, 
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data:formData,
          success:function(data){
            
            if (data.status == false) { 
              $('#delete_password_error').text("Invalid password");
              $('#delete_password_error').css('display','block');
            }else{
              swal({ 
                  button: false,
                  text: "Claim deleted successfully"
              }); 
              window.setTimeout(function(){ 
                  location.reload();
              } ,1500);
            } 
              
          },error:function(){
            alert('wrong')
          }
        }); 
      });
    });
  //End here 
</script>
<script>

  $('#myTable').DataTable();

    $(document).ready(function(){
          setTimeout(function(){  $(".hideClass").hide('slow'); },4000);
    })
</script>

<script>

    $(document).on('change','.orderstatus',function(){

      
            var id = $(this).data('id');
            var claim_status = $(this).val();
            $.ajax({ 
                type:"get",
                url: "{{route('claims.updateStatus')}}",
                data:{id:id,claim_status:claim_status},
                success:function(result){
                    location.reload();
                    // console.log(result)
                }
            })
         
    });
    $(document).ready(function(){
          setTimeout(function(){  $(".hideClass").hide('slow'); },4000);

        

        $('#resolutionorder').change(function(){
            var id = $(this).data('id');
            var resolution = $(this).val();
            $.ajax({ 
                type:"get",
                url: "{{route('claims.resolutionupdate')}}",
                data:{id:id,resolution:resolution},
                success:function(result){
                    location.reload();
                    // console.log(result)
                }
            })
        })

    });
</script>
@endsection
