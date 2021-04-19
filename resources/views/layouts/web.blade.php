<!DOCTYPE html>
<html>
   <head>
      <title>Laundry 305</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
      <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon.png')}}">
      <link href="{{asset('web/css/bootstrap.css')}}" rel="stylesheet" />
      <!--<link href="css/aos.css" rel="stylesheet" /> -->
      <link href="{{asset('web/css/owl.carousel.css')}}" rel="stylesheet">
      <link href="{{asset('web/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
	  <script src="https://kit.fontawesome.com/2b7d98f67f.js"></script>

   </head>
   <body class="plane_back bg_size ">

   <div id="myModal" class="modal fade sing_in_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <p> Get Started Now  your first month of service"</p>
		<h2> Receive 15% OFF</h2>
		<p>Lorem ipsum, or lipsum as it  is dummy text Terms and Privacy </p>
		<form class="mt-4">
			<div class="form-group">
			 <input placeholder="Enter Your Email" type="email" class="form-control"  required="">
			</div>
			<div class="form-group">
				<div class="log_button">
					<input type="submit" value="GET CODE ">
				</div>
			</div>
			<div class=" sign_up">
				<p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. </p>
			</div>
		</form>
      </div>
    </div>

  </div>
</div>


{{-- <div id="forget" class="modal fade sing_in_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <p>Receive 15% off your first month of service"</p>
		<h2> Get Started Now</h2>
		<a href="" ><img src="{{asset('web/images/signin.png')}}" ></a>
		<h4> or </h4>
		<form>
			<div class="form-group">
			 <input placeholder="Enter Your Email" type="email" class="form-control"  required="">
			</div>
			<div class="form-group">
				<input placeholder="Password" type="password" class="form-control"  required="">
			</div>
			<div class="form-group">
				<div class="log_btn_text">
					<a data-toggle="modal" data-target="#forget" id="for_get">Forgot Password? </a>
				</div>
			</div>
			<div class="form-group">
				<div class="log_button">
					<input type="submit" value="Log In ">
				</div>
			</div>
			<div class=" sign_up">
				<p>By Signing up I agree to the Terms and Privacy
Policy. I also gree to recieve periodic emails with
offers and promotional arketing messages from DormDoctors </p>
			</div>
		</form>
      </div>
    </div>

  </div>
</div> --}}


<div id="log_me_in" class="modal fade profile_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop text-center">
			<div class="pro_pop house_kep">
						<p><img src="{{asset('web/images/logo.png')}}"> </p>

						<form class="mt-5">
							<div class="form-group">
								<label> Username/Email</label>
								<input type="text" id="email" placeholder="Enter email " >
							</div>
							<div class="form-group">
								<label> Password</label>
								<input type="password" id="password" placeholder="Password" >
							</div>
							<div class="form-group text-right">
								<div class="log_btn_text">
									<a data-toggle="modal" onclick="return false;" id="for_get2">Forgot Password? </a>
								</div>
							</div>
						</form>
			</div>
				 <h3>
					<a href="" id="login" onclick="return false" class="width_100" >Log In </a>
				 </h3>
		</div>
      </div>
    </div>

  </div>
</div>

<div id="forgetpassword" class="modal fade sing_in_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
          <button type="button" class="close-1" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}"></button>
        {{-- <p>Receive 15% off your first month of service"</p> --}}
		<h2> Forget Password</h2>
			<div class="form-group">
			 <input placeholder="Enter Your Email" name="email" type="email" class="form-control"  required="">
			</div>
			<div class="form-group">
				<div class="log_button">
					<input type="submit" class="width_100" id="forgetpasswordlink" style="background: #f29f00;" value="Send ">
				</div>
            </div>

      </div>
    </div>

  </div>
</div>

<div id="thnk_you1" class="modal fade profile_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop text-center">
			<div class="pro_pop house_kep">
						<p><img src="{{asset('web/images/logo.png')}}"> </p>
						<h2>Forget Password</h2>
						<p id="forgetpassword_message"></p>

			</div>
						 <h3>
							<a href="" onclick="return false" data-dismiss="modal" class="width_100" >Done </a>
						 </h3>
		</div>
      </div>
    </div>

  </div>
</div>



      <header class="--fixed-top print" id="navbar" >
         <div class="container">
            <div class="row">
					<div class="col-md-12">
						<ul class="navbar-nav_custom ">
                            {{-- {{dd(\Session::get('auth_token'))}} --}}
                            @if(\Session::get('auth_token'))
                        <li class="nav-item"><a class="nav-link cart_on"  href="{{ route('web.cart') }}" > <img src="{{asset('web/images/cart1.png')}}" > <span id="cartNumber"> 0</span> </a></li>

                                <li class="nav-item"><a class="nav-link sing_up" id="logout" onclick="return false"  href="">Logout</a></li>
                            @else

                             <li class="nav-item"><a class="nav-link log_in"  data-toggle="modal" data-target="#log_me_in" > Login</a></li>

                        <li class="nav-item"><a class="nav-link sing_up"  href="{{ route('web.register') }}">Register</a></li>
                            @endif

						</ul>
					</div>
					<div class="col-md-12">
							<nav class="navbar navbar-expand-lg  back_nav">
							<!--  Show this only on mobile to medium screens  -->
							  <a class="navbar-brand d-lg-none" href="#">Navbar</a>
							  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							  </button>

							<!--  Use flexbox utility classes to change how the child elements are justified  -->
							  <div class="collapse navbar-collapse justify-content-between" id="navbarToggle">

								<ul class="navbar-nav">

								  <li class="nav-item">
									<a class="nav-link" href="{{route('web.home')}}">Laundry</a>
								  </li>
								  <li class="nav-item">
									<a class="nav-link" href="{{route('web.housekeeping')}}">Housekeeping</a>
                                  </li>
                                  <li class="nav-item">
									<a class="nav-link" href="{{route('web.storage')}}">Storage</a>
								  </li>
								</ul>
								<!--   Show this only lg screens and up   -->
                                <a class="navbar-brand d-none d-lg-block" href="{{ route('web.home') }}"><img src="{{asset('web/images/logo.png')}}" ></a>
								<ul class="navbar-nav">
								  <li class="nav-item">
									<a class="nav-link" href="{{route('web.faq')}}">Faq</a>
                                  </li>
                                  <li class="nav-item">
									<a class="nav-link active" href="{{route('web.aboutus')}}">About US <span class="sr-only">(current)</span></a>
                                  </li>
                                  @if(\Session::has('user_id'))
								  <li class="nav-item">
									<a class="nav-link more_color" href="{{route('web.profile')}}">Profile</a>
                                  </li>
                                  @endif
								</ul>
							  </div>
							</nav>
					</div>
            </div>
         </div>
      </header>

      @yield('content')

      @if(!(\Session::get('auth_token')))
	<section class="banner_5 print" >
	<div class="container">
			<div class="row align-items-center h-100">
				<div class="col-md-12 ">
					<div class="enjoy_today ">
						<h2>Enjoy Our Laundry Service From Today!  <a href="register.html" >Sign Up Now</a></h2>
					</div>
				</div>
			</div>
		</div>
	</section>
    @endif

<section class="banner_6 print" >
	<div class="container">
			<div class="row align-items-center h-100">
				<div class="col-md-12 ">
					<div class="btm_nav ">
						<ul>
							<li><a href="{{route('web.aboutus')}}" > ABOUT US </a></li>
							<li><a href="{{route('web.getservice')}}" > WORK WITH US  </a></li>
							<li><a href="{{route('web.contactus')}}" > CONTACT US </a></li>
							<li><a href="{{route('web.policies')}}" > PRIVACY POLICY </a></li>
							<li><a href="{{route('web.terms')}}" > TERMS OF SERVICE </a></li>
						</ul>
						<p>Call or Text 305-707-4921  </p>
					</div>
				</div>
			</div>
		</div>
</section>

<footer class="banner_7 print">


    <div class="container">
			<div class="row align-items-center h-100">
				<div class="col-md-6">
					<div class="btm_left ">
						<p>Copyright © 2019 Laundry 305 - All Rights Reserved. </p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="btm_left ">
						<ul>
							<li><a href="" > <img src="{{asset('web/images/2.png')}}" > </a></li>
							<li><a href="" > <img src="{{asset('web/images/3.png')}}" > </a></li>
							<li><a href="" > <img src="{{asset('web/images/4.png')}}" > </a></li>
							<li><a href="" > <img src="{{asset('web/images/5.png')}}" > </a></li>
							<li><a href="" > <img src="{{asset('web/images/6.png')}}" > </a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
</footer>

            <div class="loader" id="wait" style="display:none" ></div>

<script src="{{asset('web/js/jquery.min.js')}}"></script>
<script src="{{asset('web/js/bootstrap.js')}}"></script>
<script src="{{asset('web/js/owl.carousel.js')}}"></script>

      <!-- <script src="js/aos.js"></script> -->

@include('layouts.apiCalls')

<script>
        $(document).ready(function() {
      $("#banner").owlCarousel({
        navigation : false,
		loop:true,
		autoPlay: 3000,
		slideSpeed : 4000,
 		items :1,
        itemsCustom : false,
        itemsDesktop : [1199, 1],
        itemsDesktopSmall : [979, 1],
        itemsTablet : [768, 1],
        itemsTabletSmall : false,
        itemsMobile : [479, 1],
      });
    });

    $(document).ready(function(){
        $('#for_get2').click(function(){
            $('#log_me_in').modal('hide');
            $('#forgetpassword').modal('show')
        });
    })


$(document).ajaxStart(function(){
    $("#wait").css("display", "block");
    $('body').addClass('loading');
});
$(document).ajaxComplete(function(){
    $("#wait").css("display", "none");
    $('body').removeClass('loading');
});


    function checkCart(){
        $.ajax({
            type:"get",
            url:"{{ url('api/checkCart') }}",
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            complete: function(e, xhr, settings){
                if(e.responseJSON.status == 200){
                    var total = parseInt(e.responseJSON.body.laundryCart) + parseInt(e.responseJSON.body.housekeepingCart) + parseInt(e.responseJSON.body.storageCart)


                    $('#cartNumber').html(total)
                }

            }
        });
    }

    checkCart()

    </script>
   </body>
</html>

