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

    
        <h2>Add Fees</h2>
        <form class="form-material" action="{{ route('fees.create') }}" method="post">
    
            {!! csrf_field() !!} 
            
           
            
           {{-- <div class="form-group">
            <label for="name">Tax Fees:</label><br>
            <input type="number" step="0.01" class="form-control" required="" placeholder="Enter tax fees" name="tax_fees" maxlength = "10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="{{ old('tax_fees')}}">
            @if($errors->first('tax_fees'))
            <span class="text text-danger">* {{ $errors->first('tax_fees') }}</span>
            @endif
            </div> --}}
            <div class="form-group">
            <label for="name">Service Fees:</label><br>
            <input type="number" step="0.01" class="form-control" required=""  maxlength = "10" placeholder="Enter service fees" name="service_fees" value="{{ old('service_fees')}}"    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
            @if($errors->first('service_fees'))
            <span class="text text-danger">* {{ $errors->first('service_fees') }}</span>
            @endif
            </div> 
           
                <div class="form-group">
                    <label for="name">Apply service:</label><br>
                    <select required="" name="apply_services" class="form-control">
                        <option value="">Select</option>
                        <option value="Laundry" @if(old('apply_services') == 'Laundry') selected @endif )>Laundry</option>
                        <option value="Housekeeping" @if(old('apply_services') == 'Housekeeping') selected @endif>Housekeeping</option>
                        <option value="Storage" @if(old('apply_services') == 'Storage') selected @endif>Storage</option>
                    </select>
                    @if($errors->first('apply_services'))
                        <span class="text text-danger">* {{ $errors->first('apply_services') }}</span>
                    @endif
                </div> 
            
            <button type="submit" class="btn btn-default">Submit</button>
            <a href="{{ route('cmspages.index') }}" class="btn btn-default">Cancel</a>
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

    </script>

@endsection
