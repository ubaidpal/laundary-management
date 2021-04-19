@extends('layouts.web')

@section('content')

	<section class="f late_back1" style="background:u rl('images/get_serv.png')">
		<div class="container">
			<div class="row">
				<div class="col-md-7 mx-auto">
					<div class=" get_service1">
					  <div class="booking">
						<h2> Cancel your booking.</h2>
						<p class="mt-3">Great! Few details and we can complete your booking. </p>
					  </div>

						<div class="contact_form1">

							<form>
							<div class="inform">
							<strong><i class="fa fa-info-circle" aria-hidden="true"></i> Important Information</strong>
							<p class="">We would like to see you keep this service active. If there is anything we can do to make that happen, just give us a <b>call right now at 231-421-7160</b></p>
                            </div>
                            <br>
								<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									<label>Cancellation Reason</label>
                                     {{-- <input type="email" class="form-control" placeholder="First name**" required=""> --}}
                                     <select name="reason" class="form-control">
                                         <option selected disabled> Please Select</option>
                                         <option value="Not implemented in time"> Not implemented in time.</option>
                                         <option value="Loss of key user or advocate"> Loss of key user or advocate. </option>
                                         <option value="Poor utilization and/or adoption."> Poor utilization and/or adoption. </option>
                                         <option value="Not realizing the value proposition"> Not realizing the value proposition </option>
                                         <option value="Lack of features in the product"> Lack of features in the product </option>
                                     </select>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
									<label>Briefly Describe your reason for Cancellation</label>
									 <textarea placeholder="Write here..." name="description" class="form-control"></textarea>
									</div>
								</div>
								 <div class="col-md-12">
								<div>
							<p><strong><i class="fa fa-info-circle" aria-hidden="true"></i> </strong> Your site will be disabled at the end of your billing cycle. If you require that your site be disabled, please submit a support ticket and our Team will process the request. </p>
							{{-- <p class="">Y</p> --}}
							</div>
							</div>

							        <div class="col-md-12">
									<div class="form-group">
										<a href="" type="submit" onclick="return false" class="apply cancel"> Submit </a>
									</div>
							    </div>

								</div>

							</form>
						</div>


				</div><!-- get_service close-->
			</div>

		</div><!-- row close-->
	</div> <!-- container close-->
</section>



@endsection







