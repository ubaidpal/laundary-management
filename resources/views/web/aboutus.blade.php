@extends('layouts.web')

@section('content')

<section class="banner">
		<div class="container-fluid">
			<div class="row align-items-center h-100">
				<div class="col-md-6">
					<div class="main_img text-center">
						<img src="{{asset('web/images/img2.png')}}" >
					</div>
				</div>
				<div class="col-md-5 ">
					<div class="main_img ">
						<h2>#Collage</h2>
						<p> From Begining to End,</p>
						<p> Each School Every den,</p>
						<p> We do it all,</p>
						<p> Every Spring,</p>
						<p> Every Fall.</p>
					</div>
				</div>
			</div><!-- row close-->
		</div> <!-- container close-->
	</section>

	<section class="about _back">
		<div class="container">
		  <div class="abt_us_main_2">
			<div class="row align-items-center h-100">
				<div class="col-md-6 ">
					<div class="main_img padding_right">
						<h2> About Us</h2>
						<p> School is hard enough, running out of clean clothes shouldn’t be!</p>
						<p> Founded with the intent to enhance the freshman experience for college students, Laundry 305’s promises to provide an excellent laundry and dry cleaning experience each and every time. Your clothes are important to you. When you look good, we look good.</p>
						<p>We never sacrifice quality or customer service. We follow your specifications and make sure that your clothes smell fresh and are returned to you as requested. </p>
						<p> We are a phone call or click away; easily accessible and ready to respond to any questions you may have…and yes, if there ever is a problem, rest assured that we will address it immediately.</p>
						<p> Confident in our ability to maintain excellence in quality, price, and time, our goal is to enhance the college experience for every student and parent. From start to finish - we do it all .
</p>
						<p> Laundry 305, <br>
The wash and fold solution for students!</p>


					</div>
				</div>
				<div class="col-md-6">
					<div class="main_img text-center">
						<img src="{{asset('web/images/about.png')}}" >
					</div>
				</div>
			</div><!-- row close-->
		  </div>
		</div> <!-- container close-->
	</section>

	<section class="banner_3 plane_back">
		<div class="container-fluid">
			<div class="row align-items-center h-100">
				<div class="col-md-12 ">
					<div class="how_much ">
						<h2> How Exclusive Works</h2>
					</div>
				</div>
			</div><!-- row close-->
			<div class="row mt-5">
				<div class="col-md-4 ">
					<div class="abut_serve ">
						<h3> Laundry</h3>
						<img src="{{asset('web/images/ab1.png')}}" >
						<p><img src="{{asset('web/images/latu.png')}}" > Pick your plan and pay per smester</p>
						<p><img src="{{asset('web/images/latu.png')}}" > Pick your plan and pay per smester</p>
						<p><img src="{{asset('web/images/latu.png')}}" > Pick your plan and pay per smester</p>
                    <a class="more_color" href="{{ route('web.home') }}">Learn More</a>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="abut_serve active_plan" style="background:#70d0ef;">
						<h3> Housekeeping</h3>
						<img src="{{asset('web/images/ab2.png')}}" >
						<p><img src="{{asset('web/images/latu1.png')}}" > Pick your plan and pay per smester</p>
						<p><img src="{{asset('web/images/latu1.png')}}" > Pick your plan and pay per smester</p>
						<p><img src="{{asset('web/images/latu1.png')}}" > Pick your plan and pay per smester</p>
						<a class="more_color" href="{{route('web.housekeeping')}}">Learn More</a>
					</div>
				</div>
				<div class="col-md-4 ">
					<div class="abut_serve " style="background:#4c6cb9;">
						<h3> Storage</h3>
						<img src="{{asset('web/images/ab3.png')}}" >
						<p><img src="{{asset('web/images/latu.png')}}" > Pick your plan and pay per smester</p>
						<p><img src="{{asset('web/images/latu.png')}}" > Pick your plan and pay per smester</p>
						<p><img src="{{asset('images/latu.png')}}" > Pick your plan and pay per smester</p>
						<a class="more_color" href="{{route('web.storage')}}">Learn More</a>
					</div>
				</div>
			</div>



		</div> <!-- container close-->
	</section>

	<section class=" banner_bg">
		<div class="container">
			<div class="row align-items-center h-100 margin_top">
				<div class="col-md-12 ">
					<div class="how_much house_plan ">
						<h2> Schools We Service</h2>
						<p> Laundry will serve all students and local residents in the 305 <br> neighboring any of our amezing collage locations.</p>
					</div>
				</div>
			</div>
			<div class="row align-items-center h-100 ">
				<div class="col-md-3 ">
					<div class="scholls ">
						<img src="images/sc1.png" >
					</div>
				</div>
				<div class="col-md-3 ">
					<div class="scholls ">
						<img src="images/sc2.png" >
					</div>
				</div>
				<div class="col-md-3 ">
					<div class="scholls ">
						<img src="images/sc3.png" >
					</div>
				</div>
				<div class="col-md-3 ">
					<div class="scholls ">
						<img src="images/sc4.png" >
					</div>
				</div>
			</div>
		</div>



			 <!-- container close-->
	</section>


@endsection
