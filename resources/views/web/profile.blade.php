@extends('layouts.web')

@section('content')

<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

<div id="notes" class="modal fade profile_model big_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<div class="">
												<div class="notify_all">
                                                <h3> Notifications</h3>

                                                @if(count($notifications) > 0)

                                                @foreach ($notifications as $noty)
                                                    <div class="notify">
													<h4> {{$noty->title}} <span> {{ $noty->created_at }}</span></h4>
													<p>{{ $noty->text }}</p>
                                                </div>
                                                @endforeach

                                                @else

                                                <h4 style="margin-top: 40px;">No notifications found!</h4>

                                                @endif

												</div>
											</div>
      </div>
    </div>

  </div>
</div>
<div id="com1" class="modal fade profile_model big_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<div class="tab_in">
										<h1 > Laundry Inventory </h1>
										{{-- <div class="form-group order_list">
											<select>
												<option value="" disabled> Please select Quantity</option>
												<option value="1" > 1 </option>
												<option value="2" > 2 </option>
												<option value="3" > 3 </option>
												<option value="4" > 4 </option>
												<option value="5" > 5 </option>
												<option value="6" > 6 </option>
											</select>
											<label> Towels</label>
                                        </div> --}}


										<div class="my_lundry" id="laundry_inventry_submit" >
											<a href="" onclick="return false" type="submit" data-dismiss="modal"  id="laundry_next" class="apply sub_btn"> Submit </a>

											<a data-toggle="modal" data-target="#add_cart3 " id="open_dryclean" data-dismiss="modal">I Have Dry Cleaning </a>
										</div>
										</div>
      </div>
    </div>

  </div>
</div>

<div id="add_cart3" class="modal fade profile_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1" id="close_dryclean" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop text-center">
		<img src="{{asset('web/images/logo.png')}}" >
		<div class="add_Cart_list">
            <h3> Dry Cleaning <span> Qty.</span></h3>
            <div id="dryclean_items">

            </div>

		</div>
		 <h3>
			<a href="" class="width_100"  data-toggle="modal" data-target="#com1 " data-dismiss="modal"> Done </a>
		 </h3>
		</div>
      </div>
    </div>
  </div>
</div>

<div id="dated" class="modal fade profile_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop1">
		<img src="{{asset('web/images/IMG_0995.png')}}">
		<h2>Houskeeping </h2>
		<h4>Reschduled </h4>
		 <div class="form-group">
		<label> Clean my space Date</label>
		<input type="date" name="housekeeping_pickup_date" placeholder="Select a date">
		</div>
		  <div class="form-group">
		<label> Clean my space Time</label>
		<input type="time" name="housekeeping_pickup_time" placeholder="Select a Time">
		</div>
		  <div class="form-group">
		<label> Address</label>
		<input type="text" name="housekeeping_address" placeholder="Select a Address">
		</div>

		<a href="" onclick="return false" id="housekeeping_reschedule_done" class="yellow_btn" > Done</a>
		</div>
      </div>
    </div>

  </div>
</div>

<div id="for_g" class="modal fade profile_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop text-center">
			<div class="pro_pop house_kep">
						<p><img src="{{asset('web/images/logo.png')}}"> </p>

							<h2> Change Password</h2>
							{{-- <div class="form-group mt-3">
								<label> Old Password</label>
								<input type="password" name="oldpassword" placeholder="******** ">
							</div> --}}
							<div class="form-group">
								<label> New Password</label>
								<input type="password" name="newpassword" placeholder="******** ">
							</div>
							<div class="form-group">
								<label> Confirm Password</label>
								<input type="password" name="newpassword_con" placeholder="******** ">
							</div>

			</div>
				 <h3>
					{{-- <a href="" class="width_100" data-toggle="modal" data-target="#thnk_you" >Submit </a> --}}
					<a href="" class="width_100" id="changepassword" data-toggle="modal" >Submit </a>
				 </h3>
		</div>
      </div>
    </div>

  </div>
</div>

<div id="thnk_you" class="modal fade profile_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop text-center">
			<div class="pro_pop house_kep">
						<p><img src="{{asset('web/images/logo.png')}}"> </p>
						<h2>Change Password </h2>
						<p>Your Password has been successfully updated. </p>

			</div>
						 <h3>
							<a href="" onclick="return false" data-dismiss="modal" class="width_100" >Done </a>
						 </h3>
		</div>
      </div>
    </div>

  </div>
</div>

<div id="overcharges" class="modal overflow-auto fade profile_model" role="dialog">

  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop1">

		<h2>reviews </h2>

		 <div class="pro_plan_blue orng">
                                     <h5 style="width: 200px;">Item</h5>
                                     <h6 class="transaction_date"></h6>
                                     <div id="dryclean_items_show">


                                    </div>

                                     <div class="tm tot tot1"><strong>Gratuity </strong>
                                        <span>
                                        $ <em id="gratuity_select_disocunt">0.0</em>
                                        ( <em id="gratuity_select_disocuntpercentage" >0</em>
                                        %)
                                        </span>
                                        </div>
									  <div class="blue_part">
									  <table>
									  <tr>
									  <td class="gratiity_select" data-value="18" style="cursor: pointer">18%</td>
									  <td class="gratiity_select" data-value="20" style="cursor: pointer">20%</td>
									  <td class="gratiity_select" data-value="22" style="cursor: pointer">22%</td>
									  <td class="gratiity_select" data-value="other" style="cursor: pointer" >Others</td>
									  </tr>
                                      </table>
                                      </div>

                                    <div class="tm tot" id="gratuity_input" style="display: none;" >
                                        <div class="col-md-8">
                                          <input type="type" name="gratuity" value="0" onkeypress="return checkGratiuty(event)"  class="form-control">
                                          <input type="hidden" name="gratuity_amount" value="0" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <a href="" onclick="return false" class="yellow_btn" id="grautity_apply" style="    margin-top: 0px;"> Apply</a>
                                        </div>
                                    </div>

									   {{-- <div class="tm tot"><strong>Overage Charges </strong><span> $0</span></div> --}}
									   <div class="tm tot"><strong>Subtotal </strong><span>  $ <span id="laundrysubtotal">15.99</span></span></div>
									   <div class="tm tot"><strong>Total    </strong><span>  $ <span id="laundrytotal">15.99</span></span></div>
									  </div>

								</div>

								<div class="defultcrd">
								<strong>Default Payment Method</strong>
								{{-- <a href="">Change Card</a> --}}
								</div>
								<div class="pro_plan_blue orng">
									 <div class="cards11">
                                         <img src="{{asset('web/images/visa2.png')}}" style='width: 70px;' class="mr-4" alt="...">
									 <div class="dot1"><span></span></div>
									 <div class="card_data11">
									 <strong class="cardlastdigits"></strong>
									 <span class="cardadded"></span>
									 </div>
									 </div>

								</div>

                                <input type="hidden" name="laundry_card_id" value="">
                                <input type="hidden" name="laundry_token" value="">
                                <input type="hidden" name="laundry_total" value="">

		<a href="" class="yellow_btn" onclick="return false" id="submit_laundry" > Pay Now</a>
		</div>
      </div>
    </div>

  </div>

 <div id="add_cart" class="modal fade profile_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop text-center">
		<img src="{{asset('web/images/logo.png')}}" >
		<div class="add_Cart_list" id="housekeeping_items" style="overflow-y: scroll;height: 350px;">

			{{-- <p> <input type="checkbox" > Organizing closet: $59.99</p>
			<p> <input type="checkbox" > 1 load of laundry with folding:  $29.99</p>
			<p> <input type="checkbox" > Vacuum Air vents: $39.99</p>
			<p> <input type="checkbox" > Inside oven: $29.99</p>
			<p> <input type="checkbox" > Inside fridge: $29.99</p>
			<p> <input type="checkbox" > Inside kitchen cabinets: $29.99</p>
			<p> <input type="checkbox" > Interior windows: $39.99</p>
			<p> <input type="checkbox" > Hourly work (2 hours min): $59.99</p>
			<p> <input type="checkbox" > Move in / move out: $109.99 </p> --}}
		</div>
		 <h3>
			<a href="" onclick="return false" class="width_100" id="housekeeping_items_proceed" data-dismiss="modal" > Proceed </a>
		 </h3>
		</div>
      </div>
    </div>

  </div>
</div>






<div id="Save_Preferences" class="modal fade profile_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop text-center">
			<div class="pro_pop house_kep">
						<h2>Laundry Locker </h2>
						<p>Sorry, there are no laundry lockers on your campus yet. Please select  another option. </p>

			</div>
					 <h3>
						<a href="" class="width_100" >Ok </a>
					 </h3>
		</div>
      </div>
    </div>

  </div>
</div>
<div id="add_cart2" class="modal fade profile_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop text-center">
			<div class="pro_pop house_kep">
						<h2>Housekeeping </h2>
						<p>Reminder </p>
						<h4>Your home cleaning has been <br> Reschduled to:  </h4>
						<form>
							<div class="form-group">
								<label> Date</label>
								<input type="text" placeholder="Select a date" >
							</div>
							<div class="form-group">
								<label> Time</label>
								<input type="text" placeholder="Select a time" >
							</div>
						</form>
			</div>
		 <h3>
			<a href="" class="width_100" >Submit </a>
		 </h3>
		</div>
      </div>
    </div>

  </div>
</div>

<div id="edit_details" class="modal fade profile_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop text-center">

			<div class="pro_pop house_kep">
						<h2> Edit Personal Details </h2>
						<form id="editprofile_data"  >
						    <div class="form-group">
      <label for="name">Profile Image:</label><br>

      @if($data->profile_image)
        <img id="blah" src="{{ $data->profile_image }}" alt="your image" width="100">
      @else
        <img id="blah" src="{{asset('images/preview-icon.png')}}" alt="your image" width="100">
      @endif
        <br><br>
      <input type="file" class="form-control w-45" id="imgInp" name="image">
      @if($errors->first('image'))
      <span class="text text-danger">* {{ $errors->first('image') }}</span>
      @endif
    </div>

							<div class="form-group">
							<div class="row">
							<div class="col-md-6">
							<label> First Name</label>
								<input type="text" name="first_name" placeholder="Enter first name"  value="{{$data->first_name}}">
							</div>
							<div class="col-md-6">
								<label> Last Name</label>
								<input type="text" name="last_name" placeholder="Enter last name"  value="{{$data->last_name}}">
							</div>
							</div>
							</div>
							<div class="form-group">
								<label> Country Code</label>
								<div class="input-group">
						        <input type="text" name="country_code" onkeypress="return isNumberCountryCode(event)" placeholder="Enter country code"  value="{{$data->country_code}}">

							</div>
                            </div>
                            <div class="form-group">
								<label> Phone</label>
								<div class="input-group">
						        <input name="contact" onkeypress="return isNumber(event)" placeholder="Enter phone number" type="text" value="{{$data->contact}}">

							</div>
							</div>
							<div class="form-group">
								<label> Email</label>
                            <input type="text" name="email" placeholder="Enter email" placeholder="Select a date"  value="{{ $data->email }}">
							</div>
							<div class="form-group">
								<label> DOB</label>
                            <input type="date" name="dob" placeholder="Enter date of birth"  value="{{ $data->dob }}">
							</div>
							<div class="form-group">
								<label> School Name</label>
                            <input type="text" name="school_name" placeholder="Enter school name"  value="{{ $data->school_name }}">
							</div>

							<div class="form-group">
								<label> Do You Live In Campus?</label>
								<div class="Live">
								<label class="Live2"><input type="radio" class="radio1" value="1" name="in_campus"><span class="Live3">Yes</span></label>
								<label class="Live2"><input type="radio" class="radio2" value="0" name="in_campus"><span class="Live3">No</span></label>

								</div>
							</div>
							<div class="yes">
							<div class="form-group">
                                <label> Hall Name</label>
                            <input type="text" name="hall"  placeholder="Enter hall name"  value="{{ $data->hall }}">
							</div>
							<div class="form-group">
                                <label> Room number</label>
                            <input type="text" name="room_number" placeholder="Enter room number"  value="{{ $data->room_number }}">
							</div>
							</div>

							<div class="no ">
							<div class="form-group">
								<label> Address</label>
                            <input type="text" name="address" placeholder="Enter Address"  value="{{ $data->address }}">
							</div>
							<div class="form-group">
								<label> City</label>
                            <input type="text" name="city" placeholder="Enter City"  value="{{ $data->city }}">
							</div>
							<div class="form-group">
								<label> State</label>
                            <input type="text" name="state" placeholder="Enter state"  value="{{ $data->state }}">
							</div>
							<div class="form-group">
								<label> Zip Code</label>
                            <input type="text" name="zipcode" placeholder="Enter zipcode"  value="{{ $data->zipcode }}">
							</div>
							<div class="form-group">
								<label>Country</label>
                            <input type="text" name="country" placeholder="Enter country"  value="{{ $data->country }}">
							</div>
							</div>

						</form>
			</div>
		 <h3>
			<a href="" onclick="return false" class="width_100" id="editprofile" > Update </a>
		 </h3>
		</div>
      </div>
    </div>

  </div>
</div>

<div id="thnk_you2" class="modal fade profile_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		{{-- <button type="button" class="close-1" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button> --}}
        <div class="pro_pop text-center">
			<div class="pro_pop house_kep">
						<p><img src="{{asset('web/images/logo.png')}}"> </p>
						<h2>Profile Updated</h2>
						<p id="profileupdate_message"></p>

			</div>
						 <h3>
							<a href="" onclick="return false" id="editprofiledone" class="width_100" >Done </a>
						 </h3>
		</div>
      </div>
    </div>

  </div>
</div>


<div id="cancel_upgrade" class="modal fade profile_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop text-center">
		<img src="{{asset('web/images/ck.png')}}" >
		<p>Are you sure you want to  cancel this subscription?</p>
		 <h3>
            <a href="" onclick="return false" class="cancel_subscription" > Yes, Continue </a>
            <input type="hidden" name="cancel_id">
			<a href="" onclick="return false" class="" data-dismiss="modal" style="background: #70d0ef;"> No, Cancel </a>
		 </h3>
		</div>
      </div>
    </div>

  </div>
</div>


<div id="oder_upgrade" class="modal fade profile_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop text-center">
		<img src="{{asset('images/tub.png')}}" >
		<p>I Have Dry Cleaning</p>
		 <h3>
			<a href="" class="" style="background: #70d0ef;"> Yes </a>
			<a href="" class="" style="background: #70d0ef;"> No </a>
		 </h3>
		</div>
      </div>
    </div>

  </div>
</div>

<div id="storge_id2" class="modal fade profile_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop">
		<h2>Housekeeping  </h2>
		<p>Upgrade
			<Select>
				<option>Weekly</option>
				<option>Bi-weekly</option>
				<option>Once per week</option>
			</select>
		</p>
		<a href="" class="yellow_btn" > Add</a>
		</div>
      </div>
    </div>

  </div>
</div>
<div id="storge_id" class="modal fade profile_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop">
		<h2>Laundry </h2>
		<p>Weight per week
			<Select>
				<option> 10 lps</option>
			</select>
		</p>
		<a href="" class="yellow_btn" > Add</a>
		</div>
      </div>
    </div>

  </div>
</div>

<div id="upgrade" class="modal fade profile_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop1">
		<img src="{{asset('web/images/IMG_0995.png')}}">
		<h2>Storage </h2>
		<h4>Reschduled </h4>
		 <div class="form-group">
		<label> Deliver my packing Materials Date</label>
		<input type="date" id="dropoff_date_storage" name="dropoff_date" placeholder="Select a date">
		</div>
		  <div class="form-group">
		<label> Deliver my packing Materials Time</label>
		<input type="time" id="dropoff_time_storage" name="dropoff_time" placeholder="Select a Time">
		</div>
		  <div class="form-group">
		<label> From</label>
		<input type="text" id="dropoff_address_storage" name="droppoff_address" placeholder="Select a Address">
		</div>

		<a href="" onclick="return false" id="storage_update_dropoff" class="yellow_btn" > Done </a>
		</div>
      </div>
    </div>

  </div>
</div>

<div id="upgrade1" class="modal fade profile_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop1">
		<img src="{{asset('web/images/IMG_0995.png')}}">
		<h2>Storage </h2>
		<h4>Reschduled </h4>
		 <div class="form-group">
		<label> Pick my summer storage on Date</label>
		<input type="date" id="pickup_date_storage" name="pickup_date" placeholder="Select a date">
		</div>
		  <div class="form-group">
		<label> Pick my summer storage on Time</label>
		<input type="time" id="pickup_time_storage" name="pickup_time" placeholder="Select a Time">
		</div>
		  <div class="form-group">
		<label> From</label>
		<input type="text" id="pickup_address_storage" name="pickup_address" placeholder="Select a Address">
		</div>


		<a href="" onclick="return false" id="storage_update_pickup" class="yellow_btn" > Done</a>
		</div>
      </div>
    </div>

  </div>
</div>

<div id="review_houskeeping" style="overflow: scroll;" class="modal fade profile_model" role="dialog">

  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop1">

		<h2>Review </h2>

		 <div class="pro_plan_blue orng" id="houskeeping_insert_item_maindiv">
									 <h5 id="houskeeping_insert_item">Item</h5>
									 {{-- <div class="tm"><strong>Inside Frige</strong><span>$29.20</span></div>
									 <div class="tm"><strong>Lighting Feature</strong><span>$2.20</span></div> --}}
									 <div class="tm tot"><strong>Total</strong><span id="housekeeping_total"></span></div>

								</div>

								{{-- <div class="defultcrd">
								<strong>Default Payment Method</strong>
								<a href="">Change Card</a>
                                </div> --}}


								<div class="pro_plan_blue orng">
									 <div class="cards11">
                                         <div class="dot1"><span></span></div>
                                         <img src="{{asset('web/images/visa2.png')}}" style='width: 70px;' class="mr-4" alt="...">
									 <div class="card_data11">
									 <strong class="cardlastdigits"></strong>
									 <span class="cardadded"></span>
									 </div>
									 </div>

								</div>

            <input type="hidden" name="housekeeping_card_token" value="">
            <input type="hidden" name="housekeeping_card_id" value="">
            <input type="hidden" name="housekeeping_addons" value="">

		<a href="" onclick="return false" class="yellow_btn" id="housekeeping_paynow" > Pay Now</a>
		</div>
      </div>
    </div>

  </div>
</div>

 <div id="AllClaims" class="modal fade profile_model" role="dialog">

  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop1">

		<h2>All Claims </h2>
		</div>
			 <div class="tabels">
							 	<table class="dat12 all_claims">

								<tbody class="claimData">
								{{-- <tr>
								<td><img src="images/apl.png"></td>
								<td style="min-width: 250px;">
								<strong>Item: Towel</strong>
								<span>In-Progress</span>
								</td>
								</tr>

								<tr>
								<td><img src="images/apl.png"></td>
								<td style="min-width: 250px;">
								<strong>Item: Towel</strong>
								<span>In-Progress</span>
								</td>
								</tr> --}}
								 </tbody>
								</table>



		 </div>


		</div>
      </div>
    </div>

  </div>


  <div id="Claim" class="modal fade profile_model" role="dialog">

  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1 closeClaimData" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop1">

		<h2>Laundry Claim Center </h2>
		</div>
			 <div class="tabels">




								<table class="dat12 Claim">

								<tbody id="cliamDetailData">
								{{-- <tr>
								<td style="text-align: ;">Claim</td>
								<td>LD461</td>
								</tr>
								<tr>
								<td >Color </td>
								<td>Black</td>
								</tr>
								<tr>
								<td>Brand</td>
								<td>Lulu</td>
								</tr>
								<tr>
								<td>Item Type</td>
								<td>Towels</td>
								</tr>
								<tr>
								<td>Size </td>
								<td> L</td>
								</tr>
								<tr>
								<td>Last Worm On</td>
								<td>2020.09.03</td>
								</tr>
								<tr>
								<td>Date Filled</td>
								<td>2020.09.02</td>
								</tr>
								<tr>
								<td>Status</td>
								<td class="In-Progress">In-Progress</td>
								</tr>
								<tr>
								<td>Resolution</td>
								<td class="Pending">Pending</td>
								</tr>
								<tr>
								<td>Date Resolved</td>
								<td class="Resolved">-</td>
								</tr> --}}



								 </tbody>
								</table>



		 </div>


		</div>
      </div>
    </div>

  </div>


		<section class="pro_files">
			<div class="container">
				<div class="row">
					<div class="col-md-12 ">


				<div class="tab_profile">
					<div class="tab">
					  <button class="tablinks active" onclick="openCity(event, 'London1')"><img src="{{asset('web/images/pro1.png')}}"> Profile</button>
					  <button class="tablinks " onclick="openCity(event, 'London2')"> <img src="{{asset('web/images/pro2.png')}}"> Update Payment Method</button>
					  <button class="tablinks " onclick="openCity(event, 'London3')"> <img src="{{asset('web/images/pro3.png')}}"> Update Service Address</button>
					  <button class="tablinks " onclick="openCity(event, 'London4')"> <img src="{{asset('web/images/pro4.png')}}"> Schedule & Reschedule</button>
					  <button class="tablinks billing" onclick="openCity(event, 'London5')"> <img src="{{asset('web/images/pro5.png')}}"> Billing History</button>
                      {{-- <button class="tablinks " onclick="openCity(event, 'London6')"> <img src="images/pro6.png"> Order History</button> --}}
                      {{-- <button class="tablinks subscription" onclick="openCity(event, 'London11')"> <img src="{{asset('web/images/pro6.png')}}"> Manage My Account</button> --}}
					  <button class="tablinks subscription" onclick="openCity(event, 'London11')"> <img src="{{asset('web/images/pro7.png')}}"> My Services</button>
					  <button class="tablinks " onclick="openCity(event, 'London7')"> <img src="{{asset('web/images/pro8.png')}}"> Preferences</button>
					  <button class="tablinks " onclick="openCity(event, 'London9')"> <img src="{{asset('web/images/pro9.png')}}"> File a Claim</button>
					</div>

					<div id="London1" class="tabcontent" style="display: block;">
						<div class="row">
							<div class="col-md-4">
								<div class="user_pic">
									<img src="{{ $data->profile_image }}">
								</div>
							</div>
							<div class="col-md-8">
								<div class="user_pic">
									<h4> {{ $data->first_name.' '.$data->last_name }} <span class="bell"><a data-toggle="modal" data-target="#notes" > <img src="{{asset('web/images/bell.png')}}" > <i>{{ count($notifications)  }}</i> </a> </span></h4>
									<p><img src="{{asset('web/images/call.png')}}"> {{ $data->country_code.' '.$data->contact }} </p>
                                    <p><img src="{{asset('web/images/call2.png')}}"> {{ $data->email }} </p>
                                    @if($data->in_campus)
									    <p><img src="{{asset('web/images/call3.png')}}"> Hall:- {{ $data->hall }} ,<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Room number:- {{ $data->room_number }} </p>
                                    @else

                                    <div>
                                        <em style="float: left;"><img src="{{asset('web/images/call3.png')}}"> </em>

                                        <div style="float: left;margin-left: 10px;">
                                            <em> {{ $data->address }} ,<br> {{ $data->city }}<br>
                                            {{ $data->state }}<br>{{ $data->zipcode }}
                                            </em>

                                        </div>

                                    </div>
                                    @endif
									<h6>
                                        <a data-toggle="modal" data-target="#edit_details" ><img src="{{asset('web/images/edit.png')}}"> Edit Details</a>

                                        <a href="" onclick="return false" data-toggle="modal" data-target="#for_g"  class="blue_brder"><img src="{{asset('web/images/edit.png')}}"> Change Password</a>
									</h6>

								</div>
							</div>
							<div class="col-md-12" id="profile_myservice">
								<div class="add_dlt">
									<h4>My Services</h4>
								</div>

<!--
								<div class="pro_plan_blue">
									 <h5> Laundry Schedule  </h5>
									 <div class="widt_50">
										<b> Monday (dirty)</b>
										<p> Morning: 6:45 AM-10:45 AM</p>
										<p> Evening: 4:45 PM-10:45 PM</p>
										<a data-toggle="modal" data-target="#com1" class="serv_btn"> Complete Inventory</a>
									 </div>
									 <div class="widt_50">
										<b> Tuesday (cleaning)</b>
										<p> Morning: 6:45 AM-10:45 AM</p>
										<p> Evening: 4:45 PM-10:45 PM</p>
									 </div>
								</div>

								<div class="pro_plan_blue">
									 <h5> Next Housekeeping  </h5>
									 <div class="widt_50">
										<div class="time_set" data-toggle="modal" data-target="#add_cart2">
											<b> Monday (cleaning)</b>
											<p> Morning: 6:45 AM-10:45 AM</p>
											<p> Evening: 4:45 PM-10:45 PM</p>
										 </div>
										<a data-toggle="modal" data-target="#add_cart" class="serv_btn" > Special Request</a>
									 </div>
									 <div class="widt_50">
										<a data-toggle="modal" data-target="#dated" class="srv_lock"><img src="images/lock.png" > </a>
 									 </div>
								</div>
								<div class="pro_plan_blue">
									 <h5> My Storage  </h5>
									 <div class="widt_50">
										<b> Storage Pick-up</b>
										<p> Morning: 6:45 AM-10:45 AM</p>
										<a data-toggle="modal" data-target="#upgrade" class="serv_btn" > Reschedule</a>
									 </div>
									 <div class="widt_50">
										<a data-toggle="modal" data-target="#dated" class="srv_lock"><img src="images/lock.png" > </a>
 									 </div>
								</div>
-->
							</div>
						</div>
					</div>

					<div id="London10" class="tabcontent" >
						<div  class="pro_pic">
							<img src="{{ $data->profile_image }}" class="rounded-circle" width="150">
							<h5> My Current Subscriptions</h5>
							 <div class="col-md-12" id="myservicescreen">
								<div class="add_dlt">
									<h4>My Services</h4>
								</div>



							</div>
{{--
							<h6> Your plan auto-bills on the 1st of each month</h6>

							<p class="btn_2">
								<a  > Add On Services</a>
								<a   style="background:#f29f00;"> Complete</a>
							</p> --}}
						</div>
                    </div>

                    <div id="London11" class="tabcontent" >
						<div  class="pro_pic">
							<img src="{{ $data->profile_image }}" class="rounded-circle" style="width: 200px;height: 200px;">
							<h5 id="currentSubscription"> My Current Subscriptions</h5>
{{--

							<div  class="pro_plan">
								<h5> Laundry  <span> $69.99</span> </h5>
								 <small>Monthly </small>
								<p> 10 Lbs Per Week</p>
								<h4> <a data-toggle="modal" data-target="#storge_id" > Upgrade </a> <br>
									<a data-toggle="modal" data-target="#cancel_upgrade" style="color:#f29f00;" > Cancel </a>
								</h4>
							</div>
							<div  class="pro_plan">
								<h5> Houskeeping  <span> $139.99</span> </h5>
								 <small>Bi-Weekly </small>
								<p> 1 Bed/ 1 Bath, Kitchen & Common Area This cleaning is 90 minute</p>
								<h4> <a data-toggle="modal" data-target="#storge_id2" > Upgrade </a> <br>
									<a data-toggle="modal" data-target="#cancel_upgrade" style="color:#f29f00;" > Cancel </a>
								</h4>
							</div> --}}

							<h6> Your plan auto-bills on the 1st of each month</h6>

							{{-- <p class="btn_2">
								<a  > Add On Services</a>
								<a   style="background:#f29f00;"> Complete</a>
							</p> --}}
						</div>
					</div>

					<div id="London2" class="tabcontent">
						<h2>Update Payment Method and Billing Address</h2>
						<h3>Update Payment Method </h3>
					  <div  class="pro_text">
						<form id="paymentupdate" method="post">
								<div class="row">

                                <div class="col-md-12">
									<div class="form-group">
										<label> Name on Card  <span>*</span> </label>
										<input  name="name_on_card"  type="text" class="form-control" value="{{$paymentDetails->name_on_card ?? '' }}" required="">
                                </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> Credit Card Type <span>*</span> </label>
										<select  name="card_type" class="form-control" required="">
                                            <option value="">Please Select Card type</option>
                                            <option value="1" @if(isset($paymentDetails->card_type) && $paymentDetails->card_type == '1') selected @endif>Visa</option>
                                            <option value="2" @if(isset($paymentDetails->card_type) && $paymentDetails->card_type == '2') selected @endif>Master Card</option>
                                        </select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> Credit Card Number <span>*</span> </label>
                                    <input  name="card_number" onkeypress="return cardNumber(event)" type="text" class="form-control" value="{{ $paymentDetails->card_number ?? '' }}" required="">
									</div>
								</div>
                                <div class="col-md-6">
									<div class="form-group">
									<label> Expire Month  <span>*</span>	</label>
									 <select name="expiry_month" class="form-control">
                                        <option value="" disabled selected>Please select month</option>
                                        <option value="01" @if(isset($paymentDetails->expiry_month) &&  $paymentDetails->expiry_month == '01') selected @endif>01</option>
                                        <option value="02" @if( isset($paymentDetails->expiry_month) && $paymentDetails->expiry_month == '02') selected @endif>02</option>
                                        <option value="03" @if(isset($paymentDetails->expiry_month) && $paymentDetails->expiry_month == '03') selected @endif>03</option>
                                        <option value="04" @if(isset($paymentDetails->expiry_month) && $paymentDetails->expiry_month == '04') selected @endif>04</option>
                                        <option value="05" @if(isset($paymentDetails->expiry_month) && $paymentDetails->expiry_month == '05') selected @endif>05</option>
                                        <option value="06" @if(isset($paymentDetails->expiry_month) && $paymentDetails->expiry_month == '06') selected @endif>06</option>
                                        <option value="07" @if(isset($paymentDetails->expiry_month) && $paymentDetails->expiry_month == '07') selected @endif>07</option>
                                        <option value="08" @if(isset($paymentDetails->expiry_month) && $paymentDetails->expiry_month == '08') selected @endif>08</option>
                                        <option value="09" @if(isset($paymentDetails->expiry_month) && $paymentDetails->expiry_month == '09') selected @endif>09</option>
                                        <option value="10" @if(isset($paymentDetails->expiry_month) && $paymentDetails->expiry_month == '10') selected @endif>10</option>
                                        <option value="11" @if(isset($paymentDetails->expiry_month) && $paymentDetails->expiry_month == '11') selected @endif>11</option>
                                        <option value="12" @if(isset($paymentDetails->expiry_month) && $paymentDetails->expiry_month == '12') selected @endif>12</option>
                                     </select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
									<label> Expire Year  <span>*</span>	</label>
                                    <select name="expiry_year" id="expiry_year" class="form-control" required="">
                                       <option value="" disabled selected>Please select Year</option>
                                    </select>
									</div>
                                </div>
                                <input type="hidden" name="is_default" value="1">
									<div class="col-md-12">
										<div class="form-group">
											<button class="width_100" onclick="return false;" id="updatecard">Update Now</button>
										</div>
									</div>
								</div>
							</form>

                      </div>

                      <h3>Update Billing Address</h3>
                      <div  class="pro_text">
						<form id="billingaddressdata">
								<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label> Billing Address<span>*</span> </label>
                                    <input name="billing_address" value="{{ $billingaddress->address ?? '' }}" type="text" class="form-control" required="">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label> City  <span>*</span> </label>
										<input  name="billing_city" value="{{ $billingaddress->city ?? '' }}" type="text" class="form-control" required="">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label> State <span>*</span> </label>
										<input  name="billing_state" value="{{ $billingaddress->state ?? '' }}" type="text" class="form-control" required="">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label> Zip Code <span>*</span> </label>
										<input name="billing_zipcode" value="{{ $billingaddress->zipcode ?? '' }}" type="text" class="form-control" required="">
									</div>
								</div>
                                <div class="col-md-6">
									<div class="form-group">
									<label> Appartment Number:	</label>
									 <input name="billing_appartment_number" value="{{ $billingaddress->appartment_number ?? '' }}"  type="text" class="form-control" required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> Gate Code:</label>
										<input name="billing_gate_code" value="{{ $billingaddress->gate_code ?? '' }}" type="text" class="form-control" required="">
									</div>
								</div>
									<div class="col-md-12">
										<div class="form-group">
											<button onclick="return false" id="updatebillingdata"> Update Now</button>
										</div>
									</div>
								</div>
							</form>

                      </div>


                    </div>





					<div id="London3" class="tabcontent">
						<h2>Did you relocate?</h2>
						<h3>Update my service address</h3>
					  <div  class="pro_text">
						<form id="serviceaddressdata">

								<div class="form-group">
								<label> Do You Live In Campus?</label>
								<div class="Live">
								<label class="Live2"><input type="radio" class="radio1" value="1" name="in_campus"><span class="Live3">Yes</span></label>
								<label class="Live2"><input type="radio" class="radio2" value="0" name="in_campus"><span class="Live3">No</span></label>

								</div>
                            </div>

							<div class="yes">
							<div class="form-group">
                                <label> Hall Name</label>
                            <input type="text" name="hall"  placeholder="Enter hall name"  value="{{ $data->hall }}">
							</div>
							<div class="form-group">
                                <label> Room number</label>
                            <input type="text" name="room_number" placeholder="Enter room number"  value="{{ $data->room_number }}">
							</div>
							</div>

							<div class="no ">
							<div class="form-group">
								<label> Address</label>
                            <input type="text" name="address" placeholder="Enter Address"  value="{{ $data->address }}">
							</div>
							<div class="form-group">
								<label> City</label>
                            <input type="text" name="city" placeholder="Enter City"  value="{{ $data->city }}">
							</div>
							<div class="form-group">
								<label> State</label>
                            <input type="text" name="state" placeholder="Enter state"  value="{{ $data->state }}">
							</div>
							<div class="form-group">
								<label> Zip Code</label>
                            <input type="text" name="zipcode" placeholder="Enter zipcode"  value="{{ $data->zipcode }}">
							</div>
							<div class="form-group">
								<label>Country</label>
                            <input type="text" name="country" placeholder="Enter country"  value="{{ $data->country }}">
							</div>
                            </div>
                            <div class="form-group">
                                <button class="width_100" onclick="return false;" id="updateServiceAddress">Update Now</button>
                            </div>
							</form>

					  </div>
					</div>

					<div id="London5" class="tabcontent">
						<div class="row">
							<div class="col-md-4">
								<div class="user_pic">
									<img src="{{ $data->profile_image }}">
								</div>
							</div>
							<div class="col-md-8">
								<div class="user_pic">
									<h4> {{ $data->first_name.' '.$data->last_name }} <span class="bell"><a data-toggle="modal" data-target="#notes" > <img src="{{asset('web/images/bell.png')}}" > <i>{{ count($notifications)  }} </i> </a> </span></h4>
									<p><img src="{{asset('web/images/call.png')}}"> {{ $data->country_code.' '.$data->contact }} </p>
                                    <p><img src="{{asset('web/images/call2.png')}}"> {{ $data->email }} </p>
                                    @if($data->in_campus)
									    <p><img src="{{asset('web/images/call3.png')}}"> Hall:- {{ $data->hall }} ,<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Room number:- {{ $data->room_number }} </p>
                                    @else
                                        <p><img src="{{asset('web/images/call3.png')}}"> {{ $data->address }} ,<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $data->city }} </p>
                                    @endif
									<h6>
                                        <a data-toggle="modal" data-target="#edit_details" ><img src="{{asset('web/images/edit.png')}}"> Edit Details</a>

                                        <a href="" onclick="return false" data-toggle="modal" data-target="#for_g"  class="blue_brder"><img src="{{asset('web/images/edit.png')}}"> Change Password</a>
									</h6>

								</div>
							</div>
							<div class="col-md-12" id="billingData">
                                <div class="pro_text">
                                    <div class="row">
                                        <div class="col-md-6">
                                                <button id="pasthistory" style="padding: 10px;width: auto;">Past History</button>
                                        </div>

                                        <div class="col-md-6">
                                            <button id="currenthistory" style="padding: 10px;width: auto;float: left;">Current History</button>
                                        </div>

                                    </div>
                                </div>
							  {{-- <div class="pro_plan_main">
								<div class="pro_plan_blue">
									 <h5> Tuesday, December 17th <small> Order confirmed - Delivered </small>  </h5>
									 <span> $84.99</span>
								</div>
								<div class="pro_plan_list">
									 <h5> Wash & Fold Inventory </h5>
									 <p>2 X T-Shirt</p>
									 <p>8 X Shirt</p>
									 <p>5 X Trouser</p>
									 <p>1 X Jeans</p>
									 <p>4 X T-Shirt</p>
									 <p>2 X Shirt</p>
									 <p>3 X Jeans</p>
									 <h6> Actual Weight  <span> 13</span> </h6>
									 <h6>Overage Charges   <span> $5.67</span> </h6>
									 <h1>Dry Cleaning</h1>
									 <h6> Shirt x 1  <span> $5.67</span> </h6>
									 <h6> Pants x 1  <span> $5.67</span> </h6>
									 <h6>Total   <span> $5.67</span> </h6>
								</div>
							   </div>5 --}}
							</div>
						</div>
					</div>
					<div id="London4" class="tabcontent">
						{{-- <h3>Clean my house every…</h3>
						<div  class="pro_text">
						<form class="Edit161">
						<div class="form-group">
							<div class="row">
							<div class="col-md-6">
							<label> Select a Date</label>
								<input type="date" placeholder="Select a date" value="">
							</div>
							<div class="col-md-6">
								<label> Select Time</label>
								<input type="time" placeholder="Select a date" value="">
							</div>
							</div>
							</div>
							<div class="form-group">
							<div class="row">
							<div class="col-md-12">
							<label> My Address</label>
								<input type="text" placeholder="Enter Address" value="">
							</div>

							</div>
							</div>
							<div class="form-group">
							<div class="row">
							<div class="col-md-6">
							<a href="" class="yellow_btn"> Next</a>
							</div>

							</div>
							</div>
							</form>


						</div> --}}
						{{-- <h3>Storage Service</h3>
						<div  class="pro_text fomr_blue">
							<div  class="row">
								<div class="col-md-6">
									<div class="form-group">
									 <label> Deliver my packing materials	Date</label>
									 <input type="date" class="form-control" required="" placeholder="Select date and time ">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									 <label> Deliver my packing materials	Time	</label>
									 <input type="time" class="form-control" required="" placeholder="Select date and time ">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
									 <label>From</label>
									 <input type="text" class="form-control" required="" placeholder="Address">
									</div>
								</div>

								<div class="col-md-6">
									 <label><input class="chck_box" type="checkbox" > Same as signup location	</label>
									 <a href="" class="yellow_btn" > Next</a>
								</div>
							</div>
							</div> --}}
						</div>



						<div id="London6" class="tabcontent">
							<div class="pro_text">
								<table class="table billing_addrs">
									<thead>
										  <tr class="border_none Short55">
											<th> <button class="btn btn-default active">All</button> </th>
											<th>
												<button class="btn btn-default "> Short By Week </button>

											</th>
											<th>
												<button class="btn btn-default"> Short By Month</button>
											</th>
											<th>
												<button class="btn btn-default"> Short By Year</button>
											</th>
										  </tr>
									</thead>
									<tbody>
										<tr class="border_none">
											<td>	Date</td>
											<td>	Description</td>
											<td>	Amount</td>
											<td>	Status</td>
										</tr>
										<tr>
											<td>	17th Jan, <br> 2020</td>
											<td>	Laundry Service</td>
											<td>	$29.99</td>
											<td>	Paid</td>
										</tr>
										<tr>
											<td>	17th Jan, <br> 2020</td>
											<td>	Laundry Service</td>
											<td>	$29.99</td>
											<td>	Paid</td>
										</tr>
										<tr>
											<td>	17th Jan, <br> 2020</td>
											<td>	Laundry Service</td>
											<td>	$29.99</td>
											<td>	Paid</td>
										</tr>
										<tr>
											<td>	17th Jan, <br> 2020</td>
											<td>	Laundry Service</td>
											<td>	$29.99</td>
											<td>	Paid</td>
										</tr>
										<tr>
											<td>	17th Jan, <br> 2020</td>
											<td>	Laundry Service</td>
											<td>	$29.99</td>
											<td>	Paid</td>
										</tr>
										<tr>
											<td>	17th Jan, <br> 2020</td>
											<td>	Laundry Service</td>
											<td>	$29.99</td>
											<td>	Paid</td>
										</tr>
										<tr>
											<td>	17th Jan, <br> 2020</td>
											<td>	Laundry Service</td>
											<td>	$29.99</td>
											<td>	Paid</td>
										</tr>
										<tr>
											<td>	17th Jan, <br> 2020</td>
											<td>	Laundry Service</td>
											<td>	$29.99</td>
											<td>	Paid</td>
										</tr>
										<tr class="border_none text-center">
											<td>	</td>
											<td colspan="2">	<a href="" class="yellow_btn"> View More</a></td>
											<td>	</td>
										</tr>
									</tbody>
								</table>
							</div>

						</div>
						<div id="London7" class="tabcontent">
						  <div class="tab_in_pre">
								<h6>Preferences</h6>
								 <div class="tab_in">
									<ul class="nav nav-pills mb-3 user-sign" id="pills-tab" role="tablist">
										  <li class="nav-item">
											<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"> Cleaning</a>
										  </li>
										  <li class="nav-item">
											<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Delivery</a>
                                          </li>

                                          <input type="hidden" name="tabSelected" value="1">

									</ul>
									<div class="tab-content" id="pills-tabContent">
										<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
											<div class="deli_vary">
												<h4>Delivery</h4>
												<div class="shirt_list">
												<div class="shirt">
													<img src="{{asset('web/images/shirt.png')}}" >
												</div>
												<div class="shirt_2">
													<h5> Always set my orders for
														Rush Delivery Same-day for
														Wash & Fold, 2-Day for Dry
														Cleaning
													</h5>
													<p> By activating rush delivery, I agree that my card on file will be billed an additional $39.99 per month</p>
												</div>
												<div class="shirt_3">
													 <div class="onoffswitch">
													  <input type="checkbox"  name="rush_delivery" class="onoffswitch-checkbox" id="myonoffswitch" @if(isset($prefferences->rush_delivery) && $prefferences->rush_delivery == '1' ){{ 'checked' }} @endif >
													  <label class="onoffswitch-label" for="myonoffswitch">
														  <div class="onoffswitch-inner"></div>
														  <div class="onoffswitch-switch"></div>
													  </label>
												  </div>
												</div>
												</div>
												<div class="my_lundry">
												<h4>Leave My Laundry </h4>
													<p> <b> <input name="leave_laundry" value="1" type="radio" @if(isset($prefferences->leave_laundry) && $prefferences->leave_laundry == '1' ){{ 'checked' }} @endif > Front Door: </b> We will pick up and deliver to your front door. If needed,
													we will provide a drop hook for yourdoor.</p>
													<p> <b> <input name="leave_laundry" value="2" type="radio" @if(isset($prefferences->leave_laundry) && $prefferences->leave_laundry == '2' ){{ 'checked' }} @endif> Concierge: </b>  We will pick up and deliver from your residence concierge desk.</p>
													<p> <b data-target="#Save_Preferences"> <input name="leave_laundry" value="3" type="radio" @if(isset($prefferences->leave_laundry) && $prefferences->leave_laundry == '3' ){{ 'checked' }} @endif >  Laundry Locker: </b> We will pick up and deliver to an on campus laundry locker.</p>
													<h5> Delivery Instructions <br> Please be as detailed as possible so our  service to you is seamless</h5>
													<div class="Updat2e"><input type="text" name="delivery_instructions" value="@if(isset($prefferences->delivery_instructions) ){{ $prefferences->delivery_instructions }} @endif" placeholder="Update your pick-up and delivery instructions."></div>

													<p> With my agreement, I request and authorize Laundry 305
															& The Student Storage to pick up and deliver my order
															without my presence at the service address indicated in
															my profile. I agree that a notice of delivery from Laundry
															305 & The Student Storage constitutes as proof of
															delivery. I accept and hereby release Laundry 305 from all
															liabilities and any loss, theft, or damage that may result
															from Laundry 305 & The Student Storage accessing such
															designate place and leaving deliveries at my request. </p>
													<p><input type="checkbox" name="agree" >   I agree.</p>

												</div>

											</div>
										</div>
										<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
											<div class="deli_vary">
												<h4>Laundry</h4>
												<div class="shirt_list">
													<div class="shirt"><img src="{{asset('web/images/shirt1.png')}}" >	</div>
													<div class="shirt_2">
														<h5> Detergent	</h5>
													</div>
													<div class="shirt_3">
														 {{-- <div class="onoffswitch"> --}}
														  <select name="detergent" class="form-control">
                                                              <option value="">Please select</option>
                                                              <option value="Hypoallargenic" @if(isset($prefferences->delivery_instructions) && $prefferences->detergent == 'Hypoallargenic' ){{ 'selected' }} @endif >Hypoallargenic</option>
                                                              <option value="Scented" @if(isset($prefferences->delivery_instructions) && $prefferences->detergent == 'Scented' ){{ 'selected' }} @endif>Scented</option>
														  </select>
													  {{-- </div> --}}
													</div>
												</div>
												<div class="shirt_list">
													<div class="shirt"><img src="{{asset('web/images/shirt2.png')}}" >	</div>
													<div class="shirt_2">
														<h5> Fabric Softener	</h5>
														<p> Fabric softern is non-hypoallergenic.</p>
													</div>
													<div class="shirt_3">
														 <div class="onoffswitch">
														  <input type="checkbox" @if(isset($prefferences->fabric_softner) && $prefferences->fabric_softner == '1' ){{ 'checked' }} @endif name="fiber_softner" class="onoffswitch-checkbox" id="myonoffswitch2"  >
														  <label class="onoffswitch-label" for="myonoffswitch2">
															  <div class="onoffswitch-inner"></div>
															  <div class="onoffswitch-switch"></div>
														  </label>
													  </div>
													</div>
												</div>
												<div class="shirt_list">
													<div class="shirt"><img src="{{asset('web/images/shirt3.png')}}" >	</div>
													<div class="shirt_2">
														<h5> Oxiclean (Whites Only)	</h5>
													</div>
													<div class="shirt_3">
														 <div class="onoffswitch">
														  <input type="checkbox" @if(isset($prefferences->oxiclean) && $prefferences->oxiclean == '1' ){{ 'checked' }} @endif name="oxiclean" class="onoffswitch-checkbox" id="myonoffswitch3" >
														  <label class="onoffswitch-label" for="myonoffswitch3">
															  <div class="onoffswitch-inner"></div>
															  <div class="onoffswitch-switch"></div>
														  </label>
													  </div>
													</div>
												</div>
												<div class="shirt_list">
													<div class="shirt"><img src="{{asset('web/images/shirt.png')}}" >	</div>
													<div class="shirt_2">
														<h5>Starch (Launder & Press only)	</h5>
													</div>
													<div class="shirt_3">
															<select name="starch" class="form-control color_on">
                                                                 <option value="0" @if(isset($prefferences->starch) && $prefferences->starch == '0' ){{ 'selected' }} @endif>None</option>
                                                                 <option value="1" @if(isset($prefferences->starch) && $prefferences->starch == '1' ){{ 'selected' }} @endif>Low</option>
                                                                 <option value="2" @if(isset($prefferences->starch) && $prefferences->starch == '2' ){{ 'selected' }} @endif>Medium</option>
                                                                 <option value="3" @if(isset($prefferences->starch) && $prefferences->starch == '3' ){{ 'selected' }} @endif>High</option>
                                                            </select>
													</div>
												</div>
                                                    {{-- <div class="shirt_list" style="border:none;">
                                                        <div class="shirt_2">
                                                            <h5>Tell us your special requests:	</h5>
                                                        </div>
                                                        <textarea> {{$prefferences->starch}} </textarea>
                                                    </div> --}}

												<h4>Housekeeping</h4>
												 <div class="col-md-12 shirt_list">
													<div class="form-group pre_list">
														<label> Do you have a vacuum?</label>
														<div class="check_box_yes">
														<p><input type="radio" class="vaccum" name="vaccum" value="1" @if(isset($prefferences->vaccum) && $prefferences->vaccum == '1' ){{ 'checked' }} @endif > Yes  </p>
														<p><input type="radio" class="vaccum" name="vaccum" value="2" @if(isset($prefferences->vaccum) && $prefferences->vaccum == '2' ){{ 'checked' }} @endif> No </p>
														</div>
													</div>
													<div class="form-group pre_list">
														<label> Do you have a mop? (swiffer) </label>
														<div class="check_box_yes">
														<p><input type="radio"  class="mop" name="mop" value="1" @if(isset($prefferences->mop) && $prefferences->mop == '1' ){{ 'checked' }} @endif> Yes  </p>
														<p><input type="radio"  class="mop" name="mop" value="2" @if(isset($prefferences->mop) && $prefferences->mop == '2' ){{ 'checked' }} @endif> No </p>
														</div>
													</div>
													<div class="form-group pre_list">
														<label> Will you provide your preferred band cleaning products? </label>
														<div class="check_box_yes">
														<p><input type="radio" class="cleaning_product" name="cleaning_product" value="1" @if(isset($prefferences->cleaning_product) && $prefferences->cleaning_product == '1' ){{ 'checked' }} @endif> Yes  </p>
														<p><input type="radio" class="cleaning_product" name="cleaning_product" value="2" @if(isset($prefferences->cleaning_product) && $prefferences->cleaning_product == '2' ){{ 'checked' }} @endif> No </p>
														</div>
													</div>
													{{-- <div class="form-group pre_list">
														<label style="color:#54caea;"> Do you prefer: </label>
														<div class="check_box_yes">
														<p><input type="checkbox" name="favorite1" value="chocolate"> Method Brand  </p>
														<p><input type="checkbox" name="favorite2" value="vanilla"> Lysol brand? </p>
														</div>
													</div> --}}
													<div class="form-group pre_list">
														<label> Are there any uncagedpets in the home?</label>
														<div class="check_box_yes">
														<p><input type="radio" class="pets" name="pets" value="1" @if(isset($prefferences->pets) && $prefferences->pets == '1' ){{ 'checked' }} @endif> Yes  </p>
														<p><input type="radio" class="pets" name="pets" value="2" @if(isset($prefferences->pets) && $prefferences->pets == '2' ){{ 'checked' }} @endif> No </p>
														</div>
													</div>
												</div>



											</div>
										</div>
										<div class="my_lundry"><a data-toggle="modal" onclick="return false" id="Save_Preferences" >Save Preferences </a></div>
									</div>
								</div>
						  </div>

						</div>
								<div id="London9" class="tabcontent">
								<h3> Laundry Claim Center  <span style="float:right"><button id="openAllClaims" class="btn btn-primary"> All Claims</button></span> </h3>
									<div class="tab_in">
										<div class="">
												<h1> Laundry Claim Center</h1>
												<p>Please complete the information below to submit a laundry claim. Allow us 3-5 business days to investigate your claim and present you a resolution.</p>
												<form class="claim_on" id="claim_data">
													<div class="form-group ">
														<label>Color</label>
														<input type="text" name="color" placeholder="Enter a Color">
													</div>
													<div class="form-group ">
														<label>Brand</label>
														<input type="text" name="brand" placeholder="Enter a Brand">
                                                    </div>
                                                    {{-- <div class="form-group ">
														<label>Category</label>
														<select name="category">
                                                            <option value="" disabled selected>Please Select </option>
                                                            <option value="Cotton">Cotton</option>
                                                            <option value="Synthetic">Synthetic</option>
                                                            <option value="Nylon">Nylon</option>
														</select>
													</div> --}}
													<div class="form-group ">
														<label>Item Type</label>
														<select name="item">
                                                            <option value="" disabled selected>Please Select </option>
                                                            @foreach ($laundry_items as $items )
                                                        <option value="{{ $items->name }}"> {{ $items->name }} </option>
                                                            @endforeach
														</select>
													</div>
													<div class="form-group ">
														<label>Size</label>
														<select name="size">
                                                            <option value="" disabled selected>Please Select </option>
                                                            <option value="S">S</option>
                                                            <option value="M">M</option>
                                                            <option value="L">L</option>
                                                            <option value="XL">XL</option>
                                                            <option value="XXL">XXL</option>
                                                            <option value="XXXL">XXXL</option>
														</select>
													</div>
													<div class="my_lundry">
														<div class="up_load">
															<input type="file" name="image" >
															<a href="" class="yellow_btn_class mb-4"> Upload Image</a>
														</div>
														<a href="" onclick="return false" id="fileaclaim">Submit</a>
													</div>
												</form>

										</div>
										<div class="" style="display:none;">
												<h1> Laundry Claim Center</h1>
												<p>Please complete the information below to submit a laundry claim. Allow us 3-5 business days to investigate your claim and present you a resolution.</p>
												<div class="claim_on_list">
													<h6>Cliam <span> 4555487</span></h6>
													<h6>Color <span> black</span></h6>
													<h6>Brand <span> Gucci</span></h6>
													<h6>Color <span> black</span></h6>
													<h6>Item Type <span> Tank/Top</span></h6>
													<h6>Size <span> 32</span></h6>
													<h6>Last Worn On <span> 14.01.2020</span></h6>
													<h6>Resolution <span> Pending</span></h6>
													<h6>Date Resolved<span> 16.01.2020</span></h6>
													<div class="my_lundry">
														<a >Next</a>
													</div>
												</div>

										</div>




									</div>
								</div>
								<div id="London8" class="tabcontent">
									 <div class="invoice_set">
										<h4> Bill To <small> Transaction Date Feb 10, 2020</small></h4>
										<h5> John Deo <span>Invoice </span></h5>
										<p> Barry University, <br> Phone: +44 1230 4567 890     |     Email: John.deo@ymail.com </p>

										<div class="table-responsive invo_table">
											<table class="table">
												<thead>
												  <tr>
													<th>Items</th>
													<th>Quantity</th>
													<th>Priice</th>
												  </tr>
												</thead>
												<tbody>

												  <tr>
													<td> LAUNDRY</td>
													<td>10 Lbs Per Week </td>
													<td>$199.22</td>
												  </tr>
												  <tr>
													<td> HOUSEKEEPING</td>
													<td>1 Bedroom </td>
													<td>$199.22</td>
												  </tr>
												  <tr>
													<td> STORAGE</td>
													<td>3 Bins </td>
													<td>$199.22</td>
												  </tr>
												  <tr>
													<td> Total</td>
													<td></td>
													<td>$199.22</td>
												  </tr>

												</tbody>
											  </table>
										</div>
										<p> Payment Method</p>
										<div class="py_ment_Card">
											<div class="media position-relative ">
												  <img src="{{asset('web/images/visa2.png')}}" class="mr-4" alt="...">
												  <div class="media-body">
													  <h2 class="">**** **** ***** 093 </h2>
													  <small>Order Date jan 10, 2024</small>

												  </div>
											 </div>
										</div>
										<h1> THANKS FOR YOUR PAYMENT </h1>
										<p class="download_btns"> <a href="" >Download  </a>  OR  <a href="" >Print It  </a></p>
										<div class="my_lundry">
											<a data-toggle="modal" data-target="#oder_upgraded">Save</a>
										</div>
									 </div>
								</div>

							</div>
					</div>
				</div>
			</div>
			</section>

            <input type="hidden" name="subscription_id" value="">

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

    $('.radio1').click(function(){
        $('.yes').addClass('ad12').siblings().removeClass('ad12');
    });

    $('.radio2').click(function(){
        $('.no').addClass('ad12').siblings().removeClass('ad12');
    });

    var in_campus = "{{$data->in_campus}}";
    // alert(in_campus)
    if(in_campus == '1'){
        $('.radio1').trigger('click')
    }else{
        $('.radio2').trigger('click')
    }


    function myservice(){
            $.ajax({
                type:"get",
                url: "{{ url('api/myservice') }}",
                beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
                complete: function(e, xhr, settings){
                    console.log(e.responseJSON)
                    if(e.responseJSON.message == 'Cart is empty'){
                        $('#profile_myservice').append(`
                            <h2>No service found</h2>
                        `)

                        $('#myservicescreen').append(`
                            <h2>No service found</h2>
                        `)

                        $('#London4').append(`
                            <h2>No service found</h2>
                        `)

                        return false;
                    }

                    var checkHousekeepingAndStorageData = [];

                    var body = e.responseJSON.body;
                    for(var i=0; i < body.length ; i++){
                        if((body[i].cart.service == 'Housekeeping') || (body[i].cart.service == 'Storage') ){
                            checkHousekeepingAndStorageData.push('1')
                        }
                    }

                    if(checkHousekeepingAndStorageData.length == 0){
                        $('#London4').append(`
                            <h2>No service found</h2>
                        `)
                    }

                    for(var i=0; i < body.length ; i++){
                        var data = body[i];
                        // console.log(data)
                        if(data.cart.service == 'Laundry'){

                            $('#profile_myservice').append(`

                                <div class="pro_plan_blue">
									 <h5> Laundry Schedule  </h5>
									 <div class="widt_50">
										<b> Monday (dirty)</b>
										<p> Morning: 6:45 AM-10:45 AM</p>
										<p> Evening: 4:45 PM-10:45 PM</p>
										<a data-toggle="modal" id=""  class="serv_btn laundry" data-subscription_id="`+ data.id +`" data-week="`+ data.this_week +`" > Complete Inventory</a>
									 </div>
									 <div class="widt_50">
										<b> Tuesday (cleaning)</b>
										<p> Morning: 6:45 AM-10:45 AM</p>
										<p> Evening: 4:45 PM-10:45 PM</p>
									 </div>
								</div>


                            `);


                            $('#myservicescreen').append(`

                                <div class="pro_plan_blue">
									 <h5> Laundry Schedule  </h5>
									 <div class="widt_50">
										<b> Monday (dirty)</b>
										<p> Morning: 6:45 AM-10:45 AM</p>
										<p> Evening: 4:45 PM-10:45 PM</p>
										<a data-toggle="modal" id=""  class="serv_btn laundry" data-subscription_id="`+ data.id +`" data-week="`+ data.this_week +`" > Complete Inventory</a>
									 </div>
									 <div class="widt_50">
										<b> Tuesday (cleaning)</b>
										<p> Morning: 6:45 AM-10:45 AM</p>
										<p> Evening: 4:45 PM-10:45 PM</p>
									 </div>
								</div>


                            `);

                        }

                        if(data.cart.service == 'Housekeeping'){

                            var date = data.cart.pickup_date

                            var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

                            var a = new Date(date);
                            var day = weekday[a.getDay()];

                            var time = data.cart.pickup_time
                            time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

                            if (time.length > 1) { // If time format correct
                                time = time.slice (1);  // Remove full string match value
                                time[5] = +time[0] < 12 ? ' AM' : ' PM'; // Set AM/PM
                                time[0] = +time[0] % 12 || 12; // Adjust hours
                                time[0] = ( String(time[0]).length == 2) ? time[0] : '0' + time[0]
                            }
                            time = time.join ('');

                            $('#profile_myservice').append(`

                                <div class="pro_plan_blue">
									 <h5> Next Housekeeping  </h5>
									 <div class="widt_50">
										<div class="time_set" data-toggle="modal" data-target="#add_cart2">
											<b> `+ day +` (cleaning)</b>
											<p> Time: `+ time +`</p>

										 </div>
										<a data-toggle="modal" id="" class="serv_btn specialrequest_housekeeping" data-subscription_id="`+ data.id +`" > Special Request</a>
									 </div>
									 <div class="widt_50">
										<a data-toggle="modal"  data-subscription_id="`+ data.id +`" id="" class="srv_lock housekeeping_reschedule"><img src="{{asset('web/images/lock.png')}}" > </a>
 									 </div>
								</div>

                            `);

                            $('#London4').append(`

						<h3>Clean my house every…</h3>
						<div  class="pro_text">
						<form class="Edit161">
						<div class="form-group">
							<div class="row">
							<div class="col-md-6">
							<label> Select a Date</label>
								<input type="date" name="housekeeping_pickup_date1" value="`+ data.cart.pickup_date +`" placeholder="Select a date" value="">
							</div>
							<div class="col-md-6">
								<label> Select Time</label>
								<input type="time" name="housekeeping_pickup_time1" value="`+ data.cart.pickup_time +`" placeholder="Select a date" value="">
							</div>
							</div>
							</div>
							<div class="form-group">
							<div class="row">
							<div class="col-md-12">
							<label> My Address</label>
								<input type="text" name="housekeeping_address1" value="`+ data.cart.address +`" placeholder="Enter Address" value="">
							</div>

							</div>
							</div>
							<div class="form-group">
							<div class="row">
							<div class="col-md-6">
							<a href="" data-subscription_id="`+ data.id +`" id="housekeepingreschedule" onclick="return false" class="yellow_btn"> Next</a>
							</div>

							</div>
							</div>
							</form>


						</div>

                            `);

                            $('#myservicescreen').append(`

                                <div class="pro_plan_blue">
									 <h5> Next Housekeeping  </h5>
									 <div class="widt_50">
										<div class="time_set" data-toggle="modal" data-target="#add_cart2">
											<b> `+ day +` (cleaning)</b>
											<p> Time: `+ time +`</p>

										 </div>
										<a data-toggle="modal" id="" class="serv_btn specialrequest_housekeeping" data-subscription_id="`+ data.id +`" > Special Request</a>
									 </div>
									 <div class="widt_50">
										<a data-toggle="modal"  data-subscription_id="`+ data.id +`" id="" class="srv_lock housekeeping_reschedule"><img src="{{asset('web/images/lock.png')}}" > </a>
 									 </div>
								</div>

                            `);

                        }

                        if(data.cart.service == 'Storage'){
                            var time = data.cart.dropoff_time
                            time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

                            if (time.length > 1) { // If time format correct
                                time = time.slice (1);  // Remove full string match value
                                time[5] = +time[0] < 12 ? ' AM' : ' PM'; // Set AM/PM
                                time[0] = +time[0] % 12 || 12; // Adjust hours
                                time[0] = (String(time[0]).length == 2) ? time[0] : '0' + time[0]
                            }
                            time = time.join ('');

                            var time1 = data.cart.pickup_time
                            time1 = time1.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

                            if (time1.length > 1) { // If time format correct
                                time1 = time1.slice (1);  // Remove full string match value
                                time1[5] = +time1[0] < 12 ? ' AM' : ' PM'; // Set AM/PM
                                time1[0] = +time1[0] % 12 || 12; // Adjust hours
                                time1[0] = (String(time1[0]).length == 2) ? time1[0] : '0' + time1[0]
                            }
                            time1 = time1.join ('');

                            $('#profile_myservice').append(`

                                <div class="pro_plan_blue">
									 <h5> My Storage  </h5>
									 <div class="widt_50">
										<b> Packing Material Arrives </b>
										<p> Date:<b> `+ data.cart.dropoff_date +` </b></p>
										<p> Time:<b> `+ time +` </b></p>
									<!--	<a data-toggle="modal" class="serv_btn storage_dropoff" id="" data-subscription_id="`+ data.id +`" > Reschedule</a>  -->
									 </div>

                                     <a data-toggle="modal" style="float: right; width:50%" class="serv_btn storage_dropoff" id="" data-subscription_id="`+ data.id +`" > Reschedule</a>

								</div>

                            `);

                                $('#dropoff_date_storage').val(data.cart.dropoff_date)
                                $('#dropoff_time_storage').val(data.cart.dropoff_time)
                                $('#dropoff_address_storage').val(data.cart.address)

                            $('#profile_myservice').append(`

                                <div class="pro_plan_blue">
									 <h5> My Storage  </h5>
									 <div class="widt_50">
										<b> Storage Pick-up</b>
										<p> Date: <b> `+ data.cart.pickup_date + ` </b></p>
										<p> Time: <b> `+ time1 + ` </b></p>
									<!--	 <a data-toggle="modal" class="serv_btn storage_pickup" id="" data-subscription_id="`+ data.id +`" > Reschedule</a> -->
									 </div>
                                     <a data-toggle="modal" style="float: right; width:50%" class="serv_btn storage_pickup" id="" data-subscription_id="`+ data.id +`" > Reschedule</a>
								</div>

                            `);

                                $('#pickup_date_storage').val(data.cart.pickup_date)
                                $('#pickup_time_storage').val(data.cart.pickup_time)
                                $('#pickup_address_storage').val(data.cart.address)

                            $('#London4').append(`

                            <h3>Storage Service</h3>
						<div  class="pro_text fomr_blue">
							<div  class="row">
								<div class="col-md-6">
									<div class="form-group">
									 <label> Deliver my packing materials	Date</label>
									 <input type="date" name="dropoff_date1" value="`+ data.cart.dropoff_date +`" class="form-control" required="" placeholder="Select date and time ">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									 <label> Deliver my packing materials	Time	</label>
									 <input type="time" name="dropoff_time1" value="`+ data.cart.dropoff_time +`" class="form-control" required="" placeholder="Select date and time ">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
									 <label>From</label>
									 <input type="text" name="dropoff_address1" value="`+ data.cart.address +`" class="form-control" required="" placeholder="Address">
									</div>
								</div>

								<div class="col-md-6">

									 <a href="" data-subscription_id="`+ data.id +`"  id="storagereschedule" onclick="return false" class="yellow_btn" > Next</a>
								</div>
							</div>
							</div>

                            `);

                            $('#myservicescreen').append(`

                                <div class="pro_plan_blue">
									 <h5> My Storage  </h5>
									 <div class="widt_50">
										<b> Packing Material Arrives </b>
										<p> Date:<b> `+ data.cart.dropoff_date +` </b></p>
										<p> Time:<b> `+ time +` </b></p>
										<a data-toggle="modal" class="serv_btn storage_dropoff" id="" data-subscription_id="`+ data.id +`" > Reschedule</a>
									 </div>

								</div>

                            `);

                            $('#myservicescreen').append(`

                                <div class="pro_plan_blue">
									 <h5> My Storage  </h5>
									 <div class="widt_50">
										<b> Storage Pick-up</b>
										<p> Date: <b> `+ data.cart.pickup_date + ` </b></p>
										<p> Time: <b> `+ time1 + ` </b></p>
										<a data-toggle="modal" class="serv_btn storage_pickup" id="" data-subscription_id="`+ data.id +`" > Reschedule</a>
									 </div>
								</div>

                            `);

                        }
                    }

                        $('.laundry').click(function(){
                            var this_week = $(this).data('week');

                            var subscription_id = $(this).data('subscription_id');
                            $('input[name="subscription_id"]').val(subscription_id)

                            if(this_week){
                                alert('You already purchased inventry for this week!');
                                return false;
                            }

                            $.ajax({
                                type:"get",
                                url:"{{ url('api/getLaundryItems') }}",
                                beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
                                complete: function(e, xhr, settings){

                                    var body = e.responseJSON.body
                                    for(var i=0; i < body.length; i++ ){
                                        var data = body[i];

                                        $('#laundry_inventry_submit').before(`

                                            <div class="form-group order_list" style="display: flex;">
                                                <input type="text" class="form-control inventry" data-inventry_id="`+ data.id +`" data-name="`+ data.name +`" style="height: 48px;" autocomplete="off" placeholder="Please enter quantity">
                                               <label> `+ data.name +` </label>

                                            </div>

                                        `);
                                    }

                                    $('#com1').modal('show');

                                    $('#open_dryclean').click(function(){
                                        $.ajax({
                                            type:"get",
                                            url: "{{ url('api/getdrycleanItems') }}",
                                            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
                                            complete: function(e, xhr, settings){

                                                var body = e.responseJSON.body
                                                $('#dryclean_items').html('');
                                                for(var i=0; i < body.length; i++ ){
                                                    var data = body[i];
                                                    $('#dryclean_items').append(`
                                                        <p>`+ data.description +`: $`+ data.price +`
                                                        <span>
                                                             <input type="textt" class="form-control dryclean" data-description="`+ data.description +`" data-price = `+ data.price +` data-dryclean_id="`+ data.id + `"  style="width: 70px;height: 35px;" value="" autocomplete="new-email">
                                                        </span>
                                                        </p>
                                                    `);

                                                }
                                            }
                                        })
                                    })

                                    $('#close_dryclean').click(function(){
                                        $('#com1').modal('show');
                                    })

                                }

                            })

                        });


                        $('#laundry_next').click(function(){

                            var inventry = $('.inventry');
                            var dryclean = $('.dryclean');

                            var laundry_items = [];
                            var dryclean_id = [];
                            var total = 0;

                            // if(laundry_items.length < 1){
                            //     alert('Please select the inventory items.')
                            //     return false;
                            // }

                            // laundry_items = JSON.stringify(laundry_items)

                            for(var i = 0; i < dryclean.length; i++){
                                var value = $(dryclean[i]).val()
                                if(value != null && value != '' ){
                                    var currentprice = ( parseInt($(dryclean[i]).val()) * parseFloat($(dryclean[i]).data('price')) );
                                    dryclean_id.push({
                                        "dryclean_id":$(dryclean[i]).data('dryclean_id'),
                                        "description":$(dryclean[i]).data('description'),
                                        "price": currentprice,
                                        "quantity":$(dryclean[i]).val()
                                    })
                                    total = total + ( parseInt($(dryclean[i]).val()) * parseFloat($(dryclean[i]).data('price')) );
                                }
                            }

                            for(var i = 0; i < inventry.length; i++){
                                var value = $(inventry[i]).val()
                                if(value != null && value != '' ){
                                    var currentprice = ( parseInt($(inventry[i]).val()) * parseFloat($(inventry[i]).data('price')) );
                                    laundry_items.push({
                                        "inventory_id":$(inventry[i]).data('inventry_id'),
                                        "name":$(inventry[i]).data('name'),
                                        "quantity":$(inventry[i]).val()
                                    })
                                }
                            }

                            console.log(laundry_items)

                            if(dryclean_id.length < 1){
                                // alert('inside');
                                $('#submit_laundry').trigger('click')
                                return false
                            }


                            var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
                            var a = new Date();
                            var day = weekday[a.getDay()];
                            var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                            var month = months[a.getMonth()] ;
                            var date = a.getDate()

                            var date = day + ', ' + month + ' ' +  ( (String(date) <= 3) ? date + 'rd' : date + 'th' );

                            $('.transaction_date').html('Transaction date '+ date)

                            dryclean_id.forEach(function(item, index){
                                $('#dryclean_items_show').html(`

                                <div class="tm"><strong>` + item.description +` x `+ item.quantity +` </strong><span> $`+ item.price.toFixed(2) +`</span></div>

                                `);

                            });

                            $('#dryclean_items_show').append(`
                                <div class="tm"><strong> Inventory Items </strong></div>
                            `)

                            laundry_items.forEach(function(item, index){
                                $('#dryclean_items_show').after(`

                                <div class="tm"><strong>` + item.name +` x `+ item.quantity +` </strong><span></span></div>

                                `);

                            });

                            $('#laundrysubtotal').text(total.toFixed(2))
                            $('#laundrytotal').text(total.toFixed(2))
                            $('input[name="laundry_total"]').val(total)
                            // console.log(total);

                            $('#overcharges').modal('show')

                            $('.gratiity_select').click(function(){

                                var gratuity_discount = $(this).data('value')
                                var gratuity = $(this).data('value')
                                if(gratuity == 'other'){
                                    $('input[name="gratuity"]').val('')
                                    $('#gratuity_input').css('display','flex')

                                    $('input[name="gratuity"]').val(0)
                                    $('input[name="gratuity_amount"]').val(0)

                                    $('#gratuity_select_disocunt').text('0')
                                    $('#gratuity_select_disocuntpercentage').text('0.0')

                                    // $('#laundrysubtotal').text(total.toFixed(2))
                                    $('#laundrytotal').text(total.toFixed(2))
                                    $('input[name="laundry_total"]').val(total)
                                    return false
                                }else{
                                    $('#gratuity_input').css('display','none')
                                }

                                gratuity = parseInt(gratuity)


                                gratuity = (gratuity / 100) * total
                                gratuity = gratuity.toFixed(2)

                                $('input[name="gratuity"]').val(gratuity_discount)
                                $('input[name="gratuity_amount"]').val(gratuity)

                                $('#gratuity_select_disocunt').text(gratuity)
                                $('#gratuity_select_disocuntpercentage').text(gratuity_discount )

                                total_amount = parseFloat(total) + parseFloat(gratuity);
                                console.log(total_amount)
                                // $('#laundrysubtotal').text(total_amount.toFixed(2))
                                $('#laundrytotal').text(total_amount.toFixed(2))
                                $('input[name="laundry_total"]').val(total_amount)

                            });

                            $('#grautity_apply').click(function(){
                                    var gratuity_discount = $('input[name="gratuity"]').val()
                                    var gratuity = $('input[name="gratuity"]').val()
                                    if((gratuity_discount == '0') || isNaN(gratuity_discount) || (gratuity_discount == '00') ){

                                        gratuity = 0
                                        gratuity_discount = 0

                                        $('input[name="gratuity"]').val(gratuity_discount)
                                        $('input[name="gratuity_amount"]').val(gratuity)

                                        $('#gratuity_select_disocunt').text(gratuity)
                                        $('#gratuity_select_disocuntpercentage').text(gratuity_discount )

                                        total_amount = parseFloat(total) + parseFloat(gratuity);
                                        console.log(total_amount)
                                        // $('#laundrysubtotal').text(total_amount.toFixed(2))
                                        $('#laundrytotal').text(total_amount.toFixed(2))
                                        $('input[name="laundry_total"]').val(total_amount)

                                        // alert('Please enter the correct discount percentage');
                                        return false
                                    }

                                    gratuity = (gratuity / 100) * total
                                    gratuity = gratuity.toFixed(2)
                                    $('input[name="gratuity"]').val(gratuity_discount)
                                    $('input[name="gratuity_amount"]').val(gratuity)

                                    $('#gratuity_select_disocunt').text(gratuity)
                                    $('#gratuity_select_disocuntpercentage').text(gratuity_discount )

                                    total_amount = parseFloat(total) + parseFloat(gratuity);
                                    console.log(total_amount)
                                    // $('#laundrysubtotal').text(total_amount.toFixed(2))
                                    $('#laundrytotal').text(total_amount.toFixed(2))
                                    $('input[name="laundry_total"]').val(total_amount)

                            });

                            $.ajax({
                                    type:"get",
                                    url: "{{ url('api/getCards') }}",
                                    beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
                                    complete: async function(e, xhr, settings){

                                        if(e.responseJSON.status == 200){
                                            var body = e.responseJSON.body.defaultCard

                                            var cardNumber = String(body.card_number)
                                            cardNumber = cardNumber.substr( 14 )

                                            var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                                            var addedon = body.updated_at
                                            addedon = addedon.substr(0,10 )

                                            var date = new Date(addedon);
                                            var getDate = date.getDate();

                                            getDate = (getDate >= 10 ) ? getDate : '0'+ getDate;
                                            var getMonth = months[date.getMonth()] ;

                                            var getYear = date.getFullYear();
                                            addedon = getMonth+ ' ' + getDate + ', ' + getYear;


                                            $('.cardlastdigits').text('Ending **'+ cardNumber)
                                            $('.cardadded').text('Added on '+ addedon)
                                            $('input[name="laundry_card_id"]').val(body.id)
                                        }

                                        $.ajax({
                                            type:"get",
                                            url: "{{ url('demoCardToken') }}",
                                            success: function(result){
                                                $('input[name="laundry_token"]').val(result)

                                            }
                                        })

                                    }
                                })


                        });

                        $('.storage_dropoff').click(function(){
                            var subscription_id = $(this).data('subscription_id');
                            $('input[name="subscription_id"]').val(subscription_id)
                            $("#upgrade").modal('show')
                        })

                        $('.storage_pickup').click(function(){
                            var subscription_id = $(this).data('subscription_id');
                            $('input[name="subscription_id"]').val(subscription_id)
                            $("#upgrade1").modal('show')
                        })

                        $('.housekeeping_reschedule').click(function(){
                            var subscription_id = $(this).data('subscription_id')
                            $('input[name="subscription_id"]').val(subscription_id)
                            $('#dated').modal('show')
                        })



                        $('.specialrequest_housekeeping').click(function(){
                            var subscription_id = $(this).data('subscription_id');
                            $('input[name="subscription_id"]').val(subscription_id);

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

                                    $('#housekeeping_items_proceed').click(function(){
                                        var addons = [];
                                        var total_price = 0;
                                            $.each($("input[name='housekeeping_selected']:checked"), function(){
                                                addons.push({
                                                    "addon_id": $(this).val(),
                                                    "quantity": '1',
                                                    "description": $(this).data('description'),
                                                    "price": $(this).data('price'),
                                                });
                                                total_price = total_price + parseFloat($(this).data('price'));
                                            });

                                            if(addons.length < 1){
                                                alert('Please select Addons first!');
                                                return false
                                            }

                                            total_price = total_price.toFixed(2)

                                            $('#review_houskeeping').modal('show')

                                            $('#houskeeping_insert_item_maindiv').html(`
                                                <h5 id="houskeeping_insert_item">Item</h5>
                                            `);


                                            addons.forEach(function(item, index){
                                                $('#houskeeping_insert_item').after(`

                                                <div class="tm"><strong>`+ item.description +`</strong><span>$`+ item.price +`</span></div>

                                                `);

                                            });

                                            $('input[name="housekeeping_addons"]').val(JSON.stringify(addons));

                                            $('#housekeeping_total').text('$'+ total_price)

                                            $.ajax({
                                                type:"get",
                                                url: "{{ url('api/getCards') }}",
                                                beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
                                                complete: async function(e, xhr, settings){

                                                    if(e.responseJSON.status == 200){
                                                        var body = e.responseJSON.body.defaultCard

                                                        var cardNumber = String(body.card_number)
                                                        cardNumber = cardNumber.substr( 14 )

                                                        var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                                                        var addedon = body.updated_at
                                                        addedon = addedon.substr(0,10 )

                                                        var date = new Date(addedon);
                                                        var getDate = date.getDate();

                                                        getDate = (getDate >= 10 ) ? getDate : '0'+ getDate;
                                                        var getMonth = months[date.getMonth()] ;

                                                        var getYear = date.getFullYear();
                                                        addedon = getMonth+ ' ' + getDate + ', ' + getYear;


                                                        $('.cardlastdigits').text('Ending **'+ cardNumber)
                                                        $('.cardadded').text('Added on '+ addedon)
                                                        $('input[name="housekeeping_card_id"]').val(body.id)
                                                    }

                                                    $.ajax({
                                                        type:"get",
                                                        url: "{{ url('demoCardToken') }}",
                                                        success: function(result){
                                                            $('input[name="housekeeping_card_token"]').val(result)

                                                    // var token = ($('input[name="housekeeping_card_token"]').val())
                                                    // var card_id = ($('input[name="housekeeping_card_id"]').val())
                                                    // var subscription_id = ($('input[name="subscription_id"]').val())
                                                    // var total_amount = (total_price)
                                                    // var addons = (JSON.stringify(addons))

                                                    //     $('input[name="housekeeping_addons"]').val(addons);
                                                    //         alert($('input[name="housekeeping_addons"]').val())

                                                    $('#housekeeping_paynow').click(function(){
                                                        var token = ($('input[name="housekeeping_card_token"]').val())
                                                        var card_id = ($('input[name="housekeeping_card_id"]').val())
                                                        var subscription_id = ($('input[name="subscription_id"]').val())
                                                        var total_amount = (total_price)
                                                        var addons = $('input[name="housekeeping_addons"]').val();

                                                        $('#housekeeping_paynow').css({
                                                            "pointer-events": "none"
                                                        });

                                                        $.ajax({
                                                            type:"post",
                                                            url:"{{ url('api/housekeepingSpecialRequest') }}",
                                                            data: {token:token, card_id:card_id, subscription_id:subscription_id, total_amount:total_amount,addon:addons},
                                                            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
                                                            complete: function(e, xhr, settings){
                                                                alert(e.responseJSON.message)
                                                                if(e.responseJSON.status == 200){
                                                                    location.reload()
                                                                }
                                                            }
                                                        })
                                                    })

                                                        }
                                                    })

                                                }
                                            })


                                        });


                                }
                            })

                        })

                }



            })
    }

    myservice();


    // $('#updatecard').click(function(){

    // })

    var years = [];
    // var date = date();
    var getCurrentYear = new Date().getFullYear();
    years.push(getCurrentYear);
    for(var i=1;i<10;i++ ){
        getCurrentYear = getCurrentYear + 1;
        years.push(getCurrentYear);
    }

    $.each(years, function(key, value) {


        if("{{$paymentDetails->expiry_year ?? ''}}" == value){
        $('#expiry_year').append($("<option selected></option>")
                    .attr("value", value)
                    .text(value));        }else{
        $('#expiry_year').append($("<option></option>")
                    .attr("value", value)
                    .text(value));
        }

    });


    $('#editprofiledone').click(function(){
        location.reload()
    })



    $("body").on('click','#currenthistory',function(){
        $.ajax({
            type:"get",
            url:"{{ url('api/currentOrder') }}",
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            complete: function(e, xhr, settings){
                if(e.responseJSON.body.length > 0){

                    var body =  e.responseJSON.body

                    $('#billingData').html(`

                    <div class="pro_text">
                        <div class="row">
                            <div class="col-md-6">
                                    <button id="pasthistory" style="padding: 10px;width: auto;">Past History</button>
                            </div>

                            <div class="col-md-6">
                                <button id="currenthistory" style="padding: 10px;width: auto;float: left;">Current History</button>
                            </div>

                        </div>
                    </div>

                    `);

                    body.forEach(function(item, index){

                        var url = "{{ URL::to('/') }}";

                        url += '/api/orderDetails/'+ item.id;

                        $.ajax({
                            type:"get",
                            url: url,
                            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
                            complete: function(e, xhr, settings){
                                // console.log(e.responseJSON.body)

                                var data = e.responseJSON.body


                                var date = (data.subscription.cart.pickup_date) ? data.subscription.cart.pickup_date : data.subscription.cart.dropoff_date

                                var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

                                var a = new Date(date);
                                var day = weekday[a.getDay()];


                                var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

                                var month = months[a.getMonth()] ;
                                var date = a.getDate()

                                var date = day + ', ' + month + ' ' +  ( (String(date) <= 3) ? date + 'rd' : date + 'th' );

                                var order_status = data.order_status
                                if(order_status == "0" ){
                                    order_status = 'Order confirmed - Received'
                                }
                                if(order_status == "1" ){
                                    order_status = 'Order confirmed - Processing'
                                }
                                if(order_status == "2" ){
                                    order_status = 'Order confirmed - Completed'
                                }

                                var total_amount = (data.total_amount != '') ? data.total_amount : 0.00;

                                var heading = data.service
                                if(heading == 'Housekeeping'){
                                    heading = 'Addons'
                                }
                                if(heading == 'Storage'){
                                    heading = 'Addons'
                                }
                                if(heading == 'Laundry'){
                                    heading = 'Wash and Fold Inventory'
                                }

                                var id = '#'+data.id;
                                var check = $(".pro_plan_main").is(id);

                                if(check){
                                    return;
                                }

                                $('#billingData').append(`

                                    <div style="margin-bottom: 15px;" class="pro_plan_main" id="`+ data.id +`">
                                    <div class="pro_plan_blue">
                                    <h4 style="margin-bottom: 15px;"> Service:- <u>`+ data.service +`</u>
                                    <em style="float:right;font-style: normal;">OrderId:-<u> ORD`+ data.id +`</u></em>
                                    </h4>
                                        <h5> `+ date +` <small> `+ order_status +` </small>  </h5>
                                        <span> $`+ parseFloat(total_amount).toFixed(2) +`</span>
                                    </div>
                                    <div class="pro_plan_list billingdata_addons_`+ data.id +`" >

                                    </div>
                                </div>

                                `);

                                var service = data.service
                                if(service == 'Laundry'){

                                    var drycleanItems = (data.drycleanItems.length > 0) ? data.drycleanItems : [];
                                    var laundryItems = (data.laundryItems.length > 0) ? data.laundryItems : [];
                                    // console.log(data.laundryItems.length)
                                    var drycleanItemsHTML = '';
                                    var LaundryItemsHTML = '';

                                    laundryItems.forEach(function(item,index){
                                        var quantity = item.quantity
                                        var name = item.item_name

                                        LaundryItemsHTML += "<p>"+ quantity +" X "+ name +"</p>"

                                    });

                                    drycleanItems.forEach(function(item,index){
                                        var quantity = item.quantity
                                        var name = item.dryclean_name

                                        drycleanItemsHTML += "<p>"+ quantity +" X "+ name +"</p>"

                                    });

                                    var selector = ".billingdata_addons_"+ data.id

                                    $(selector).append(`

                                        <h5> `+ heading +` </h5>
                                        `+ LaundryItemsHTML +`
                                        <h1>Dry Cleaning</h1>
                                        `+ drycleanItemsHTML +`
                                        <h6> Actual Weight  <span> 0</span> </h6>
                                        <h6>Overage Charges   <span> $0</span> </h6>
                                        <h6>Gratuity   <span> $`+ data.gratuity +`</span> </h6>
                                        <h6>Total   <span> $`+ total_amount +`</span> </h6>

                                    `)


                                }

                                if(service == 'Housekeeping' || service == 'Storage' ){

                                    var addonsDetail = (data.addonsDetail && (data.addonsDetail.length > 0)) ? data.addonsDetail : [];
                                    if(addonsDetail.length < 1){
                                        return false
                                    }
                                    var addonsDetailHTML = '';

                                    addonsDetail.forEach(function(item,index){
                                        var quantity = item.quantity
                                        var name = item.addon_name
                                        var price = item.price
                                        addonsDetailHTML += "<p>"+ quantity +" X "+ name +" <span style='float: right;'> $"+ price +" </span></p>"

                                    });

                                    // console.log(addonsDetailHTML)
                                    var selector = ".billingdata_addons_"+ data.id

                                    $(selector).append(`

                                        <h5> `+ heading +` </h5>
                                        `+ addonsDetailHTML +`
                                        <h6>Gratuity   <span> $`+ data.gratuity +`</span> </h6>
                                        <h6>Total   <span> $`+ total_amount +`</span> </h6>

                                    `)

                                }

                            }
                        })

                    })



                }else{
                    alert('No current orders!')

                    $('#billingData').html(`

                    <div class="pro_text">
                        <div class="row">
                            <div class="col-md-6">
                                    <button id="pasthistory" style="padding: 10px;width: auto;">Past History</button>
                            </div>

                            <div class="col-md-6">
                                <button id="currenthistory" style="padding: 10px;width: auto;float: left;">Current History</button>
                            </div>

                        </div>
                    </div>

                    `);

                }
            }
        });
    })


        $("body").on('click','#pasthistory',function(){
            // alert('sda')
        $.ajax({
            type:"get",
            url:"{{ url('api/pastOrder') }}",
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            complete: function(e, xhr, settings){
                if(e.responseJSON.body.length > 0){

                    $('#billingData').html(`

                    <div class="pro_text">
                        <div class="row">
                            <div class="col-md-6">
                                    <button id="pasthistory" style="padding: 10px;width: auto;">Past History</button>
                            </div>

                            <div class="col-md-6">
                                <button id="currenthistory" style="padding: 10px;width: auto;float: left;">Current History</button>
                            </div>

                        </div>
                    </div>

                    `);

                    var body =  e.responseJSON.body

                    body.forEach(function(item, index){

                        var url = "{{ URL::to('/') }}";

                        url += '/api/orderDetails/'+ item.id;

                        $.ajax({
                            type:"get",
                            url: url,
                            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
                            complete: function(e, xhr, settings){
                                // console.log(e.responseJSON.body)

                                var data = e.responseJSON.body

                                var date = (data.subscription.cart.pickup_date) ? data.subscription.cart.pickup_date : data.subscription.cart.dropoff_date

                                var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

                                var a = new Date(date);
                                var day = weekday[a.getDay()];


                                var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

                                var month = months[a.getMonth()] ;
                                var date = a.getDate()

                                var date = day + ', ' + month + ' ' +  ( (String(date) <= 3) ? date + 'rd' : date + 'th' );

                                var order_status = data.order_status
                                if(order_status == "0" ){
                                    order_status = 'Order confirmed - Received'
                                }
                                if(order_status == "1" ){
                                    order_status = 'Order confirmed - Processing'
                                }
                                if(order_status == "2" ){
                                    order_status = 'Order confirmed - Completed'
                                }

                                var total_amount = (data.total_amount != '') ? data.total_amount : 0.00;

                                var heading = data.service
                                if(heading == 'Housekeeping'){
                                    heading = 'Addons'
                                }
                                if(heading == 'Storage'){
                                    heading = 'Addons'
                                }
                                if(heading == 'Laundry'){
                                    heading = 'Wash and Fold Inventory'
                                }


                                $('#billingData').append(`

                                    <div class="pro_plan_main" id="`+ data.id +`">
                                    <div class="pro_plan_blue">
                                    <h4 style="margin-bottom: 15px;"> Service:- <u>`+ data.service +`</u>
                                    <em style="float:right;font-style: normal;">OrderId:-<u> ORD`+ data.id +`</u></em>
                                    </h4>
                                        <h5> `+ date +` <small> `+ order_status +` </small>  </h5>
                                        <span> $`+ total_amount +`</span>
                                    </div>
                                    <div class="pro_plan_list billingdata_addons_`+ data.id +`" >

                                    </div>
                                </div>

                                `);

                                var service = data.service
                                if(service == 'Laundry'){

                                    var drycleanItems = (data.drycleanItems.length > 0) ? data.drycleanItems : [];
                                    var laundryItems = (data.laundryItems.length > 0) ? data.laundryItems : [];
                                    // console.log(data.laundryItems.length)
                                    var drycleanItemsHTML = '';
                                    var LaundryItemsHTML = '';

                                    laundryItems.forEach(function(item,index){
                                        var quantity = item.quantity
                                        var name = item.item_name

                                        LaundryItemsHTML += "<p>"+ quantity +" X "+ name +"</p>"

                                    });

                                    drycleanItems.forEach(function(item,index){
                                        var quantity = item.quantity
                                        var name = item.dryclean_name

                                        drycleanItemsHTML += "<p>"+ quantity +" X "+ name +"</p>"

                                    });

                                    var selector = ".billingdata_addons_"+ data.id

                                    $(selector).append(`

                                        <h5> `+ heading +` </h5>
                                        `+ LaundryItemsHTML +`
                                        <h1>Dry Cleaning</h1>
                                        `+ drycleanItemsHTML +`
                                        <h6> Actual Weight  <span> 0</span> </h6>
                                        <h6>Overage Charges   <span> $0</span> </h6>
                                        <h6>Gratuity   <span> $`+ data.gratuity +`</span> </h6>
                                        <h6>Total   <span> $`+ total_amount +`</span> </h6>

                                    `)


                                }

                                if(service == 'Housekeeping' || service == 'Storage' ){

                                    var addonsDetail = (data.addonsDetail && (data.addonsDetail.length > 0)) ? data.addonsDetail : [];

                                    if(addonsDetail.length < 1){
                                        return false
                                    }

                                    var addonsDetailHTML = '';

                                    addonsDetail.forEach(function(item,index){
                                        var quantity = item.quantity
                                        var name = item.addon_name
                                        var price = item.price
                                        addonsDetailHTML += "<p>"+ quantity +" X "+ name +" <span style='float: right;'> $"+ price +" </span></p>"

                                    });

                                    // console.log(addonsDetailHTML)
                                    var selector = ".billingdata_addons_"+ data.id

                                    $(selector).append(`

                                        <h5> `+ heading +` </h5>
                                        `+ addonsDetailHTML +`
                                        <h6>Gratuity   <span> $`+ data.gratuity +`</span> </h6>
                                        <h6>Total   <span> $`+ total_amount +`</span> </h6>

                                    `)

                                }

                            }
                        })

                    })



                }else{
                    alert('No Past orders!')

                    $('#billingData').html(`

                    <div class="pro_text">
                        <div class="row">
                            <div class="col-md-6">
                                    <button id="pasthistory" style="padding: 10px;width: auto;">Past History</button>
                            </div>

                            <div class="col-md-6">
                                <button id="currenthistory" style="padding: 10px;width: auto;float: left;">Current History</button>
                            </div>

                        </div>
                    </div>

                    `);
                }
            }
        });
    })


});

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
    });

    function checkGratiuty(evt){
        // alert('adasd')
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57) ) {
            return false;
        }

        var length = $('input[name="gratuity"]').val().length
        if(length > 1 ){
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

var claimData;

    $('#openAllClaims').click(function(){

            $.ajax({
                type:"get",
                url: "{{ url('api/getAllClaim') }}",
                beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
                complete : function(e, xhr, settings){

                        if(e.responseJSON.status == 200){

                            var body = e.responseJSON.body
                            claimData = body
                            $('.claimData').html('')
                            body.forEach(function(item,index){

                                var resolved = item.resolution
                                if(resolved == '1'){
                                    resolved = 'Solved'
                                }else{
                                    resolved = 'In-Process'
                                }

                                $('.claimData').append(`
                                    <tr class="claimDetails" data-id="`+ item.id +`" >
                                    <td><img src="`+ item.image +`" width="75" ></td>
                                    <td style="min-width: 250px;">
                                    <strong>Item: `+ item.item +`</strong>
                                    <span>`+ resolved +`</span>
                                    </td>
                                    </tr>
                                `)

                            })

                            $('#AllClaims').modal('show')

                            $('.closeClaimData').click(function(){
                                $('#AllClaims').modal('show')
                                $('#Claim').modal('hide')
                            })

                        }else{
                            alert('Something went wrong. Please try again later');
                        }
                }
            })

    })

        $('body').on('click', '.claimDetails',function(){

        var id = $(this).data('id')

        var data = claimData.filter(function(item){
            if(item.id == id){
                return item;
            }
        })

        // console.log(data)

        if(data.length > 0){
            data = data[0]

            var status = (data.status == '1') ? "Resolved" : "Pending"
            var resolve = (data.resolution == '1') ? "Resolved" : "In-process"
            var date_resolution = (data.date_resolution != null ) ? data.date_resolution : "--"
            $('#cliamDetailData').html(`

            <tr>
                <td style="text-align: ;">Claim</td>
                <td>`+ data.claim_id +`</td>
            </tr>
            <tr>
                <td >Color </td>
                <td>`+ data.color +`</td>
            </tr>
            <tr>
                <td>Brand</td>
                <td>`+ data.brand +`</td>
            </tr>
            <tr>
                <td>Item Type</td>
                <td>`+ data.item +`</td>
            </tr>
            <tr>
                <td>Size </td>
                <td> `+ data.size +`</td>
            </tr>
            <tr>
                <td>Last Worm On</td>
                <td>`+ data.last_worn +`</td>
            </tr>
            <tr>
                <td>Date Filled</td>
                <td>`+ new Date('Y-m-d',data.created_at) +`</td>
            </tr>
            <tr>
                <td>Status</td>
                <td class="In-Progress">`+ status +`</td>
            </tr>
            <tr>
                <td>Resolution</td>
                <td class="In-Progress">`+ resolve +`</td>
            </tr>
            <tr>
            <td>Date Resolved</td>
                <td class="Resolved">-</td>
            </tr>

            `)

            $('#AllClaims').modal('hide')
            $('#Claim').modal('show')

        }else{
            alert('Something went wrong!')
            return false
        }
    })

    $('.subscription').click(function(){

        $.ajax({
            type:"get",
            url: "{{ url('api/subscriptions') }}",
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            complete: function(e, xhr, settings){

                if(e.responseJSON.status == 200){
                    var body = e.responseJSON.body
                    if(body.length > 0){

                        $('#currentSubscription').html('');

                        body.forEach(function(item,index){
                            $('#currentSubscription').append(`

                                <div  class="pro_plan">
								<h5> `+ item.cart.service +`  <span> $`+ item.planDetails.price +`</span> </h5>
								 <small>Monthly </small>
								<p> `+ item.planDetails.description +`</p>
								<h4>
									<a data-toggle="modal" id="upgradeSubscription" data-service="`+ item.cart.service +`" > Upgrade </a> <br>
									<a data-toggle="modal" data-target="#cancel_upgrade" data-id="`+ item.id +`" id="cancel_upgrade" style="color:#f29f00;" > Cancel </a>
								</h4>
							    </div>

                            `)

                        })

                    }else{

                        alert('No subscription found!');
                        return false;

                    }
                }
            }
        })
    });

    $('body').on('click','#upgradeSubscription',function(){
        // alert('adsdas');
        var service = $(this).data('service')
        if(service == 'Laundry'){
            location.replace("{{ route('web.home') }}");
        }

        if(service == 'Storage'){
            location.replace("{{ route('web.storage') }}");
        }

        if(service == 'Housekeeping'){
            location.replace("{{ route('web.housekeeping') }}");
        }
    });


    $('#pills-profile-tab').click(function(){
        $('input[name="tabSelected"]').val('2')
    })

    $('#pills-home-tab').click(function(){
        $('input[name="tabSelected"]').val('1')
    })

    $('body').on('keypress','.inventry' ,function(e){
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57) ) {
            return false;
        }

        var length = $(this).val().length
        if(length > 1){
            return false
        }

        return true;
    })

    $('body').on('keypress','.dryclean' ,function(e){
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57) ) {
            return false;
        }

        var length = $(this).val().length
        if(length > 1){
            return false
        }

        return true;
    })

      </script>

@endsection
