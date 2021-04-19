@extends('layouts.app')

@section('content')

<style>
th{
    width:20%;
    font-weight: 700;
}
</style>
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
    <h2 class="pull-left">View Claim</h2>
    @if(\Auth::user()->type == 'ADMIN')
  <a href="{{route('claims.index')}}" class="btn btn-default pull-right mt-20">Go Back</a>
 @else 
 <a href="{{route('staff.claims.index')}}" class="btn btn-default pull-right mt-20">Go Back</a>
 @endif
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


<table class="table table-border table-striped">

    <tr>
    <th>
        Service
    </th>
    <td>
        {{ $data->service }}
    </td>
</tr>

<tr>
    <th>
        User Name
    </th>
    <td>
        {{ $data->user->first_name.' '.$data->user->last_name }}
    </td>
</tr>


<tr>
    <th>
        Order Id
    </th>
    <td>
        ORD{{ $data->order_id }}
    </td>
</tr>

<tr>
    <th>
        Color
    </th>
    <td>
        {{ $data->color }}
    </td>
</tr>

<tr>
    <th>
        Brand
    </th>
    <td>
        {{ $data->brand }}
    </td>
</tr>

<tr>
    <th>
        Item Type
    </th>
    <td>
        {{ $data->item }}
    </td>
</tr>

<tr>
    <th>
        Size
    </th>
    <td>
        {{ $data->size }}
    </td>
</tr>

<tr>
    <th>
        Last Worn On
    </th>
    <td>
        {{ $data->last_worn }}
    </td>
</tr>

<!-- <tr>
    <th>
        Date Filed
    </th>
    <td>
        {{ $data->date_filed }}
    </td>
</tr> -->

<tr>
    <th>
        Image
    </th>
    <td>
        <img width=100 src="{{ $data->image }}">
    </td>
</tr>

<tr>
    <th>
        Resolution
    </th>
    <td>
        @if($data->resolution == '')
            {{ '---' }}
        @else
            <select class="form-control" id="resolutionorder" data-id="{{ $data->id }}" style="height: auto; width:30%" >
            <option value="0"  @if($data->resolution == '0'){{ 'selected' }}@endif>Item not received</option>
            <option value="1" @if($data->resolution == '1'){{ 'selected' }}@endif >Item found</option>
            <option value="2" @if($data->resolution == '2'){{ 'selected' }}@endif >Reimbursement</option>
            </select> 
        @endif
    </td>
</tr>

<tr>
    <th>
        Resolution Date
    </th>
    <td>
        @if($data->date_resolved == '')
            {{ '---' }}
        @else
            {{$data->date_resolved}}
        @endif
    </td>
</tr>


<tr>
    <th>
        Claim Status 

    </th>
    <td>
        <select class="form-control" id="orderstatus" data-id="{{ $data->id }}" style="height: auto; width:30%" >
            <option value="0"  @if($data->status == '0'){{ 'selected' }}@endif @if($data->status == '1'){{ 'disabled' }}@endif  >Pending</option>
            <option value="1" @if($data->status == '1'){{ 'selected' }}@endif >Resolved</option>
            <!-- <option value="2" @if($data->resolution == '2'){{ 'selected' }}@endif >Reimbursement</option> -->
        </select>
    </td>
</tr>

</table>

  </div>
</div>
<!-- Modal --> 
  <div id="id01" class="modal">
   <!--  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span> -->
    <form class="modal-content" action="{{ route('users.status') }}" id="contactForm" method="post">
      @csrf
      <div class="container">
       <!--  <h1>Account inactive</h1> -->
        <p>Are you sure you want to inactivate this plan?</p> 
        <div class="form-group">
          <label for="name">Password:</label>
          <input type="password" required="" class="form-control " id="password" placeholder="Enter password" name="password">
          <span class="text text-danger" id="password_error"></span>
           
        </div>
        <input type="hidden" id="user_id" name="user_id" value="">
        <input type="hidden" id="status" name="status" value="">
        <input type="hidden" id="url" name="url" value="">

        <button type="button" class="cancelbtn cancelbtn1">Cancel</button>
        <button name="submit" class="deletebtn" id="deletebtn">Submit</button>
      </div>
    </form>
  </div>
<!-- modal end---->

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
  $('[data-dismiss=modal]').on('click', function (e) {
    var $t = $(this),
        target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];
    
    $(target)
      .find("input,textarea,select")
         .val('')
         .end()
      .find("input[type=checkbox], input[type=radio]")
         .prop("checked", "")
         .end();
  })
  // Inactive account start 
    /*$(document).on('change','#resolutionorder',function(e){

      e.preventDefault();
      var userId = $(this).attr('data-userid');
      var status = $(this).val();
      var url = $(this).attr('data-url');

      $('#url').val(url);
      $('#user_id').val(userId);
      $('#status').val(status);
      $('#id01').modal('show'); 

    });*/

    $(document).on('click','.cancelbtn1',function(e){ 
      e.preventDefault();
      $('#id01').modal('hide'); 
    });
    $(document).ready(function(){ 

      $('#contactForm').on('submit',function(event){ 

        event.preventDefault();
        var url = $('#url').val();
        var user_id = $('#user_id').val(); 
        var status = $('#status').val();
        var password = $('#password').val();
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
              $('#password_error').text("Invalid password");
            }else{
              swal({
                  showCancelButton: false,
                  closeOnConfirm: false,
                  button: false,
                  text: "Plan inactive successfully"
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
  // End here
</script>
<script>
    $(document).ready(function(){
          setTimeout(function(){  $(".hideClass").hide('slow'); },4000);

        $('#orderstatus').change(function(){
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
        })

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
