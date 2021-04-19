
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
  
   <form class="form-material" action="{{ route('tax_fees.update',$data->id) }}" method="post">
   
    {!! csrf_field() !!}


    <div class="form-group">
      `<label for="name">Tax in(%):</label><br>
    <input type="number" step="0.01" class="form-control" required="" placeholder="Enter tax fees" name="tax_fees" id="tax_fees" maxlength = "3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="@if(isset($data->tax)){{ $data->tax }}@endif">
    <span class="text text-danger">*</span>
    @if($errors->first('message'))
    <span class="text text-danger">* {{ $errors->first('message') }}</span>
     @endif
    </div>
     
    <div class="form-group">
      <label for="name">Apply service:</label><br>
      {{-- <select required="" name="apply_services" class="form-control">
          <option value="">Select</option>
          <option value="Laundry" @if(old('apply_services') == 'Laundry') selected @elseif(isset($data->apply_services) && ($data->apply_services == 'Laundry')) {{'selected'}} @endif )>Laundry</option>
          <option value="Housekeeping" @if(old('apply_services') == 'Housekeeping') selected @elseif(isset($data->apply_services) && ($data->apply_services == 'Housekeeping')) {{'selected'}} @endif>Housekeeping</option>
          <option value="Storage" @if(old('apply_services') == 'Storage') selected @elseif(isset($data->apply_services) && ($data->apply_services == 'Storage')) {{'selected'}} @endif>Storage</option>
      </select> --}}
      <input  class="form-control" type="text" name="apply_services" value="{{ $data->apply_services }}" disabled>
      @if($errors->first('error'))
          <span class="text text-danger">* {{ $errors->first('apply_services') }}</span>
      @endif
  </div>

    

<input type="submit" id="button" class="btn btn-primary" value="submit">



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
