@extends('layouts.web')

@section('content')

	<section class="banner store" style="">
		<div class="container">
			<div class="row align-items-center h-100">
				<div class="col-md-6">
					<div class="main_img text-center">
						<img src="{{asset('web/images/store1.png')}}" >
					</div>
				</div>
				<div class="col-md-5 ">
					<div class="main_img amazing ">
						<h2> What the storage?</h2>
						<p> Every spring, every fall, you haul it in and we haul it off. Our door-to-door service will deliver all your packing materials to your front door then to your new address the next semester.</p>
						<a href="contact_us.html" class="blue_btn"> Contact Us</a>
					</div>
				</div>
			</div><!-- row close-->
		</div> <!-- container close-->
	</section>



	<section class="banner_3 plane_back">
		<div class="container">
			<div class="row align-items-center h-100">
				<div class="col-md-12 ">
					<div class="how_much ">
						<h2> How it Works</h2>
					</div>
				</div>
			</div><!-- row close-->
			<div class="col-md-10 mx-auto my-5">
								<div class="row">
									<div class="col-md-4">
									  <div class="laundry_plan Supplies">
										<img src="{{asset('web/images/1_1.png')}}">
										  <h5> Supplies Delivered</h5>
										  <p> Right to your door, everything you need for storage packing or shipping. International and domestic parcel shipping available. Call for more information.  </p>
								      </div>
									</div>
									<div class="col-md-4">
									   <div class="laundry_plan laundry_plan_2 Supplies">
										<img src="{{asset('web/images/1_2.png')}}">
										 <h5> Pick Up & Storage</h5>
										  <p> The time you select is the time we arrive. No 3-hour wait periods with us. We will be in and out quickly. Don’t worry every box and bag will be accurately labeled with your contact info and plan details. </p>
								      </div>
									</div>
									<div class="col-md-4">
									  <div class="laundry_plan laundry_plan_3 Supplies">
										<img src="{{asset('web/images/1_3.png')}}">
										 <h5>   Redelivery </h5>
										 <p> Be sure to schedule a move-in cleaning before we arrive with your stored goods. We will launder your clothes and linens before it’s returned to you. Let’s keep it fresh.  </p>
								      </div>
									</div>
								</div>
		     </div>

			<div class="row align-items-center h-100 mt-5">
				<div class="col-md-12 ">
					<div class="how_much house_plan ">
						<h2> Our Exclusive Offers</h2>

                        <div class="owl-carousel owl-theme" id="banner1" style="display: block">

					<div class="item">
						<ul class="">


                        <?php

                            $colors = ['background:#f29f00;', 'background:#70d0ef;', 'background:#4c6cb9;' ];
                            $name = ['Freshman', 'Sophomore', 'Junior' ];
                            $j = 0;
                            $i = 0;
                            ?>

                            @foreach($storageplans as $plans)
							<li>
                                <?php
                                    if($i % 3 == 0){
                                        $i = 0;
                                    }
                                    if($j % 3 == 0){
                                        $i = 0;
                                    }
                                ?>

                                <a onclick="return false" style="{{$colors[$i]}}"  class="plans" data-href="{{ route('web.completeBooking',['Storage',$plans->id]) }}" data-brought ="{{ $plans->is_brought ?? '' }}">


                                    @if($plans->is_brought)
                                        <p class="badge badge-success" style="float: left;margin-top: -40px;">Active</p>
                                    <br>
                                    @endif

									<h5> {{ $name[$j] }} </h5><br>
									<h3>${{ $plans->price }} <span> Month</span> </h3>
									<p> Pack + Ship </p>
                                <p><img src="{{asset('web/images/dlt.png')}}"> {{ $plans->description }}</p>
									<h4> <img src="{{asset('web/images/img6.png')}}"></h4>
								</a>
                            </li>
                            <?php $j++; $i++; ?>
                            @endforeach

					</div>
					</div>
				</div>
				</div>

		</div> <!-- container close-->
	</section>


	 <section class="flate_ back plane_back">
				<div class="container">
					<div class="row align-items-center h-100">
						<div class="col-md-6">

							<div class="clean_space ">
							<div class="how_much ">
								<h2 style="color:#fff;"> Ship in a Box</h2>
							</div>

								<img src="{{asset('web/images/storage1.png')}}" >

							</div>

                        </div>

                        <div class="col-md-6">

							<div class="clean_space ">
							<div class="how_much ">
								<h2 style="color:#fff;"> Store in Bin</h2>
							</div>

								<img src="{{asset('web/images/storage2.png')}}" style="width: 440px;">

							</div>

                        </div>

					</div>

				</div>

				<div class="container">
					<div class="row align-items-center h-100">
						<div class="col-md-12 ">
							<div class="frequnetily ">
								<h2>Frequently Asked Storage Questions</h2>



<div class="blog_50">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="row">
    <div class="col-md-6">
			<h5 class="pic_ups"> Scheduling Pick-ups</h5>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingOne">
					 <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				What days of the week will you be doing storage
pickups during move out week?
				</a>
			  </h4>

				</div>
				<div id="collapseOne" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingOne">
					<div class="panel-body">We will be picking up 7 days a week during peak move out times, which are generally the week of finals and one week after that. </div>
				</div>
			</div>

			<!-- --------------------------Panel-------------------------------- -->

			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingfour">
					 <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="true" aria-controls="collapseOne">
				What should I do if I know I will not be ready
for my scheduled pickup?
				</a>
			  </h4>

				</div>
				<div id="collapsefour" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingfour">
					<div class="panel-body"> 444  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.le VHS.</div>
				</div>
			</div>

			<!-- --------------------------Panel-------------------------------- -->

			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="six_1">
					 <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#col_1" aria-expanded="true" aria-controls="collapseOne">
				What if I cannot make any time on your
pre-set schedule?
				</a>
			  </h4>

				</div>
				<div id="col_1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="six_1">
					<div class="panel-body"> 555 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.le VHS.</div>
				</div>
			</div>

			<!-- --------------------------Panel-------------------------------- -->

			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="six_2">
					 <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#col_2" aria-expanded="true" aria-controls="collapseOne">
				What is the minimum number of hours
ahead of time that I can modify my
storage pickup time?
				</a>
			  </h4>

				</div>
				<div id="col_2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="six_2">
					<div class="panel-body"> 6666 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.le VHS.</div>
				</div>
			</div>

			<!-- --------------------------Panel-------------------------------- -->

			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="six_3">
					 <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#col_3" aria-expanded="true" aria-controls="collapseOne">
				What if I need to schedule one or two days
in advance?
				</a>
			  </h4>

				</div>
				<div id="col_3" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="six_3">
					<div class="panel-body"> 6666 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.le VHS.</div>
				</div>
			</div>

			<!-- --------------------------Panel-------------------------------- -->

			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="six_4">
					 <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#col_4" aria-expanded="true" aria-controls="collapseOne">
				What if I need to schedule two separate
storage pickups?
				</a>
			  </h4>

				</div>
				<div id="col_4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="six_4">
					<div class="panel-body"> 6666 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.le VHS.</div>
				</div>
			</div>

    </div>

	<div class="col-md-6">
		<h5 class="pic_ups"> Scheduling Deliveries</h5>
		<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="six_5">
					 <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#col_5" aria-expanded="true" aria-controls="collapseOne">
				Can you provide me packing supplies?
				</a>
			  </h4>

				</div>
				<div id="col_5" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="six_5">
					<div class="panel-body"> 6666 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.le VHS.</div>
				</div>
		</div>


			<!-- --------------------------Panel-------------------------------- -->


		<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="six_6">
					 <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#col_6" aria-expanded="true" aria-controls="collapseOne">
				When should I schedule my storage delivery?
				</a>
			  </h4>

				</div>
				<div id="col_6" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="six_6">
					<div class="panel-body"> 6666 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.le VHS.</div>
				</div>
		</div>


			<!-- --------------------------Panel-------------------------------- -->


		<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="six_7">
					 <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#col_7" aria-expanded="true" aria-controls="collapseOne">
				What does black out date mean?
				</a>
			  </h4>

				</div>
				<div id="col_7" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="six_7">
					<div class="panel-body"> 6666 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.le VHS.</div>
				</div>
		</div>


			<!-- --------------------------Panel-------------------------------- -->


		<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="six_8">
					 <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#col_8" aria-expanded="true" aria-controls="collapseOne">
				What happens if I miss my scheduled storage delivery?
				</a>
			  </h4>

				</div>
				<div id="col_8" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="six_8">
					<div class="panel-body"> 6666 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.le VHS.</div>
				</div>
		</div>


			<!-- --------------------------Panel-------------------------------- -->


		<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="six_9">
					 <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#col_9" aria-expanded="true" aria-controls="collapseOne">
				 What should I do if I need a last-minute delivery?
				</a>
			  </h4>

				</div>
				<div id="col_9" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="six_9">
					<div class="panel-body"> 6666 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.le VHS.</div>
				</div>
		</div>


			<!-- --------------------------Panel-------------------------------- -->


		<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="six_10">
					 <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#col_10" aria-expanded="true" aria-controls="collapseOne">
				Do you always send the same housecleaners?
				</a>
			  </h4>

				</div>
				<div id="col_10" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="six_10">
					<div class="panel-body"> 332 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.le VHS.</div>
				</div>
		</div>


			<!-- --------------------------Panel-------------------------------- -->


		<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="six_13">
					 <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#col_13" aria-expanded="true" aria-controls="collapseOne">
				Will you ship my stuff home?
				</a>
			  </h4>

				</div>
				<div id="col_13" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="six_13">
					<div class="panel-body"> 332 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.le VHS.</div>
				</div>
		</div>




    </div>
    </div>


</div>
</div>


							</div>

						</div>
					</div>
				</div>
             <!-- container close-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>

        $(document).ready(function(){
            $('.plans').click( async function(){

                var url = $(this).data('href');
                var sessionCheck = "{{ \Session::get('auth_token') }}";
                if(sessionCheck == ''){
                    alert('Please login first')
                }else{

                    var brought = $(this).data('brought')
                    if(brought == '1'){
                        alert('Plan Already brought!');
                        return false;
                    }


                    $.ajax({
                        type:"get",
                        url:"{{ url('api/checkCart') }}",
                        beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
                        complete: function(e, xhr, settings){
                            if(e.responseJSON.status == 200){
                                var check = e.responseJSON.body.storageCart
                                if(check == '1'){

                                    var checkServiceSession = "{{ \Session::get('service') }}"
                                    var checkCardIdSession = "{{ \Session::get('cart_id') }}"


                                    if((checkServiceSession == 'Laundry') && (checkCardIdSession != '') ){
                                        location.replace(url)
                                        return false;
                                    }

                                    alert('Storage plan already in cart.');
                                    return false
                                }else{

                                    location.replace(url)
                                }

                            }
                        }
                    });
                }



            })

        })
    </script>



	</section>



@endsection
