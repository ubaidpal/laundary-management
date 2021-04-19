@extends('layouts.web')

@section('content')


	<section class="banner">
		<div class="container-fluid">
			<div class="row align-items-center h-100">
				<div class="col-md-12 ">
					<div class="main_img  text-center btm_left ">
						<h2> Start Your New Year off  Fresh <br> Clean and On A Schedule.	</h2>

					</div>
				</div>
			</div><!-- row close-->
		</div> <!-- container close-->
	</section>

	<section class="pt-1" style="">
		<div class="container">
			<div class="row">
				<div class="col-md-6 offset-md-3">
					<div class=" get_service">
						<h2> Student Information</h2>
						<div class="contact_form pro_text">
                            <form enctype="multipart/form-data"  id="formData">
								<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label> First name:	</label>
									 <input type="text" name="first_name" class="form-control" required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> Last name:</label>
										<input type="text" name="last_name" class="form-control" required="">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label> Birthday </label>
										<input type="date" class="form-control" name="dob" min="1900-01-01" required="" placeholder="Date of Birth">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> Country Code </label>
										<input type="text" name="country_code" onkeypress="return isNumberCountryCode(event)" class="form-control" required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> Phone number </label>
										<input type="text" name="contact" onkeypress="return isNumber(event)" class="form-control" required="">
									</div>
								</div>
								<!--div class="col-md-12">
									<div class="form-group ">
										<label> Would you like to receive text message notifications about  your service? </label>
										<div class="check_box_yes">
										<p><input type="checkbox" name="favorite1" value="chocolate" /> Yes  </p>
										<p><input type="checkbox" name="favorite2" value="vanilla" /> No </p>
										</div>
									</div>
								</div-->
								<div class="col-md-6">
									<div class="form-group">
										<label> Username </label>
										<input type="text" name="username" class="form-control" required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> Email address </label>
										<input type="text" name="email" id="regester_email" class="form-control" required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> Password </label>
										<input type="password" name="password" id="regester_password" class="form-control" required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> Confirm Password </label>
										<input type="password" name="password_confirmation" class="form-control" required="">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label> What college do you attend? <span>*</span> </label>
										<input type="text" name="school_name" class="form-control">
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group ">
										<label> Do you live on campus?<span>*</span></label>
										<div class="Live">
								<label class="Live2"><input type="radio" id="radio1" name="in_campus" value="1"><span class="Live3">Yes</span></label>
								<label class="Live2"><input type="radio" id="radio2" name="in_campus" value="0"><span class="Live3">No</span></label>

                                <input type="hidden" name="in_campus_value" value="">
								</div>
									</div>
								</div>

								<div class="yes">


								<div class="col-md-12">
									<div class="form-group">
										<input type="text" name="hall"  placeholder="Enter Hall Name"  value="">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">

								<input type="text" name="room_number" placeholder="Enter Room number"  value="">
									</div>
								</div>
								</div>
								<div class="no">
								<div class="row">
								<div class="col-md-12">
									<div class="form-group ">
										<h5> Address</h5>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label> Service Address </label>
										<input type="text" name="address" class="form-control" required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> City  </label>
										<input type="text" name="city" class="form-control" required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> State  </label>
										<input type="text" name="state" class="form-control" required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> Zip Code  </label>
										<input type="text" name="zipcode" class="form-control" required="">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label> Country</label>
										<input type="text" name="country" class="form-control" required="">
									</div>
								</div>
								</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> Upload Your Photo  </label>
										<div class="Photo55"><label><input type="file" id="file" name="image"><figure><img src="images/cam.png"></figure><span> </span></label>
									</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> Upload Your Class Schedule  </label>
										<div class="Photo55"><label><input type="file" id="file1" name="schedule"><figure><img src="images/cam.png"></figure><span> </span></label>
									</div>
									</div>
								</div>

								</div>

						</div>
					</div>
					<div class=" get_service ">
						<h2> Parent Information</h2>
						<div class="contact_form pro_text">

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
										<label> First name:	</label>
										 <input type="text" name="pfirst_name" class="form-control" required="">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										<label> Last name:	</label>
										 <input type="text" name="plast_name" class="form-control" required="">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
										<label> Email address:	</label>
										 <input type="text"  name="pemail" class="form-control" required="">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										<label> Country Code:	</label>
										 <input type="text" name="pcountry_code" onkeypress="return isNumberCountryCode1(event)" class="form-control" required="">
										</div>
                                    </div>
                                    <div class="col-md-6">
										<div class="form-group">
										<label> Phone number:	</label>
										 <input type="text" name="pcontact" onkeypress="return isNumber1(event)" class="form-control" required="">
										</div>
									</div>

								</div>

							</div>
					</div>

					<div class=" get_service ">
						<h2>Billing Address</h2>
						<div class="contact_form pro_text">

								<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									<label> Address: </label>
									 <input type="text" name="billing_address" class="form-control" required="">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
									<label> City:	</label>
									 <input type="text" name="billing_city" class="form-control" required="">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
									<label> State </label>
									 <input type="text" name="billing_state" class="form-control" required="">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
									<label> Zipcode	</label>
									 <input type="text" name="billing_zipcode" class="form-control" required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label> Appartment Number <span>*</span>	</label>
									 <input type="text" name="appartment_number" class="form-control" required="">
									</div>
                                </div>
                                <div class="col-md-6">
									<div class="form-group">
									<label> Gate Code  <span>*</span>	</label>
									 <input type="text" name="gate_code" class="form-control" required="">
									</div>
								</div>
								</div>

							</div>
					</div>

					<div class=" get_service ">
						<h2> Payment Method</h2>
						<div class="contact_form pro_text">

								<div class="row">

								<div class="col-md-12">
									<div class="form-group">
									<label> Name on Card  <span>*</span>	</label>
									 <input type="text" name="name_on_card" class="form-control" required="">
									</div>
                                </div>
                                <div class="col-md-6">
									<div class="form-group">
									<label> Credit Card Type  <span>*</span>	</label>
                                        <select  name="card_type" class="form-control" required="">
                                            <option value="">Please Select Card type</option>
                                            <option value="1">Visa</option>
                                            <option value="2">Master Card</option>
                                        </select>
                                </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label> Credit Card Number  <span>*</span>	</label>
									 <input type="text" name="card_number" onkeypress="return cardNumber(event)"  class="form-control" required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label> Expire Month  <span>*</span>	</label>
									 <select name="expiry_month" class="form-control">
                                        <option value="" disabled selected>Please select month</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                     </select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
									<label> Expire Year  <span>*</span>	</label>
                                    <select name="expiry_year" id="expiry_year" class="form-control" required="">
                                       <option value="" disabled selected>Please select year</option>
                                    </select>
									</div>
								</div>
                                {{-- <div class="col-md-4">
									<div class="form-group">
									<label> CVV  <span>*</span>	</label>
									 <input type="text"  class="form-control" required="">
									</div>
								</div> --}}
								<div class="col-md-12">
									<div class="form-group ">
										<div class="check_box_yes">
										<p class="width_100"><input type="checkbox" name="terms" value="1"> I accept and understand Terms and Conditions.  </p>
										<p class="width_100"><input type="checkbox" name="policies" value="1"> I accept and understand the Privacy Policy.</p>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<button onclick="return false" id="continue"> Continue</button>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<img src="images/pay.png" >
									</div>
								</div>
								</div>

							</div>
					</div>
                </form>
                </div>

			</div><!-- row close-->

		</div> <!-- container close-->
	</section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the link that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

</script>
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

    $('#radio1').click(function(){
        $('.yes').addClass('ad12').siblings().removeClass('ad12');
        $('input[name="in_campus_value"]').val('1')
    });
    $('#radio2').click(function(){
        $('.no').addClass('ad12').siblings().removeClass('ad12');
        $('input[name="in_campus_value"]').val('0')
    });

    var years = [];
    // var date = date();
    var getCurrentYear = new Date().getFullYear();
    years.push(getCurrentYear);
    for(var i=1;i<10;i++ ){
        getCurrentYear = getCurrentYear + 1;
        years.push(getCurrentYear);
    }

    $.each(years, function(key, value) {
     $('#expiry_year')
         .append($("<option></option>")
                    .attr("value", value)
                    .text(value));
    });

    });

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

    function isNumber1(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57) ) {
            return false;
        }

        var pcontact = $('input[name="pcontact"]').val().length;

        if(pcontact != '' && pcontact > 10 ){
            return false
        }

        return true;
    }

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


    function isNumberCountryCode1(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57) ) {
            // alert(charCode);
            if(charCode == 43 ){
                return true;
            }
            return false;
        }

        var pcountry_code = $('input[name="pcountry_code"]').val().length;

        if(pcountry_code != '' && pcountry_code > 2 ){
            return false
        }

        return true;
    }

    function cardNumber(evt){
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57) ) {
            // alert(charCode);
            if(charCode == 43 ){
                return true;
            }
            return false;
        }

        var length = $('input[name="card_number"]').val().length
        if(length > 15 ){
            return false
        }
        return true;
    }

    $('.form-control').keypress(function(){
        if($(this).val().length < 70){
            return true;
        }else{
            return false;
        }
    })

      </script>

@endsection
