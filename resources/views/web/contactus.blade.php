@extends('layouts.web')

@section('content')

	<section class="banner">
		<div class="container-fluid">
			<div class="row align-items-center h-100">
				<div class="col-md-12 ">
					<div class="main_img  text-center btm_left ">
						<h2>Contact Us	</h2>
						<ul class="socils">
							<li><a href=""> <img src="{{asset('web/images/2.png')}}"> </a></li>
							<li><a href=""> <img src="{{asset('web/images/3.png')}}"> </a></li>
							<li><a href=""> <img src="{{asset('web/images/4.png')}}"> </a></li>
							<li><a href=""> <img src="{{asset('web/images/5.png')}}"> </a></li>
							<li><a href=""> <img src="{{asset('web/images/6.png')}}"> </a></li>
						</ul>
					</div>
				</div>
			</div><!-- row close-->
		</div> <!-- container close-->
	</section>

	<section class="">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<div class="contact_form">
						<h2> Send us an e-mail</h2>
						<form>
							<div class="form-group">
							 <input placeholder="Your First Name" name="first_name" type="text" class="form-control" required="">
                            </div>
                            <div class="form-group">
							 <input placeholder="Your Last Name" name="last_name" type="text" class="form-control" required="">
                            </div>
                            <div class="form-group">
							 <input placeholder="Your School Name" name="school_name" type="text" class="form-control" required="">
							</div>
							<div class="form-group">
								<input placeholder="Your Country Code" onkeypress="return isNumberCountryCode(event)" name="country_code" type="text" class="form-control" required="">
                            </div>
                            <div class="form-group">
								<input placeholder="Your Phone Number" onkeypress="return isNumber(event)" name="contact" type="text" class="form-control" required="">
							</div>
							<div class="form-group">
								<input placeholder="Your Email Address" id="email" type="email" class="form-control" required="">
							</div>
							<div class="form-group">
								<textarea id="message" name="message" placeholder="Message Details"></textarea>
							</div>
							<button onclick="return false" id="contactus"> Send Now</button>

							{{-- <p class="mt-4">This site is protected by reCAPTCHA and the Google Privacy Policy  and Terms of Service apply.</p> --}}
						</form>
					</div>
				</div>
				<div class="col-md-5 ">
					<div class="contact_form">
						<h2> Send us an e-mail</h2>
						<p> 2625 Coral Way, Miami, FL 33145</p>
						<div class="media position-relative cals align-items-center h-100">
						  <img src="{{asset('web/images/phone.png')}}" class="mr-3" alt="...">
						  <div class="media-body">
							<h5 class="">Call or Text Us </h5>
							<a>  305-707-4921</a>
						  </div>
					   </div>
					   <div class="media position-relative cals align-items-center h-100">
						  <img src="{{asset('web/images/phone2.png')}}" class="mr-3" alt="...">
						  <div class="media-body">
							<h5 class="">info@laundry305.net </h5>
						  </div>
					   </div>
					   <p> Hours</p>
						<div class="cals ">
							<h3> <span> Mon</span>    09:00 AM – 06:00 PM </h3>
							<h3> <span> Fri </span>         09:00 AM – 06:00 PM </h3>
							<h3> <span> Tue </span>    09:00 AM – 06:00 PM </h3>
							<h3> <span> Sat </span>   Closed</h3>
							<h3> <span> Wed </span>    09:00 AM – 06:00 PM </h3>
							<h3> <span> Sun </span>   Closed</h3>
							<h3> <span> The </span>    09:00 AM – 06:00 PM </h3>
					   </div>
					</div>
				</div>



			</div><!-- row close-->

		</div> <!-- container close-->
	</section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        function isNumberCountryCode(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57) ) {
                // alert(charCode);
                if(charCode == 43 ){
                    return true;
                }
                return false;
            }

            var country_code = $('input[name="country_code"]').val().length;

            if(country_code != '' && country_code > 2 ){
                return false
            }

            return true;
        }

        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57) ) {
                return false;
            }

            var contact = $('input[name="contact"]').val().length;

            if(contact != '' && contact > 10 ){
                return false
            }

            return true;
        }


    </script>


@endsection
