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
</style>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.css" integrity="sha256-G5PTdPgo4SQMURj4T5iUmc8SZE0yEaxMhmAVt/AWxnU=" crossorigin="anonymous" />

<div class="container-fuild ml-15" >
    <div class="card">
    <div class="card-body">

    @if(isset($data->id))
        <h2>Edit Insurance Plan</h2>
    @else
        <h2>Add Insurance</h2>
    @endif

    @if(isset($data->id))
        <form class="form-material" action="{{ route('insurance.planeditupdate',$data->id) }}" method="post">
    @else
        <form class="form-material" action="{{ route('insurance.create') }}" method="post">
    @endif
    {!! csrf_field() !!}

   <!--  <div class="form-group">
      <label for="name"> Item Name: </label>
      <input type="text" class="form-control " id="item_name" autocomplete="off"  placeholder="Enter school name" name="item_name" required="" value="@if(isset($data->item_name)){{ $data->item_name }}@else{{ old('item_name') }}@endif">
    @if($errors->first('item_name'))
    <span class="text text-danger">* {{ $errors->first('item_name') }}</span>
    @endif 
    </div>  -->
    <div class="form-group">
      <label for="name"> Standard Price: </label> 
      <?php
        if (isset($data->id)) {
          
          $prices =  explode(',', $data->prices); 

           if (!empty($prices[0])) {
            $price1 = $prices[0];
          }else{
            $price1 = '-';
            } 

            if (!empty($prices[1])) {
                $price2 = $prices[1];
              }else{
            $price2 = '-';
            }

            if (!empty($prices[2])) {
                $price3 = $prices[2];
              }else{
            $price3 = '-';
            }
        }
      ?>
      <input type="number" class="form-control" id="price" autocomplete="off" name="price[]" value="@if(isset($data->id)){{ trim($price1) }}@else{{ old('price') }}@endif" placeholder="Enter standard price">
    @if($errors->first('price'))
    <span class="text text-danger">* {{ $errors->first('price') }}</span>
    @endif
    </div><div class="form-group">
      <label for="name"> Plus Price: </label> 

      <input type="number" class="form-control" id="price" autocomplete="off" name="price[]" value="@if(isset($data->id)){{ trim($price2) }}@else{{ old('price') }}@endif" placeholder="Enter plus price">
    @if($errors->first('price'))
    <span class="text text-danger">* {{ $errors->first('price') }}</span>
    @endif
    </div>
    <div class="form-group">
      <label for="name"> Premium Price: </label> 

      <input type="number" class="form-control" id="price" autocomplete="off" name="price[]" value="@if(isset($data->id)){{ trim($price3) }}@else{{ old('price') }}@endif" placeholder="Enter premium price">
    @if($errors->first('price'))
    <span class="text text-danger">* {{ $errors->first('price') }}</span>
    @endif
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
    <a href="{{ route('insurance.planindex') }}" class="btn btn-default">Cancel</a>
  </form>
</div>
    </div>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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

        $(document).ready(function () {



        //called when key is pressed in textbox
       /* $("#url").keypress(function (e) {
            alert('asdsa');
            if (e.which == 32 && e.which != 0 ) {
                alert('space');
            }
        }); */
        });
        /*$(document).ready(function(){
      
        var count = 0;

        $(document).on('click', '.add', function(){
            count++;
            var html = '';
            html += '<input type="text" class="form-control " id="building" autocomplete="off"  placeholder="Enter building" name="building" value="">'
            html += '<td><button type="button" name="remove" class="btn btn-danger btn-xs remove"><span class="glyphicon glyphicon-minus"></span></button></td>';
            $('.add-more').append(html);
        });

            $("body").on("click",".remove",function(){ 
                $(this).parents(".add-more").remove();
            });
        });*/

        $(document).ready(function() {
            var max_fields      = 2; //maximum input boxes allowed
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

    </script>

@endsection
