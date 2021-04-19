@extends('layouts.app')

@section('content')

<style>
th{
    width:20%;
    font-weight: 700;
}
span.plan_BINS {
    padding: 16px;
    margin: 0px 0px;
}

.table td:last-child {
    text-align: right !important;
}
.table th:last-child {
    text-align: right;
}

</style>

<?php //echo $data->subscription->cart->dorm_name;die();  ?>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<div class="container-fuild">
  <div class="card">
    <div class="card-body">

  <div style="display: flow-root;">
    <h2 class="pull-left">View Order</h2>
      @if(\Auth::user()->type == 'ADMIN')
  <a href="{{route('orders.index')}}" class="btn btn-default pull-right mt-20">Go Back</a>
  @else
  <a href="{{route('staff.orders.index')}}" class="btn btn-default pull-right mt-20">Go Back</a>
  @endif
  </div>
  
  <div class="proper_bil">
  <div class="row">
	  <div class="col-md-6">
		  <div class="bill_titles">
				<h3> Student info</h3>
				<address>
					@if($data->service == 'Housekeeping') 
                         
                        {{ $data->user->first_name.' '.$data->user->last_name }}<br>
                        {{ $data->user->country_code.' '.$data->user->contact }}<br>
                        {{ $data->user->email}}<br>
                        @if(!empty($data->user->school->school_name))
                            {{ $data->user->school->school_name }}<br>
                        @endif
                       <!--  Address: {{ $data->subscription->cart->address }}<br> -->
                        @if($data->user->in_campus == '1')
                            Drom name: {{ $data->user->hall }}</br>
                            Room Number: {{ $data->user->room_number }}</br>
                        @else
                            City:  {{ $data->user->city }}</br>
                            Zipcode: {{ $data->user->zipcode }}</br>
                        @endif


                    @endif
					
                    @if($data->service == 'Laundry')
                        @if($data->user->in_campus == '1')  
                            Room Number: {{ $data->user->room_number }}</br>
                        @else 
                            Address: {{ $data->user->address }}</br>
                            City: {{ $data->user->city }}</br>
                            Zipcode: {{ $data->user->zipcode }}</br>
                        @endif 
                        Drom Name : {{ $data->subscription->cart->dorm_name }}<br>
                    @endif 

                    @if($data->service == 'Storage')

                        {{ $data->user->first_name.' '.$data->user->last_name }}<br>
                        {{ $data->user->country_code.' '.$data->user->contact }}<br>
                        {{ $data->user->email}}<br>
                        @if(!empty($data->user->school->school_name))
                            {{ $data->user->school->school_name }}<br>
                        @endif
                        @if($data->user->in_campus == '1')  
                            Room Number: {{ $data->user->room_number }}</br>
                        @else 
                            Address: {{ $data->user->address }}</br>
                            City: {{ $data->user->city }}</br>
                            Zipcode: {{ $data->user->zipcode }}</br>
                        @endif   
                        Hall Name: {{ $data->user->hall }} 
                    @endif
				</address>
		  </div>
	  </div>
	  <div class="col-md-6">
		  <div class="bill_titles">
				<h3> Parent info</h3>
				<address>
                    
                    {{ $data->user->pfirst_name.' '.$data->user->plast_name }}<br>
					{{ $data->user->pcontact }}<br>
					{{ $data->user->pemail }}<br><br>

				</address>
		  </div>
	  </div>
  </div>
    @if($data->service == 'Laundry') 
    	<div class="back_colors">
    	    <div class="row no-gutters">
        	    <div class="col-md-6">
        		    <div class="bill_titles1">
        				<h3> Customer</h3>
        				<p><b>  {{ $data->user->first_name }} {{ $data->user->last_name }}</b></p>
        				 @if($data->user->in_campus == '1')
                            <p> {{ $data->user->hall }}</p>
                            <p>  {{ $data->user->room_number }}</p>
                        @else

                            <p>  {{ $data->user->address }}</p>
                            <p> {{ $data->user->city }}</p>
                            <p> {{ $data->user->zipcode }}</p>
                        @endif

                        <!-- <p> 70 Bowman St.</p>
        				<p> South Windsor, CT 06074</p>
        				<p> USA</p> -->
        				<!-- <p class="mt-4"> <b>Terms:</b> 30 Days</p> -->
        				<p class=""> <b>Phone No.:</b> {{ $data->user->contact }}</p>
        				<p class=""> <b>Email:</b> {{ $data->user->email }}</p>
                        
                         
        		   </div>
        	    </div>
        	    <div class="col-md-6">
        		    <div class="bill_titles1">
        				<h3> Preferences</h3>
        				{{-- <p>  {{ $data->service }}</p>
        				<p> {{ $data->plan->description }}( ${{$data->plan->price }}) </p>
                         
                        <p> Drom Name : {{ $data->subscription->cart->dorm_name }} --}}
                        
                        @if(!empty($data->preferences))

                            @if(!empty($data->preferences->detergent))
                                <p> Detergent: {{ $data->preferences->detergent }}</p>
                            @else
                                <p> Detergent: No</p>
                            @endif

                            @if(!empty($data->preferences->oxiclean))
                                @if($data->preferences->oxiclean == '1')
                                    <p> Oxiclean: Yes</p>
                                @else
                                    <p> Oxiclean: No</p>
                                @endif
                            @else
                                <p> Oxiclean: No</p>
                            @endif

                            @if(!empty($data->preferences->starch))
                                @if($data->preferences->starch == '0')
                                    <p> Starch: None</p>
                                @elseif($data->preferences->starch == '1')
                                <p> Starch: Low</p>
                                @elseif($data->preferences->starch == '2')
                                <p> Starch: Medium</p>
                                @elseif($data->preferences->starch == '3')
                                <p> Starch: High</p>
                                @endif 
                            @endif

                            @if(!empty($data->preferences->rush_delivery))
                                @if($data->preferences->rush_delivery == '1')
                                    <p> Rush Delivery: Yes</p>
                                @else
                                    <p> Rush Delivery: No</p>
                                @endif
                            @else
                                <p> Rush Delivery: No</p>
                            @endif

                            @if(!empty($data->preferences->fabric_softner))
                                @if($data->preferences->fabric_softner == '1')
                                    <p> Fabric softner: Yes</p>
                                @else
                                    <p>Fabric softner: No</p>
                                @endif
                            @else
                                <p> Fabric softner: No</p>
                            @endif

                            @if(!empty($data->preferences->delivery_instructions))
                                <p> Delivery Instructions: {{ $data->preferences->delivery_instructions }}</p>
                            @else
                                <p> Delivery Instructions: No</p>
                            @endif
                        @endif
         
        
        				<!-- <p> South Windsor, CT 06074</p>
        				<p> USA</p> -->
        				<!-- <p class="mt-4"> <b>Terms:</b> 30 Days</p>
        				<p class=""> <b>Phone No.:</b> 800-214-2210</p>
        				<p class=""> <b>Email:</b> Admin@gmail.com</p> -->
        		    </div>
        		</div>
        	</div>
    	</div>
    @endif

    @if($data->service == 'Housekeeping') 
        <div class="back_colors">
            <div class="row no-gutters">
                <div class="col-md-6">
                    <div class="bill_titles1">
                        <h3> Home details list only</h3>
                        <!-- <p><b>  {{ $data->user->first_name }} {{ $data->user->last_name }}</b></p>
                         @if($data->user->in_campus == '1')
                            <p> {{ $data->user->hall }}</p>
                            <p>  {{ $data->user->room_number }}</p>
                        @else

                            <p>  {{ $data->user->address }}</p>
                            <p> {{ $data->user->city }}</p>
                            <p> {{ $data->user->zipcode }}</p>
                        @endif 
                        <p class=""> <b>Phone No.:</b> {{ $data->user->contact }}</p>
                        <p class=""> <b>Email:</b> {{ $data->user->email }}</p>
                          -->

                        <?php 
                        $myArray = explode(',', $data->plan->description);
                        foreach($myArray as $my_Array){
                            echo '<p>'.$my_Array.',</p>';  
                        } 
                        ?>

                   </div>
                </div>
                <div class="col-md-6">
                    <div class="bill_titles1">
                        <h3> Preferences</h3>
                        <!-- <p>  {{ $data->service }}</p>
                        <p> @if(isset($data->plan->description))
                            {{ $data->plan->description }}@endif( ${{$data->plan->price }})
                             </p> -->
                        
                        <!-- <p>
                            Drom Name :  {{ $data->subscription->cart->address }}
                        </p> -->
                        @if(!empty($data->preferences))
                            @if(!empty($data->preferences->vaccum == '1'))
                                @if($data->preferences->vaccum == '1')
                                    <p> Vaccum: Yes</p>
                                @else
                                    <p> Vaccum: No</p>
                                @endif
                            @else
                                    <p> Vaccum: No</p>
                            @endif

                            @if(!empty($data->preferences->mop == '1'))
                                @if($data->preferences->mop == '1')
                                    <p> Mop: Yes</p>
                                @else
                                    <p> Mop: No</p>
                                @endif
                            @else
                                    <p> Mop: No</p>
                            @endif

                            @if(!empty($data->preferences->cleaning_product == '1'))
                                @if($data->preferences->cleaning_product == '1')
                                    <p> Cleaning product: Yes</p>
                                @else
                                    <p> Cleaning product: No</p>
                                @endif
                            @else
                                <p> Cleaning product: No</p>

                            @endif

                            @if(!empty($data->preferences->pets == '1'))
                                @if($data->preferences->pets == '1')
                                    <p> Pets: Yes</p>
                                @else
                                    <p> Pets: No</p>
                                @endif 
                            @else
                                <p> Pets: No</p>
                            @endif

                        @endif 
                    </div>
                </div>
            </div>
        </div>
        <div class="back_colors">
        <div class="row no-gutters mt-4">
            <div class="col-md-6">
               <div class="bill_titles1">
                    <h3> Date of cleaning</h3>
                    <p> {{ $data->subscription->cart->pickup_date }} </p>
               </div>
           </div>
           <div class="col-md-6">
                <div class="bill_titles1">
                    <h3> Time</h3>
                    <p> {{ $data->subscription->cart->pickup_time }}</p>
                </div>
            </div>
            <!-- <div class="col-md-3">
              <div class="bill_titles1">
                    <h3> Pickup date</h3>
                    <p> {{ $data->order_date }}</p>
              </div>
            </div>
           <div class="col-md-3">
                <div class="bill_titles1">
                    <h3> Time </h3>
                    <p> {{ $data->order_time }} </p>
                </div>
           </div> -->
        </div>
    </div> 
    @endif

    @if($data->service == 'Storage')
    <!-- <div class="back_colors">
        <div class="row no-gutters">
            <div class="col-md-6">
                <div class="bill_titles1">
                    <h3> Supplies</h3>
                    <p><b> {{ $data->plan->description }}( ${{$data->plan->price }})</b></p>
                  -->    <!-- @if($data->user->in_campus == '1')
                        <p> {{ $data->user->hall }}</p>
                        <p>  {{ $data->user->room_number }}</p>
                    @else

                        <p>  {{ $data->user->address }}</p>
                        <p> {{ $data->user->city }}</p>
                        <p> {{ $data->user->zipcode }}</p>
                    @endif 
                    <p class=""> <b>Phone No.:</b> {{ $data->user->contact }}</p>
                    <p class=""> <b>Email:</b> {{ $data->user->email }}</p> -->
                     
            <!--    </div>
            </div>
            <div class="col-md-6">
                <div class="bill_titles1">
                    <h3> Add-ons </h3>
                    @if(!empty($data->addonsDetail))
                        @foreach($data->addonsDetail as $addon)
                        <p> {{$addon['addon_name']}}</p>
                        @endforeach
                    @endif -->
                   <!--  <p> {{ $data->user->first_name }} {{ $data->user->last_name }}</p>

                    <p>
                        Large Item :  @if($data->large_item == '0'){{ 'No' }}@else{{ 'Yes' }}@endif
                    </p>
                      
                    <p>
                    Hall name : {{ $data->user->hall }}
                    </p>
                    <p>
                    Room Number : {{ $data->user->room_number }}
                    </p>  -->
           <!--      </div>
            </div>
        </div>
    </div> -->
    @endif

    @if($data->service != 'Housekeeping') 
	<div class="back_colors">
	    <div class="row no-gutters mt-4">
	        {{-- <!--  <div class="col-md-3">
    		   <div class="bill_titles1">
    				<h3> Delivery Date</h3>
    				<p> {{ $data->subscription->cart->dropoff_date }} </p>
    		   </div>
	       </div>
	       <div class="col-md-3">
                <div class="bill_titles1">
                    <h3> Time</h3>
                    <p> {{ $data->subscription->cart->dropoff_time }}</p>
                </div>
	        </div> --> --}}
            <div class="col-md-6">
              <div class="bill_titles1">
            		<h3> Pickup date</h3>
            		<p> {{ $data->subscription->cart->dropoff_date }}</p>
              </div>
            </div>
	       <div class="col-md-6">
                <div class="bill_titles1">
                    <h3> Time </h3>
                    <p> {{ $data->subscription->cart->dropoff_time }} </p>
                </div>
	       </div>
	    </div>
	</div> 
    @endif
    

    
  </div>

    @if(\Session::get('success'))
      <div class="alert alert-success hideClass" style="padding:5px;width:50%">
        {{ Session::get('success')  }}
      </div>
    @endif
    @if(Session::has('error'))
      <div class="alert alert-danger hideClass"  style="padding:5px;width:50%">
        {{ Session::get('error')  }}
      </div>
    @endif

    <table class="table table-border table-striped">
    {{-- <tr>
        <th>
            Order Id
        </th>
        <td>
            ORD{{ $data->id }}
        </td>
    </tr> --}}
    @if($data->service == 'Laundry') 

    <table class="table table-border table-striped">
    {{--

        <tr>
            <th>
                Service
            </th>
            <td>
                {{ $data->service }}
            </td>
        </tr>


        <tr>
            <th>
                Plan
            </th>
            <td>
               {{ $data->plan->description }}( ${{$data->plan->price }}) 
            </td>
        </tr>

        <tr>
            <th>
                Date
            </th>
            <td>

                {{ $data->order_date }}
            </td>
        </tr>

        <tr>
            <th>
                Time
            </th>
            <td>
                {{ $data->order_time }}
            </td>
        </tr>

        <tr>
            <th>
                Drycleaning
            </th>
            <td>
                @if(@$data->cart->is_dryclean == '0'){{ 'No' }}@else{{ 'Yes' }} @endif
            </td>
        </tr>

        <tr>
            <th>
                Insurance
            </th>
            <td>
                @if(!empty($data->insurance_price)) ${{$data->insurance_price}} @endif
                @if(!empty($data->plan_type)) {{$data->plan_type}} @endif
            </td>

              
            
        </tr>

        <tr>
            <th>
                Dropoff Date
            </th>
            <td>
                 {{ $data->subscription->cart->dropoff_date }}
            </td>
        </tr>

        <tr>
            <th>
                Dropoff Time
            </th>
            <td>
                 {{ $data->subscription->cart->dropoff_time }}
            </td>
        </tr>

        <tr>
            <th>
                First Name
            </th>
            <td>
                {{ $data->user->first_name }}
            </td>
        </tr>
        <tr>
            <th>
                Last Name
            </th>
            <td>
                {{ $data->user->last_name }}
            </td>
        </tr>
        <tr>
            <th>
                Email
            </th>
            <td>
                {{ $data->user->email }}
            </td>
        </tr>
        <tr>
            <th>
                Phone Number
            </th>
            <td>
                {{ $data->user->contact }}
            </td>
        </tr>
        <tr>
            <th>
                School Name
            </th>
            <td>
                {{ $data->user->school_name }}
            </td>
        </tr>



        <tr>
            <th>
                Drom Name
            </th>
            <td>
                {{ $data->subscription->cart->dorm_name }}
            </td>
        </tr>
    --}}

    {{-- @if($data->user->in_campus == '1')

        <tr>
            <th>
                Hall Name
            </th>
            <td>
                {{ $data->user->hall }}
            </td>
        </tr>

        <tr>
            <th>
                Room Number
            </th>
            <td>
                {{ $data->user->room_number }}
            </td>
        </tr>


        @else

        <tr>
            <th>
                Address
            </th>
            <td>
                {{ $data->user->address }}
            </td>
        </tr>

        <tr>
            <th>
                City
            </th>
            <td>
                {{ $data->user->city }}
            </td>
        </tr>

        <tr>
            <th>
                Zipcode
            </th>
            <td>
                {{ $data->user->zipcode }}
            </td>
        </tr>
        @endif
    --}}

    {{--
        <tr>
            <th>
                Parent Name
            </th>
            <td>
                 {{ $data->user->pfirst_name.' '.$data->user->plast_name }}
            </td>
        </tr>

        <tr>
            <th>
                Parent Email
            </th>
            <td>
                {{ $data->user->pemail }}
            </td>
        </tr>

        <tr>
            <th>
                Parent Contact
            </th>
            <td>
                {{ $data->user->pcontact }}
            </td>
        </tr>



        <tr>
            <th>
                Gratuity
            </th>
            <td>
                {{ $data->gratuity	 }}
            </td>
        </tr>
        <tr>
            <th>
                Tax
            </th>
            <td>
                 {{ $data->subscription->tax   }}
            </td>
        </tr>
        <tr>
            <th>
                Service Fee
            </th>
            <td>
                 {{ $data->subscription->service_fee   }}
            </td>
        </tr>

        <tr>
            <th>
                Total Amount
            </th>
            <td>
                {{ $data->subscription->total   }}
            </td>
        </tr>
        --}}
        </table>

    <table class="table table-border table-striped">
    <h2>Order Items </h2>
        <tr>
            <th>Sno.</th>
            <th>Item name</th>
            <th>Quantity</th>
        </tr>
        @php $j=1; @endphp
        @if($data->laundryItems)
        @foreach ($data->laundryItems as $item)
            <tr>
                <td>{{$j}}</td>
                <td>{{$item['item_name']}}</td>
                <td>{{$item['quantity']}}</td>
            </tr>
            @php $j++; @endphp
        @endforeach
        @endif

    </table>



    <table class="table table-border table-striped">
    <h2>Dryclean Items </h2>
        <tr>
            <th>Sno.</th>
            <th>Addon </th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        @php $j=1; @endphp
        @if($data->drycleanItems)
        @foreach ($data->drycleanItems as $addon)
            <tr>
                <td>{{$j}}</td>
                <td>{{$addon['dryclean_name']}}</td>
                <td>{{$addon['price']}}</td>
                <td>{{$addon['quantity']}}</td>
                <td>{{$addon['quantity'] * $addon['price']}}</td>
            </tr>
            @php $j++; @endphp
        @endforeach
        @endif

    </table>

    <div class="row">
        <div class="col-md-12" >
            <div class="bill_titles1 box"> 
                 
                <h5>  Gratuity :<span> {{ $data->gratuity   }} </span></h5>
                <h5>  Tax : <span>{{ $data->subscription->tax }} </span></h5>
                <h5>  Service Fee : <span>{{ $data->subscription->service_fee }} </span></h5>
            </div>
        </div>
        <div class="col-md-12">
            <div class="bill_titles4">
                            
                <h4> <span>Order Total</span> <span style="background:#f5f8f9; color:#000;"> {{ $data->subscription->total   }}</span> </h4>
            </div>
        </div>
    </div>

@endif

@if($data->service == 'Housekeeping')

<table class="table table-border table-striped">

    {{--    
        <tr>
            <th>
                Service
            </th>
            <td>
                {{ $data->service }}
            </td>
        </tr> 
        <tr>
            <th>
                Plan
            </th>
            <td>
                {{ $data->plan->description }}( ${{$data->plan->price }}) 
            </td>
        </tr> 
        <tr>
            <th>
                Date
            </th>
            <td>
                {{ $data->order_date }}
            </td>
        </tr> 
        <tr>
            <th>
                Time
            </th>
            <td>
                {{ $data->order_time }}
            </td>
        </tr> 
        <tr>
            <th>
                Drom Name
            </th>
            <td>
                {{ $data->subscription->cart->address }}
            </td>
        </tr>
        <tr>
            <th>
                 Address
            </th>
            <td>
                {{ $data->subscription->cart->address }}
            </td>
        </tr> 

        @if($data->user->in_campus == '1')

            <tr>
                <th>
                    Hall Name
                </th>
                <td>
                    {{ $data->user->hall }}
                </td>
            </tr>

            <tr>
                <th>
                    Room Number
                </th>
                <td>
                    {{ $data->user->room_number }}
                </td>
            </tr> 
            @else
            <tr>
                <th>
                    City
                </th>
                <td>
                    {{ $data->user->city }}
                </td>
            </tr> 
            <tr>
                <th>
                    Zipcode
                </th>
                <td>
                    {{ $data->user->zipcode }}
                </td>
            </tr> 
        @endif
 
        <tr>
            <th>
                Parent Name
            </th>
            <td>
                {{ $data->user->pfirst_name.' '.$data->user->plast_name }}
            </td>
        </tr>

        <tr>
            <th>
                Parent Email
            </th>
            <td>
                {{ $data->user->pemail }}
            </td>
        </tr>

        <tr>
            <th>
                Parent Contact
            </th>
            <td>
                {{ $data->user->pcontact }}
            </td>
        </tr> 
        <tr>
            <th>
                Gratuity
            </th>
            <td>
                {{ $data->gratuity   }}
            </td>
        </tr>

        <tr>
            <th>
                Tax
            </th>
            <td>
                 {{ $data->subscription->tax   }}
            </td>
        </tr>
        <tr>
            <th>
                Service Fee
            </th>
            <td>
                 {{ $data->subscription->service_fee   }}
            </td>
        </tr>

        <tr>
            <th>
                Total Amount
            </th>
            <td>
                {{ $data->subscription->total   }}
            </td>
        </tr>
        --}}
    </table>



@if(!empty($data->addonsDetail))
<table class="table table-border table-striped">
    <h2>Addon Items </h2>
    <tr>
        <th>Sno.</th>
        <th>Iten name </th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
    </tr>
    @php $j=1; @endphp
    @foreach ($data->addonsDetail as $addon)  
        <tr>
            <td>{{$j}}</td>
            <td>{{$addon['addon_name']}}</td>
            <td>${{$addon['price']}}</td>
            <td>{{$addon['quantity']}}</td>
            <td>{{$addon['quantity'] * $addon['price']}}</td>
        </tr>
        @php $j++; @endphp
    @endforeach
    @if($data->addonsDetail)
    <tr></tr>
       <tr>
        <th>Addon Total</th>
           <td colspan="6">{{$data->addonsTotalPrice}}</td>
       </tr>
     @endif 
</table>
@endif

@if(!empty($data->specialRequestAddons))
<table class="table table-border table-striped">
    <h2>Special Requests </h2>
        <tr>
            <th>Sno.</th>
            <th>Item name </th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        @php $j=1; @endphp
        @foreach ($data->specialRequestAddons as $addon_s)  
            <tr>
                <td>{{$j}}</td>
                <td>{{$addon_s['addon_name']}}</td>
                <td>${{$addon_s['price']}}</td>
                <td>{{$addon_s['quantity']}}</td>
                <td>{{$addon_s['quantity'] * $addon_s['price']}}</td>
            </tr>
            @php $j++; @endphp
        @endforeach
        @if($data->specialRequestAddons)
        <tr></tr>
           <tr>
            <th>Special Request Total</th>
               <td colspan="6">{{$data->specialRequestPrice}}</td>
           </tr>
           @endif

        </table> 
    @endif
    <div class="row">
    <div class="col-md-12" >
        <div class="bill_titles1 box" > 
             
            <h5>  Gratuity : <span>{{  $data->gratuity   }} </span></h5>
            <h5>  Tax : <span>{{ $data->subscription->tax }} </span></h5>
            <h5>  Service Fee : <span>{{ $data->subscription->service_fee }}</span> </h5>
        </div>
    </div>
    <div class="col-md-12">
        <div class="bill_titles4">
                        
            <h4> <span>Order Total</span> <span style="background:#f5f8f9; color:#000;"> {{ $data->subscription->total   }}</span> </h4>
        </div>
    </div>
</div>
@endif
@if($data->service == 'Storage')

<hr>
<table class="table table-border table-striped">

    <!-- 
        <tr>
        <th>
            Service
        </th>
        <td>
            {{ $data->service }}
        </td>
        </tr> 
        <tr>
            <th>
                Plan
            </th>
            <td>
                {{ $data->plan->description }}( ${{$data->plan->price }}) 
            </td>
        </tr> 
        <tr>
            <th>
                Large Item
            </th>
            <td>
                @if($data->large_item == '0'){{ 'No' }}@else{{ 'Yes' }}@endif
            </td>
        </tr> 
        <tr>
            <th>
                Dropoff Date
            </th>
            <td>
                {{ $data->subscription->cart->dropoff_date }}
            </td>
        </tr>

        <tr>
            <th>
                Dropoff Time
            </th>
            <td>
                {{ $data->subscription->cart->dropoff_time }}
            </td>
        </tr>

        <tr>
            <th>
                Pickup Date
            </th>
            <td>
                {{ $data->subscription->cart->pickup_date }}
            </td>
        </tr>

        <tr>
            <th>
                Pickup Time
            </th>
            <td>
                {{ $data->subscription->cart->pickup_time }}
            </td>
        </tr>   
    -->
    {{-- 
        <tr>
        <th>
            Insurance:-
        </th>
        <td>
            @if(!empty($data->insurance_price)) ${{$data->insurance_price}} @endif
            @if(!empty($data->plan_type)) {{$data->plan_type}} @endif
        </td>      
        </tr> 
    --}}



    @if($data->user->in_campus == '1')

       <!--  
            <tr>
                <th>
                    Hall Name
                </th>
                <td>
                    {{ $data->user->hall }}
                </td>
            </tr>

            <tr>
                <th>
                    Room Number
                </th>
                <td>
                    {{ $data->user->room_number }}
                </td>
            </tr>
        --> 
        @else

       <!--  
            <tr>
            <th>
                Address
            </th>
            <td>
                {{ $data->user->address }}
            </td>
            </tr>

            <tr>
                <th>
                    City
                </th>
                <td>
                    {{ $data->user->city }}
                </td>
            </tr>

            <tr>
                <th>
                    Zipcode
                </th>
                <td>
                    {{ $data->user->zipcode }}
                </td>
            </tr> 
        --> 
        @endif 
        <!-- 
        <tr>
            <th>
                Parent Name
            </th>
            <td>
                {{ $data->user->pfirst_name.' '.$data->user->plast_name }}
            </td>
        </tr>

        <tr>
            <th>
                Parent Email
            </th>
            <td>
                {{ $data->user->pemail }}
            </td>
        </tr>

        <tr>
            <th>
                Parent Contact
            </th>
            <td>
                {{ $data->user->pcontact }}
            </td>
        </tr> 
        <tr>
        <th>
            Gratuity
        </th>
        <td>
             {{ $data->subscription->grautity   }}
        </td>
        </tr>

        <tr>
            <th>
                Tax
            </th>
            <td>
                 {{ $data->subscription->tax   }}
            </td>
        </tr>
        <tr>
            <th>
                Service Fee
            </th>
            <td>
                 {{ $data->subscription->service_fee   }}
            </td>
        </tr>

        <tr>
            <th>
                Total Amount
            </th>
            <td>
                {{ $data->subscription->total   }}
            </td>
        </tr>
      -->

    @if(!empty($data->addonsDetail))

        <table class="table table-border table-striped">
            <h2>Items in order </h2>
            <tr>
                <th>Sno. <span class="plan_BINS">{{ $data->plan->description }} ( ${{$data->plan->price }})</span></th>
                <!-- <th></th> -->
                <th>Item name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            @php $j=1; @endphp
            @foreach ($data->addonsDetail as $addon) 

                 
                <tr>
                    <td>{{$j}}</td>
                    <!-- <td></td> -->
                    <td>{{$addon['addon_name']}}</td>
                    <td>{{$addon['quantity']}}</td>
                    <td>${{$addon['price']}}</td>
                    <td>{{$addon['quantity'] * $addon['price']}}</td>
                </tr>
                @php $j++; @endphp
            @endforeach
            
            
           <tr>
            <th>Large Items Total</th>
               <td colspan="4" style="text-align: right;">{{$data->addonsTotalPrice}}</td>
           </tr> 
        </table>
        <div class="row">
            <div class="col-md-12" >
                <div class="bill_titles1 box" > 
                     
                    <h5>  Gratuity : <span>{{ $data->subscription->grautity   }} </span></h5>
                    <h5>  Tax :<span> {{ $data->subscription->tax }} </span></h5>
                    <h5>  Service Fee : <span>{{ $data->subscription->service_fee }} </span></h5>
                </div>
            </div>
            <div class="col-md-12">
                <div class="bill_titles4">
                                
                    <h4> <span>Order Total</span> <span style="background:#f5f8f9; color:#000;"> {{ $data->subscription->total   }}</span> </h4>
                </div>
            </div>
        </div>
    @endif 

@endif
<tr>
    <th>
        Assign Order 

    </th>
    <td>
        {{-- <select class="form-control" id="orderstatus" data-id="{{ $data->id }}" style="height: auto; width:30%" >
            <option value="0"  @if($data->order_status == '0'){{ 'selected' }}@endif >New Order</option>
            <option value="1" @if($data->order_status == '1'){{ 'selected' }}@endif >Inprogress</option>
            <option value="2" @if($data->order_status == '2'){{ 'selected' }}@endif >Cancel</option>
            <option value="2" @if($data->order_status == '3'){{ 'selected' }}@endif >Completed</option>
        </select> --}}
        <select class="form-control" id="orderstatus" data-id="{{ $data->id }}" style="height: auto; width:30%" >
            @if(empty($chk_order->staff_id))<option value="" disabled="" selected="">Select Staff Member</option>
            @foreach($staff_members as $staff_member)
            <option value="{{$staff_member->id}}"  @if($staff_member->id == @$chk_order->staff_id){{ 'selected' }}@endif >{{$staff_member->name}}</option>
            @endforeach
            @else
            <option value="" >{{$chk_order->staff->name}}</option>
            @endif

        </select>
    </td>
</tr>

</table>

  </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
          setTimeout(function(){  $(".hideClass").hide('slow'); },4000);
        orderstatus =  $('#orderstatus').val();
        $('#orderstatus').change(function(){
            var order_id = $(this).data('id');
            var staff_id = $(this).val();
           // console.log(id,accept_status);
           if (!confirm("Are you sure want to assign this order?")) {
                $(this).val(orderstatus); //set back
                return;                  //abort!
            } 
            $.ajax({
                type:"get",
                url: "{{route('orders.assignOrder')}}",
                data:{order_id:order_id,staff_id:staff_id},
                success:function(result){
                    // location.reload();
                    location.reload(true);
                    console.log(result)
                }
            })
        })

    });
</script>

@endsection
