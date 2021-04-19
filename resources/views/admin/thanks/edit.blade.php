
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
  <div class="container-fuild ml-15">
    <div class="card">
    <div class="card-body">
  
   <form class="form-material" action="{{ route('fees.update',$data->id) }}" method="post">
   
    {!! csrf_field() !!}


    <div class="form-group">
      <label for="name">Tax Fees:</label><br>
    <input type="number" step="0.01" class="form-control" required="" placeholder="Enter tax fees" name="tax_fees" maxlength = "10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="@if(isset($data->tax_fees)){{ $data->tax_fees }}@endif">
    @if($errors->first('message'))
    <span class="text text-danger">* {{ $errors->first('message') }}</span>
     @endif
    </div>
     <div class="form-group">
      <label for="name">Service Fees:</label><br>
        <input type="number" step="0.01" class="form-control" required=""  maxlength = "10" placeholder="Enter service fees" name="service_fees" value="@if(isset($data->service_fees)){{ $data->service_fees }}@endif"    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
    @if($errors->first('message'))
    <span class="text text-danger">* {{ $errors->first('message') }}</span>
     @endif
    </div>


    

<input type="submit" class="btn btn-primary" value="submit">



</form>
</div>
    </div>
  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57) ) {
        if(charCode == 110){
            return true;
        }else{
            return false;
        }
        // return false;
    }
    if(document.getElementById('weight').value.length >= 4){
        return false
    }
    return true;
}

</script>

@endsection
