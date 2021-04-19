@extends('layouts.web')

@section('content')

<section class="banner">
		<div class="container">
			<div class="row align-items-center h-100">
				<div class="col-md-6">
					<div class="main_img text-center house_keep">
						<img src="{{asset('web/images/house.png')}}" >
					</div>
				</div>
				<div class="col-md-5 ">
					<div class="main_img amazing">
						<h2> We Are Offering Housekeeping</h2>
						<p> We’re proud to offer professional housecleaning services and your trust in us is based on our reputation - quality of clean, reliability, affordability, and familiarity. </p>
						<a href="contact_us.html" class="blue_btn"> Contact Us</a>
					</div>
				</div>
			</div><!-- row close-->
		</div> <!-- container close-->
	</section>

	<section class="banner_2 banner_house">
		<div class="container">
			<div class="row align-items-center h-100">
				<div class="col-md-6 ">
					<div class="main_img padding_right amazing">
						<h2> OMG - This is Amazing.</h2>
						<p> If you’re like most students who’ve used our laundry or storage services and now live off-campus, we believe consistency is key in your busy lives. Therefore, you need not look any further.</p>
						<p>Everything you need to live comfortably through your college experience is here. We are at your service.</p>


<p>Talk about a ‘one stop shop’.</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="main_img text-center">
						<img src="{{asset('web/images/img2.png')}}" >
					</div>
				</div>
			</div><!-- row close-->

			<div class="row align-items-center h-100 margin_top">
				<div class="col-md-6 mt-5">
					<div class="main_img text-center">
						<img src="{{asset('web/images/img8.png')}}" >
					</div>
				</div>
				<div class="col-md-6 ">
					<div class="main_img padding_right amazing">
						<h2> About Housekeeping</h2>
						<p> An organized home is an organized mind. Spruce up the place every now and then. Schedule a cleaning as often as you’d like. Tell us which cleaning products you prefer and we will stock you up.</p>
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
						<h2> How Service Works</h2>
					</div>
				</div>
			</div><!-- row close-->
			<!-- <div class="row">
				<div class="col-md-4 ">
					<div class="how_serve ">
						<h3> <span> 01.</span> Schedule Us</h3>
						<p>We are available 5 days per week  Monday thru Friday 9am-4pm </p>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="how_serve ">
						<h3> <span> 02.</span> Let Us In</h3>
						<p>Whether it is a doorman or a friend all we 	need is to be let in.</p>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="how_serve ">
						<h3> <span> 03.</span> Stay Consistent</h3>
						<p>Schedule  recurring cleans to keep your place looking and smelliing fresh. </p>
					</div>
				</div>
			</div> -->

			<div class="col-md-10 mx-auto my-5">
								<div class="row">
									<div class="col-md-4">
									  <div class="laundry_plan Schedule">
										<img src="{{asset('web/images/1_1.png')}}">
										  <h5> Schedule Us</h5>
										  <p> We are available 5 days per week Monday thru Friday 9am-4pm   </p>
								      </div>
									</div>
									<div class="col-md-4">
									   <div class="laundry_plan laundry_plan_2 Schedule">
										<img src="{{asset('web/images/1_2.png')}}">
										 <h5> Let Us In</h5>
										  <p> Whether it is a doorman or a friend all we need is to be let in. </p>
								      </div>
									</div>
									<div class="col-md-4">
									  <div class="laundry_plan laundry_plan_3 Schedule">
										<img src="{{asset('web/images/1_3.png')}}">
										 <h5>    Stay Consistent </h5>
										 <p> Schedule recurring cleans to keep your place looking and smelliing fresh.   </p>
								      </div>
									</div>
								</div>
		     </div>


		</div> <!-- container close-->
	</section>

<section class="p-0">
 <div class="container">
	   <div class="col-md-12">
			<div class="cut_corners">
				<h3>We Never cut Corners</h3>
				<p>Our 50 pt  cleaning method </p>
			</div>
	   </div>

			<div class="border_blue">
				<div class="row">
					<div class="col-md-3 bg-blue">
					  <div class="dust whip">
					   <!--  <image src="images/dust.png" class="head_img"> -->
						 <image src="{{asset('web/images/bed.png')}}" class="head_img">
						<h5> All Rooms </h5>
						  <p><img src="{{asset('web/images/check.png')}}" > Lighting Fixtures</p>
						  <p><img src="{{asset('web/images/check.png')}}" > Door Frames </p>
						  <p><img src="{{asset('web/images/check.png')}}" > Vents</p>
						  <p><img src="{{asset('web/images/check.png')}}" > Picture Frames</p>
						  <p><img src="{{asset('web/images/check.png')}}" > TV & other monitors (not screens) </p>
						  <p><img src="{{asset('web/images/check.png')}}" > Table & chairs</p>
						  <p><img src="{{asset('web/images/check.png')}}" > Fan </p>
						  <p><img src="{{asset('web/images/check.png')}}" > Fan</p>
						  <p><img src="{{asset('web/images/check.png')}}" > Shelves </p>
						  <p><img src="{{asset('web/images/check.png')}}" > Blinds </p>
					  </div>
					</div>

					<div class="col-md-3">
					  <div class="dust whip">
					   <!-- <image src="images/whip.png" class="head_img"> -->
					   <image src="{{asset('web/images/kitchen.png')}}" class="head_img">
						<h5> Kitchen </h5>
						 <p><img src="{{asset('web/images/check.png')}}" > Kitchen counters  </p>
						 <p><img src="{{asset('web/images/check.png')}}" > Kitchen cabinets (exterior)  </p>
						 <p><img src="{{asset('web/images/check.png')}}" > Refrigerator (exterior, including top) </p>
						 <p><img src="{{asset('web/images/check.png')}}" > Table tops   </p>
						 <p><img src="{{asset('web/images/check.png')}}" > Bathroom counters  </p>
						 <p><img src="{{asset('web/images/check.png')}}" > Bathroom shelves (exterior)  </p>
						 <p><img src="{{asset('web/images/check.png')}}" > Shower door   </p>
						 <p><img src="{{asset('web/images/check.png')}}" >  Shower caddy/ soap dish </p>
						 <p><img src="{{asset('web/images/check.png')}}" > Bathroom mirror  </p>
						 <p><img src="{{asset('web/images/check.png')}}" >  Trash cans (exterior)   </p>
						 <p><img src="{{asset('web/images/check.png')}}" > Window sills  </p>
						 <p><img src="{{asset('web/images/check.png')}}" > Under A/C unit   </p>
					  </div>

					</div>
					<div class="col-md-3 bg-blue">
					 <div class="dust whip">
					    <!-- <image src="images/scrub.png" class="head_img"> -->
					    <image src="{{asset('web/images/bath.png')}}" class="head_img">
						<h5> Bathrooms </h5>
						 <p><img src="{{asset('web/images/check.png')}}" > Stovetop  </p>
						 <p><img src="{{asset('web/images/check.png')}}" > Wall behind stovetop  </p>
						 <p><img src="{{asset('web/images/check.png')}}" > Kitchen sink </p>
						 <p><img src="{{asset('web/images/check.png')}}" > Microwave (inside & out) </p>
						 <p><img src="{{asset('web/images/check.png')}}" > Toaster (inside & out) </p>
						 <p><img src="{{asset('web/images/check.png')}}" > Load & run dishwasher (1 load) or Empty dishwasher if client left note  </p>
						 <p><img src="{{asset('web/images/check.png')}}" > Bathtub/shower </p>
						 <p><img src="{{asset('web/images/check.png')}}" > Bathroom tiles </p>
						 <p><img src="{{asset('web/images/check.png')}}" > Bathroom sinks  </p>
						 <p><img src="{{asset('web/images/check.png')}}" > Toilet </p>

					  </div>

					</div>

					<div class="col-md-3">
					  <div class="dust whip">
					     <!-- <image src="images/floors.png" class="head_img"> -->
					     <image src="{{asset('web/images/doors.png')}}" class="head_img">
						<h5> Windows & Doors </h5>
						 <p><img src="{{asset('web/images/check.png')}}" >  Vacuum (if provided)</p>
						 <p><img src="{{asset('web/images/check.png')}}" >  Dry mopping</p>
						 <p><img src="{{asset('web/images/check.png')}}" >  Wet mopping</p>
					  </div>
					</div>

				</div>

				<!-- <div class="row mt-3">

				  <div class="col-md-3">
					  <div class="dust whip">
					     <image src="images/leave1.png" class="head_img">
						<h5> Before we Leave </h5>
						 <p><img src="images/check.png" >  Change bedding & make beds</p>
						 <p><img src="images/check.png" >  Return supplies</p>
						  <p><img src="images/check.png" >  Straighten up</p>
						 <p><img src="images/check.png" >  Empty trash/recycling & replace liners</p>
						  <p><img src="images/check.png" >  Turn off lights & A/C unit</p>
						 <p><img src="images/check.png" >  Offer walk-through (if applicable)</p>
					  </div>

					</div>
					<div class="col-md-3 bg-blue">
					 <div class="dust whip">
					    <image src="images/add_on.png" class="head_img">
						<h5> Add ONS </h5>
						 <p><img src="images/check.png" > Inside oven  </p>
						 <p><img src="images/check.png" > Inside refridgerator  </p>
						 <p><img src="images/check.png" > Inside cabinets  </p>
						 <p><img src="images/check.png" > Heavy scrub of bathtub/shower and tiles </p>
						 <p><img src="images/check.png" > Stain removal  </p>
					  </div>

					</div>

				</div> -->
			</div>

	</div>
</section>




	<section class=" banner_bg">
		<div class="container">
			<div class="row align-items-center h-100 margin_top">
				<div class="col-md-12 ">
					<div class="how_much house_plan ">
						<h2> Our Exclusive Offers</h2>
						<ul>
                            <?php

                            $colors = ['background:#f29f00;', 'background:#70d0ef;', 'background:#4c6cb9;' ];
                            // $name = ['Light Load', 'Normal Load', 'Medium Load', 'Gold Load', 'Heavy Load' ];
                            $j = 0;
                            $i = 0;
                            ?>

                            @foreach($housekeepingplans as $plans)
							<li>
                                <?php
                                    if($i % 3 == 0){
                                        $i = 0;
                                    }
                                ?>

                                <a onclick="return false" style="{{$colors[$i]}}"  class="plans @if($j == 2) over_side @endif" data-href="{{ route('web.completeBooking',['Housekeeping',$plans->id]) }}"  data-brought ="{{ $plans->is_brought ?? '' }}">

                                    @if($plans->is_brought)
                                        <p class="badge badge-success" style="float: left;margin-top: -40px;">Active</p>
                                    <br>
                                    @endif



									<h6>{{ $plans->description }}</h6>
                                        <h3>${{ $plans->price  }}</h3>
									<p><img src="{{asset('web/images/latu.png')}}" > This cleaning is {{$plans->cleaning_time}} hours</p>
									<h4> <img src="{{asset('web/images/img6.png')}}" ></h4>
								</a>
                            </li>
                            <?php $j++; $i++; ?>
                            @endforeach
							{{-- <li>
								<a href="complete_your_booking.html" style="background:#70d0ef;">
									<h6> 2 bedroom</h6>
									<h3>$129.99  </h3>
									<p><img src="{{asset('web/images/latu.png')}}" > This cleaning is 2 hours</p>
									<h4> <img src="{{asset('web/images/img6.png')}}" ></h4>
								</a>
							</li>
							<li>
								<a href="complete_your_booking.html" style="background:#4c6cb9;" class="over_side">
									<h6> 3 bedroom</h6>
									<h3>$159.99 </h3>
									<p><img src="{{asset('web/images/latu.png')}}" > This cleaning is 2.5-3 hours</p>
									<h4> <img src="{{asset('web/images/img6.png')}}" ></h4>
								</a>
							</li> --}}
						</ul>
					</div>
				</div>
				</div>
		</div>
				<div class="container">
					<div class="row align-items-center h-100">
						<div class="col-md-12 ">
							<div class="clean_space ">
								<h2>Clean Space. Clear Mind.</h2>
							</div>
						</div>
					</div>

				 <div class="abt_us_main">
					<div class="row gol_chakr align-items-center h-100">
						<div class="col-md-6 ">
							<div class="main_img padding_right">
								<h2> Let Your Home Shine.</h2>
								<p> We understand your home is important to you. That’s why we focus on the quality of the clean. Our cleaners aren’t contract workers - they are full-time employees. They care as much as we do. On top of that, we know every home is different, so we allow you to give us special requests for those hard to reach places.</p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="main_img text-center">
								<img src="{{asset('web/images/gol.png')}}">
							</div>
						</div>
					</div>
				  </div>

				  <div class="abt_us_main">
					<div class="row  gol_chakr align-items-center h-100">
						<div class="col-md-6">
							<div class="main_img text-center">
								<img src="{{asset('web/images/gol2.png')}}">
							</div>
						</div>
						<div class="col-md-6 ">
							<div class="main_img padding_right">
								<h2>We Sweat The Details.</h2>
								<p> On top of the standard features, we will go the extra mile to get your place looking fantastic. Just ask for a deep clean, or mark your individual needs in the booking process.</p>
							</div>
						</div>

					</div>
				</div>

				 <div class="abt_us_main">
					<div class="row gol_chakr align-items-center h-100">
						<div class="col-md-6 ">
							<div class="main_img padding_right">
								<h2> Moving-in Cleaning?</h2>
								<p> We cover that, too. Whether it be summer storage or a move-in or move-out clean, we’ll handle it. Need help mid-semester for a dorm change? No problem, we’re happy to answer any request. We’ll make it the easiest move of your life</p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="main_img text-center">
								<img src="{{asset('web/images/gol3.png')}}">
							</div>
						</div>
					</div>
				  </div>
				</div>

				<div class="container">
					<div class="row align-items-center h-100">
						<div class="col-md-12 ">
							<div class="frequnetily ">
								<h2>Frequently Asked  Questions?</h2>



<div class="blog_50">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="row">
    <div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingOne">
					 <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				 Move-In Cleaning
				</a>
			  </h4>

				</div>
				<div id="collapseOne" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingOne">
					<div class="panel-body">Who doesn’t want a fresh start? Before we deliver your stored belongs to your new address, a thorough move in cleaning gives new homeowners and tenants peace of mind knowing that their new living space has been scrubbed and disinfected from top to bottom. We always recommend performing a move in clean before you unload your personal belongings. This ensures that every inch of the room gets the attention that it needs.</div>
				</div>
			</div>

			<!-- --------------------------Panel-------------------------------- -->

			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingfour">
					 <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="true" aria-controls="collapseOne">
				 Move-Out Cleaning
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
				Are you okay with pets being in the home during a cleaning service?
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
				 Do I need to be home for every cleaning service?
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
				  How will our relationship work?
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
				 Who does Laundry 305 hire to clean my home?
				</a>
			  </h4>

				</div>
				<div id="col_4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="six_4">
					<div class="panel-body"> 6666 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.le VHS.</div>
				</div>
			</div>


			<!-- --------------------------Panel-------------------------------- -->

			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="six_12">
					 <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#col_12" aria-expanded="true" aria-controls="collapseOne">
				What time does your team arrive?
				</a>
			  </h4>

				</div>
				<div id="col_12" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="six_12">
					<div class="panel-body"> 6666 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.le VHS.</div>
				</div>
			</div>


			<!-- --------------------------Panel-------------------------------- -->
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="six_17">
					 <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#col_17" aria-expanded="true" aria-controls="collapseOne">
				What if something’s damaged during a service?
				</a>
			  </h4>

				</div>
				<div id="col_17" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="six_17">
					<div class="panel-body"> 6666 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.le VHS.</div>
				</div>
			</div>


			<!-- --------------------------Panel-------------------------------- -->

    </div>

	<div class="col-md-6">

		<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="six_5">
					 <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#col_5" aria-expanded="true" aria-controls="collapseOne">
				 What if something I wanted cleaned is missed?
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
				What do you not clean?
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
				What if my scheduled cleaning service falls on a holiday?
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
				 Am I liable for employment taxes, workers’ compensation, or insurance?
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
				  Do I need to provide your team with my own cleaning equipment or supplies?
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
				Can I provide my cleaning team with special instructions?
				</a>
			  </h4>

				</div>
				<div id="col_13" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="six_13">
					<div class="panel-body"> 332 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.le VHS.</div>
				</div>
		</div>


			<!-- --------------------------Panel-------------------------------- -->


		<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="six_14">
					 <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#col_14" aria-expanded="true" aria-controls="collapseOne">
				What do you mean by “green housecleaning”?
				</a>
			  </h4>

				</div>
				<div id="col_14" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="six_14">
					<div class="panel-body"> 332 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.le VHS.</div>
				</div>
		</div>


		<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="six_15">
					 <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#col_15" aria-expanded="true" aria-controls="collapseOne">
			How soon can I take cleaning off my to-do list?
				</a>
			  </h4>

				</div>
				<div id="col_15" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="six_15">
					<div class="panel-body"> 332 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.le VHS.</div>
				</div>
		</div>


			<!-- --------------------------Panel-------------------------------- -->

		<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="six_16">
					 <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#col_16" aria-expanded="true" aria-controls="collapseOne">
			How do I pay?
				</a>
			  </h4>

				</div>
				<div id="col_16" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="six_16">
					<div class="panel-body"> 332 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.le VHS.</div>
				</div>
		</div>


			<!-- --------------------------Panel-------------------------------- -->


    </div>
    </div>


</div>
</div>


							</div>

						</div>
					</div>
				</div>
			 <!-- container close-->
	</section>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>

        $(document).ready(function(){
            $('.plans').click( async function(){
                var sessionCheck = "{{ \Session::get('auth_token') }}";
                if(sessionCheck == ''){
                    alert('Please login first')
                }else{

                    var brought = $(this).data('brought')
                    if(brought == '1'){
                        alert('Plan Already brought!');
                        return false;
                    }

                    var url = $(this).data('href');
                    $.ajax({
                        type:"get",
                        url:"{{ url('api/checkCart') }}",
                        beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
                        complete: function(e, xhr, settings){
                            console.log(e.responseJSON)
                            if(e.responseJSON.status == 200){
                                var check = e.responseJSON.body.housekeepingCart

                                if(check == '1'){

                                    var checkServiceSession = "{{ \Session::get('service') }}"
                                    var checkCardIdSession = "{{ \Session::get('cart_id') }}"


                                    if((checkServiceSession == 'Housekeeping') && (checkCardIdSession != '') ){
                                        location.replace(url)
                                        return false;
                                    }

                                    alert('Housekeeping plan already in cart.');
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


@endsection
