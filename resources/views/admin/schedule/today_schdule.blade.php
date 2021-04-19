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
    <h2 class="pull-left">Today's Orders</h2>

<!-- <a href="{{route('orders.all',['type'=>'storage'])}}" class="btn @if(\Request::segment(3) == 'storage') btn-primary @endif pull-right mt-20"> Storage Orders </a>
<a href="{{route('orders.all',['type'=>'housekeeping'])}}" class="btn @if(\Request::segment(4) == 'housekeeping') btn-primary @endif  pull-right mt-20" style="margin-right: 5px;"> HouseKeeping Orders </a>
<a href="{{route('orders.all',['type'=>'laundry'])}}" class="btn @if(\Request::segment(4) == 'laundry') btn-primary @endif pull-right mt-20" style="margin-right: 5px;"> Laundry Orders </a>
<a href="{{route('orders.all')}}" class="btn @if(\Request::segment(4) == '') btn-primary @endif pull-right mt-20" style="margin-right: 5px;"> All Orders </a> -->


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
            <a href="{{ route('orders.view', $details->id) }}"> <i class="mdi mdi-eye   text-default"></i> </a>&nbsp;&nbsp;&nbsp;
            <a class="delete deleteuserbutton" href="javascript:void(0)" data-userid="{{$details->id}}" data-url="{{ route('orderssingledelete') }}"><i class="icon-trash text-default"></i> </a>
        </td>
        
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
    <!-- <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">×</span> -->
    <form class="modal-content" action="" id="deleteuserform" method="post">
      @csrf
      <div class="container">
        <!-- <h1>Account active</h1> -->
        <p>Are you sure you want to delete this order?</p> 
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
              $('#delete_password_error').css('display','block');
              $('#delete_password_error').text("Invalid password");
            }else{
              swal({ 
                  button: false,
                  text: "Order deleted successfully"
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
    $(document).ready(function(){
          //setTimeout(function(){  $(".hideClass").hide('slow'); },4000);
           orderstatus =  $('.orderstatus').val();
          //alert(orderstatus);
        $('.orderstatus').change(function(){
         //alert('alert');
          var id = $(this).data('id');
            var accept_status = $(this).val();
            if (!confirm("Are you sure want to change status?")) {
                $(this).val(orderstatus); //set back
                return;                  //abort!
            }  
            console.log(id,accept_status);
            $.ajax({
                type:"get",
                url: "{{route('orders.updateStatus')}}",
                data:{id:id,accept_status:accept_status},
                success:function(result){ 
                    console.log(result)
                    orderstatus =accept_status;
                }
            })
          
        })

    });
</script>



@endsection
