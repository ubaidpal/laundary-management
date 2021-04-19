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

<div class="container-fuild">
  <div class="card">
    <div class="card-body">

  <h2 class="pull-left">Manage Staff Member</h2>
    <a class="pull-right btn btn-primary" href="{{ route('staff_members.single') }}">Add Staff Member</a>
  <div class="clearfix"></div>
  <div class="pt10 pull-right w35">

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
  <div class="clearfix"></div>

  <table class="table" id="myTable">
    <thead>
      <tr>
        <th>S.no</th>
        <th style="width: 20%;">Name</th>
        <th>Email</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @php $j = 1; @endphp
      @foreach ($data as $details)
        <tr>
        <td>{{$j++}}</td>
        <td>{{$details->name}}</td>
        <td>{{$details->email}}</td>
        <td>
          @if($details->status == 1)
            <a href="javascript:void(0)" data-userid="{{$details->id}}" data-status="0" data-url="{{ route('staff_members.status') }}" class="text-success active_account" >{{ 'Activated' }}</a>
          @else
            <a href="javascript:void(0)" data-userid="{{$details->id}}" data-status="1" data-url="{{ route('staff_members.status') }}" class="text-danger inactive_account" > {{ 'Inactived' }} </a>
          @endif
        </td>
        <td>
            <a href="{{ route('staff_members.view', $details->id) }}"> <i class="mdi mdi-eye text-default"></i> </a>&nbsp;
            <a href="{{ route('staff_members.edit', $details->id) }}"> <i class="mdi mdi-account-edit text-default"></i> </a>&nbsp;
            <a class="delete deleteuserbutton" href="javascript:void(0)" data-userid="{{$details->id}}" data-url="{{ route('staff_members.delete') }}" ><i class="icon-trash text-default"></i> </a>
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
  <div id="id01" class="modal">
    <!-- <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span> -->
    <form class="modal-content" action="{{ route('users.status') }}" id="contactForm" method="post">
      @csrf
      <div class="container">
       <!--  <h1>Account inactive</h1> -->
        <p>Are you sure you want to inactivate this account?</p> 
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

<!-- Modal --> 
  <div id="id02" class="modal">
   <!--  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">×</span> -->
    <form class="modal-content" action="{{ route('users.status') }}" id="contactForm2" method="post">
      @csrf
      <div class="container">
        <!-- <h1>Account active</h1> -->
        <p>Are you sure you want to active this account?</p> 
        <div class="form-group">
          <label for="name">Password:</label>
          <input type="password" required="" class="form-control " id="user_password" placeholder="Enter password" name="password">
          <span class="text text-danger" id="user_password_error"></span> 
        </div>
        <input type="hidden" id="users_id" name="user_id" value="">
        <input type="hidden" id="user_status" name="status" value="">
        <input type="hidden" id="user_url" name="url" value=""> 
        <button type="button" class="cancelbtn cancelbtn2">Cancel</button>
        <button name="submit" class="deletebtn" id="deletebtn">Submit</button>
      </div>
    </form>
  </div>
<!-- modal end---->

<!-- Modal -->  
  <div id="id03" class="modal">
    <!-- <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">×</span> -->
    <form class="modal-content" action="" id="deleteuserform" method="post">
      @csrf
      <div class="container">
        <!-- <h1>Account active</h1> -->
        <p>Are you sure you want to delete this account?</p> 
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
  // Inactive account start 
    $(document).on('click','.active_account',function(e){

      e.preventDefault();
      var userId = $(this).attr('data-userid');
      var status = $(this).attr('data-status');
      var url = $(this).attr('data-url');

      $('#url').val(url);
      $('#user_id').val(userId);
      $('#status').val(status);
      $('#id01').modal('show'); 

    });

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
                  text: "User inactive successfully"
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

  // Active account start

    $(document).on('click','.inactive_account',function(e){

      e.preventDefault();
      var userId = $(this).attr('data-userid');
      var status = $(this).attr('data-status');
      var url = $(this).attr('data-url');

      $('#user_url').val(url);
      $('#users_id').val(userId);
      $('#user_status').val(status);
      $('#id02').modal('show'); 
    });

    $(document).on('click','.cancelbtn2',function(e){ 
        e.preventDefault();
        $('#id02').modal('hide'); 
    });

    $(document).ready(function(){ 

      $('#contactForm2').on('submit',function(event){ 
        event.preventDefault();
        var url = $('#user_url').val();
        var user_id = $('#users_id').val();
        
        var status = $('#user_status').val();
        var password = $('#user_password').val();
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
              $('#user_password_error').text("Invalid password");
            }else{
              swal({ 
                  button: false,
                  text: "User active successfully"
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
                  text: "User deleted successfully"
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

    /*$('.delete').click(function(){
        var r = confirm("Are you sure!");
        if (r == true) {
            return true;
        } else {
            return false;
        }
    });
*/
    setTimeout(function(){  $(".hideClass").hide('slow'); },4000);
})
</script>

@endsection
