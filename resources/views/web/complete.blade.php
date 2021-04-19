@extends('layouts.web')

@section('content')

<section class="banner">
		<div class="container-fluid">
			<div class="row align-items-center h-100">
				<div class="col-md-12 ">
					<div class="main_img  text-center btm_left ">
						<h2> YOU’RE A STEP AWAY FROM A HAPPY HOME	</h2>

					</div>
				</div>
			</div><!-- row close-->
		</div> <!-- container close-->
	</section>

	<section class="f late_back1 booking12" style="background:url('{{ asset('web/images/get_serv.png') }}')">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class=" get_service1">
					  <div class="booking">
						<h2>Purchase Package</h2>

					  </div>

						<div class="contact_form1">


							<form>
								<div class="pro_plan_blue">
									 <h5><strong> ${{$planDetails->price}}<small>per Month</small></strong> </h5>
                                    @if($service == 'Laundry')
                                        <h4>{{ $planDetails->weight }} Lbs per week</h4>
                                    @endif
                                    @if($service == 'Housekeeping' || $service == 'Storage')
                                        <h4>{{ $planDetails->description }} </h4>
                                    @endif

                                    @if( $service == 'Laundry' )

                                    <div class="input-group">
									 {{-- <span> <a href="">i</a></span> --}}
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                        <input type="checkbox" id="insuranceChecked" aria-label="Checkbox for following text input" disabled>
                                        </div>
                                    </div>
                                    </div>

                                    <select id="insurance" class="form-control" aria-label="Text input with checkbox">
                                        <?php $j=0; ?>
                                        <option value="">Please select insurance</option>
                                        @foreach ($insurance as $ins )
                                            <option value="{{ $j }}">{{$insuranceName[$j]}} -  ${{ $ins }}</option>
                                            <?php $j++; ?>
                                        @endforeach
                                    </select>

                                    <input type="hidden" name="insurance" value="">

                                    @endif


                                    @if($service == 'Storage')

                                        <div class="input-group">
                                        <span> <a href="">i</a></span>
                                        <div class="input-group-prepend" style="height: 38px;">
                                            <div class="input-group-text">
                                            <input type="checkbox" id="largeItem" aria-label="Checkbox for following text input" >
                                            </div>
                                        </div>
                                        <p class="form-control"> Do you have any large item ? </p>

                                        </div>


                                        <table class="table AddonTable" style="display: none">
                                            <tr>
                                                <th>Addon Name</th>
                                                <th>Price</th>
                                            </tr>

                                        </table>

                                    @endif


                                    @if($service == 'Housekeeping')

                                    <select name="frequency" class="form-control" aria-label="Text input with checkbox" style="    margin-top: 15px;display: inline-block;">
                                        <?php $j=0; ?>
                                            <option value="1" selected> Monthly -: ${{ $planDetails->price }} </option>
                                            <option value="2"> Bi-weekly -: ${{ $planDetails->price * 2 }} </option>
                                            <option value="3"> Weekly -: ${{ $planDetails->price * 4 }} </option>
                                    </select>

                                    @endif

                                    </div>
								</div>
							</form>
						</div>

                    <input type="hidden" name="service" value="{{ $service }}">
                    <input type="hidden" name="plan_id" value="{{ $planDetails->id }}">


                    @if($service == 'Laundry')

					<div class="contact_form1 Dropoff">


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <div class="input-group date">
                                <label>When to Drop off Date</label>
                                <input type="date" class="form-control" name="droppoff_date" placeholder="Select Time" required="">
                                </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                <div class="input-group date">
                                <label>When to Drop off Time</label>
                                <input type="time" class="form-control" name="droppoff_time" placeholder="Select Time" required="">
                                </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                <div class="input-group date">
                                <label>Dorm Name</label>
                                <input type="email" class="form-control" name="dorm_name" placeholder="Select Loccation" required="">
                                </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <a href="" onclick="return false" id="completeBooking" class="yellow_btn"> Add</a>
                            </div>
                        </div>
                    </div>

                    @endif

                    @if($service == 'Housekeeping')

					<div class="contact_form1 Dropoff">


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <div class="input-group date">
                                <label>Clean my house every Date</label>
                                <input type="date" class="form-control" name="pickup_date" placeholder="Select Time" required="">
                                </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                <div class="input-group date">
                                <label>Clean my house every Time</label>
                                <input type="time" class="form-control" name="pickup_time" placeholder="Select Time" required="">
                                </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                <div class="input-group date">
                                <label>Address</label>
                                <input type="email" class="form-control" name="address" placeholder="Select Loccation" required="">
                                </div>
                                </div>
                            </div>

                            <input type="hidden" name="addons" value="">

                            <div class="col-md-6">
                                <a href="" onclick="return false" class="yellow_btn addons"  data-toggle="modal" > Addons</a>
                            </div>
                            <div class="col-md-6">
                                <a href="" onclick="return false" id="completeBooking" class="yellow_btn"> Add</a>
                            </div>
                        </div>
                    </div>

                    @endif



                    @if($service == 'Storage')

					<div class="contact_form1 Dropoff">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <div class="input-group date">
                                <label>Deliver my package materials on Date</label>
                                <input type="date" class="form-control" name="droppoff_date" placeholder="Select Date" required="">
                                </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                <div class="input-group date">
                                <label>Deliver my package materials on Time</label>
                                <input type="time" class="form-control" name="droppoff_time" placeholder="Select Time" required="">
                                </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                <div class="input-group date">
                                <label>Pickup my summer storage on Date</label>
                                <input type="date" class="form-control" name="pickup_date" placeholder="Select Date" required="">
                                </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                <div class="input-group date">
                                <label>Pickup my summer storage on Time</label>
                                <input type="time" class="form-control" name="pickup_time" placeholder="Select Time" required="">
                                </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                <div class="input-group date">
                                <label>Address</label>
                                <input type="email" class="form-control" name="address" placeholder="Select Loccation" required="">
                                </div>
                                </div>
                            </div>

                            <input type="hidden" name="addons" value="">

                            <div class="col-md-12">
                                <a href="" onclick="return false" id="completeBooking" class="yellow_btn"> Add</a>
                            </div>
                        </div>
                    </div>

                    @endif




				</div><!-- get_service close-->


			<div class="col-md-4">
				<div class="service">
					<img src="{{asset('web/images/new_time.png')}}">
					<h6> SAVES YOU TIME </h6>
					<p> Our service helps you live smarter, giving you time to focus on what's most important.</p>

					<img src="{{asset('web/images/new_safety.png')}}">
					<h6> SAFETY FIRST </h6>
					<p> We rigorously vet all of our Cleaners, who undergo identity checks as well as in-person interviews.</p>

					<img src="{{asset('web/images/new_like.png')}}">
					<h6> ONLY THE BEST QUALITY </h6>
					<p>Our skilled professionals go above and beyond on every job. Cleaners are rated and reviewed after each task.</p>

					<img src="{{asset('web/images/new_clean.png')}}">
					<h6> EASY TO GET HELP </h6>
					<p>Select your ZIP code, number of bedrooms and bathrooms, date and relax while we take care of your home.</p>

					<img src="{{asset('web/images/new_chat.png')}}">
					<h6> SEAMLESS COMMUNICATION </h6>
					<p> Online communication makes it easy for you to stay in touch with your Cleaners.</p>

					<img src="{{asset('web/images/new_visa.png')}}">
					<h6> CASH FREE PAYMENT </h6>
					<p> Pay securely online only when the cleaning is complete.</p>
				</div>


        </div><!-- row close-->
    </div> <!-- container close-->

<div id="add_cart" class="modal fade profile_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1" id="closeBox" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop text-center">
		<img src="{{asset('web/images/logo.png')}}" >
		<div class="add_Cart_list" id="housekeeping_items" style="overflow-y: scroll;height: 350px;">

		</div>
		 <h3>
			<a href="" onclick="return false" class="width_100" id="housekeeping_items_proceed" data-dismiss="modal" > Proceed </a>
		 </h3>
		</div>
      </div>
    </div>

  </div>
</div>

</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        $('#insurance').change(function(){
            var ins = $(this).val();
            if(ins != ''){
                $('#insuranceChecked').attr('checked','true');
                var valeu = '1,'+ ins
                $('input[name="insurance"]').val(valeu)
            }else{
                $('#insuranceChecked').removeAttr('checked');
                $('input[name="insurance"]').val('')
            }
        });
    });


    $('.addons').click(function(){
        // var subscription_id = $(this).data('subscription_id');
        // $('input[name="subscription_id"]').val(subscription_id);

        $.ajax({
            type: "get",
            url: "{{ url('api/getHousekeepingItems') }}",
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            complete: function(e, xhr, settings){
                if(e.responseJSON.status == 200){
                    var body = e.responseJSON.body

                    for(var i =0; i < body.length; i++ ){
                        var data = body[i];

                        $('#housekeeping_items').append(`

                        <p> <input type="checkbox" name="housekeeping_selected" value="`+ data.id +`" class="housekeeping_selected" data-description="`+ data.description + `" data-price="`+ data.price + `" > `+ data.description +`:  $`+ data.price +`</p>

                        `);

                    }

                    $('#add_cart').modal('show')

                }else{
                    alert(e.responseJSON.message)
                }

            }
        })
    });

    $('#housekeeping_items_proceed').click(function(){
        var addons = [];
        var total_price = 0;
            $.each($("input[name='housekeeping_selected']:checked"), function(){
                addons.push({
                    "addon_id": $(this).val(),
                    "description": $(this).data('description'),
                    "price": $(this).data('price'),
                    "quantity": '1',
                });
                // total_price = total_price + parseFloat($(this).data('price'));
            });

            if(addons.length > 0){

                addons.forEach(function(item,index){


                    $('.AddonTable').append(`
                        <tr>
                        <td> `+ item.description + `<?td>
                        <td> $`+ item.price +`</td>
                        </tr>
                    `)

                })

                $('.AddonTable').show()

            }

            $('input[name="addons"]').val(JSON.stringify(addons))

    });

    $('#largeItem').click(function(){
        var largeItem = $(" #largeItem:checked").val();

        if(largeItem == 'on' ){
            $('#add_cart').modal({
                        backdrop: 'static',
                        keyboard: false
                });


        $.ajax({
            type: "get",
            url: "{{ url('api/getStorageItems') }}",
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            complete: function(e, xhr, settings){
                if(e.responseJSON.status == 200){
                    var body = e.responseJSON.body

                    for(var i =0; i < body.length; i++ ){
                        var data = body[i];

                        $('#housekeeping_items').append(`

                        <p> <input type="checkbox" name="housekeeping_selected" value="`+ data.id +`" class="housekeeping_selected" data-description="`+ data.description + `" data-price="`+ data.price + `" > `+ data.description +`:  $`+ data.price +`</p>

                        `);

                    }

                    $('#add_cart').modal('show')

                }else{
                    alert(e.responseJSON.message)
                }

            }
        })

        }else{
            $('input[name="addons"]').val('')
            $('.AddonTable').html(`
                <tr>
                    <th>Addon Name</th>
                    <th>Price</th>
                </tr>`)
            $('.AddonTable').hide()
        }
    })

    $('#closeBox').click(function(){
        $('#add_cart').modal('hide')
        $('input[name="addons"]').val('')

        $('#largeItem').prop( "checked", false );

    })

</script>

@endsection
