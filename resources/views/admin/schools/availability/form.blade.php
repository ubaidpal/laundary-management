@extends('layouts.app')

@section('content')
<style>
.w-45{
       width:45%;
}
.w-15{
       width:15%;
}
.ml-15{
    margin-left:15px;
}
.error{
    color: red;
}
</style>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.css" integrity="sha256-G5PTdPgo4SQMURj4T5iUmc8SZE0yEaxMhmAVt/AWxnU=" crossorigin="anonymous" />

<div class="container-fuild ml-15" >
     
     
    <div class="card">
    <div class="card-body">

    @if(isset($data->id))
        <h2>Edit Availability</h2>
    @else
        <h2>Add Availability</h2>
    @endif
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
    @if(isset($data->id))
        <form id="myForm" class="form-material" action="{{ route('schools.update_availability',$data->id) }}" method="post">
    @else
        <form id="myForm" class="form-material" action="{{ route('schools.create_availability') }}" method="post">
    @endif
    {!! csrf_field() !!}

    <div class="form-group">
      <label for="name"> Start Time: </label>
      <input type="time" class="form-control " required="" id="start_time" autocomplete="off"  placeholder="Enter school name" name="start_time" required="" value="@if(isset($data->start_time)){{ $data->start_time }}@else{{ old('start_time') }}@endif">
      <span id="alert-message" class="error"></span>
    @if($errors->first('start_time'))
    <span class="text text-danger">* {{ $errors->first('start_time') }}</span>
    @endif 
    </div>

    <div class="form-group">
      <label for="name"> End Time: </label>
      <input type="time" class="form-control " required=" id="end_time" autocomplete="off"  placeholder="Enter school name" name="end_time" required="" value="@if(isset($data->end_time)){{ $data->end_time }}@else{{ old('end_time') }}@endif">
      <span id="alert-message" class="error"></span>
    @if($errors->first('end_time'))
    <span class="text text-danger">* {{ $errors->first('end_time') }}</span>
    @endif 
    </div>

    <button type="submit" id="form_vaidation" class="btn btn-default">Submit</button>
    <a href="{{ route('schools.add_availability') }}" class="btn btn-default">Cancel</a>
  </form>
</div>
    </div>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){

          $("#url").keypress(function (e) {

            if($(this).val().length >= 15){
                return false;
            }

            if (e.which == 32 && e.which != 0 ) {
                alert('No Space Allowed');
                return false;
            }
        });



        })
        </script>


<script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script src="{{ asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
    

    <script>
        $('textarea').ckeditor(); 
        $(document).ready(function() {
            var max_fields      = 20; //maximum input boxes allowed
            var wrapper         = $(".add-more"); //Fields wrapper
            var add_button      = $(".add"); //Add button ID
            
            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div><input type="text" required class="form-control " id="building" autocomplete="off"  placeholder="Enter building" name="building[]"/><button type="button" name="add" class="btn btn-success btn-xs remove_field"><span class="glyphicon glyphicon-plus"></span>Remove</button></div>'); //add input box
                }
            });
            
            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })
            $('.dynamic').on("click",".remove", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })
        });
        $(document).ready(function() {
           /* $("#myForm").on('submit',function(e){
                e.preventDefault();

                var url = $('#myForm').attr('action');
                console.log(url);  
                var redirection = $('#myForm').attr('redirection');
                var formData = $('#myForm').serialize();

                $.ajax({
                    url:url,
                    type:'post',
                    data:formData,
                    success:function(response){
                        if (response.status == false) {
                            //alert("sfdsfd")
                            $("#alert-message").html(response.success);
                        }else{
                            swal({ 
                              button: false,
                              text: "School Updated successfully"
                          });
                            window.setTimeout(function(){ 
                              window.location.href = redirection;
                          } ,1500);
                        }
                    },
                });
                // return false;
            });*/
        });
    </script>

@endsection
