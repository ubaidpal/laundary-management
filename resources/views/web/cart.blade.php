@extends('layouts.web')

@section('content')

<style>
@media print
{
    .print { display: none; }
    #InvoicePrint { display: block; }
}
</style>


	<section class="banner print" >
		<div class="container">
			<div class="row">
               <div class="col-md-8 ">
                  <div class="table-responsive order_table">
							<table class="table">
								<thead>
								  <tr>
                                    <th>Service </th>
									<th>Total</th>
								  </tr>
								</thead>
								<tbody>

<input type="hidden" name='totalHosuekeeping' value="">

								  {{-- <tr>
									<td>
										<div class="media position-relative order_list">
											  <img src="{{asset('web/images/wash.png')}}" class="mr-4" alt="...">
											  <div class="media-body">
												  <h5 class="">>Laundry Service/ <br> Freshman. </h5>
												  <h4>10 LBS Per Week</h4>

											  </div>
										 </div>
									</td>
									<td><p class="mtop">
									   <span class="mtop_2">
										  <a href="#" class="">-</a>
										  <span class="">1</span>
										  <a href="#" class="">+</a>
									  </span>
								  </p>
								  </td>

									<td>$199.<sup>00</sup> <a data-toggle="modal" data-target="#upgrade" data-dismiss="modal" class="ml-4"> Edit/Remove </a></td>
								  </tr> --}}

								 <tr id="totalTr">
									<td class="text-right order_now" colspan="3">
										<p> <span>Total Price:  </span>  <span class="totalprice"> $ </span>   </p>
										{{-- <a href="{{ route('web.home') }}"  class="shop_in "> Update Cart</a> --}}
									</td>
								</tr>
								</tbody>
							  </table>
						</div>

            </div>
			<div class="col-md-4 ">
                <div class="cart_table">
					<h3>Cart Total</h3>
					<p> <span>Service Fee </span> <em class="servicefee" style="font-style: normal;">$</em> </p>
					<p> <span>Subtotal </span> <em class="totalprice" style="font-style: normal;">$</em> </p>
					<p> <span>Tax </span> <em class="tax" style="font-style: normal;">$</em> </p>
					<p> <span>Gratuity </span> <em class="disocuntGratuityprice"> $0</em> (<em class="disocuntGratuity"> 0% </em>)  </p>

                    <h6> <span>Add Gratuity<b style="color:#e51515">*</b> </span> </h6>
					<ul>
						<li>  <input type="radio" name="gratuity" class="gratuity" value="0" checked > 0%  </li>
						<li>  <input type="radio" name="gratuity" class="gratuity" value="10" > 10%  </li>
						<li>  <input type="radio" name="gratuity" class="gratuity" value="15"> 18%  </li>
						<li>  <input type="radio" name="gratuity" class="gratuity" value="20"> 20%  </li>
						<li>  <input type="radio" name="gratuity" class="gratuity" value="25"> 25%  </li>
						<li>  <input type="radio" name="gratuity" class="gratuity" value="30"> 30%  </li>
					</ul>
					{{-- <ul>
						<li style="width:100%;">  <input type="checkbox" > I will leave gravity in cash </li>
					</ul> --}}
					<p> <span>Total  </span>  <em class="totalPriceWithGratuity" style="font-style: normal;"></em> </p>
					<h1>Default Payment method </h1>

					<div class="py_ment_Card" >
						<div class="media position-relative ">
							  <img src="{{asset('web/images/visa.png')}}" class="mr-4" alt="...">
							  <div class="media-body">
								  <strong class="cardlastdigits"></strong><br>
                                    <span class="cardadded"></span>

							  </div>
						 </div>
					</div>
					<form class="coupne_code" onsubmit="return false">
                        <input type="text" name="coupon_text" placeholder="Coupon Code..">
                        <i class="fa fa-times canceldiscount"   aria-hidden="true"></i>
                        <button onclick="return false" class="coupon"> Apply </button>
                        <input type="hidden" name="discount_amount" value="">
                    </form>

                    <input type="hidden" name="totalamountfordiscount" value="">
                    <input type="hidden" name="service_fee" value="">
                    <input type="hidden" name="tax" value="">
                    <input type="hidden" name="cart_id" value="">
                    <input type="hidden" name="card_token" value="">
                    <input type="hidden" name="total_amount" value="">
                    <input type="hidden" name="gratiuty_amount" value="0">
                    <input type="hidden" name="total" value="">
                    <input type="hidden" name="card_id" value="">
                    <input type="hidden" name="coupon" value="">
                    <input type="hidden" name="coupon_discount" value="">

					<a data-toggle="modal" style="background:#f29f00;" class="payout">Payout</a>
				</div>
            </div>
		</div>


		<div class="row align-items-center h-100 mt-5">
				<div class="col-md-12 ">
					<div class="how_much house_plan ">
						<h2> Our Exclusive Offers</h2>
						<div class="owl-carousel owl-theme" id="banner1">
							<div class="item">
								<ul class="">
									<li>
										<a href="" style="background:#f29f00;">
											<h6> 10 Lbs Per Week</h6>
											<h3>$69.<sup>99</sup>  </h3>
											<p><img src="{{asset('web/images/latu.png')}}"> This cleaning is 90 mintus</p>
											<h4> <img src="{{asset('web/images/img6.png')}}"></h4>
										</a>
									</li>
									<li>
										<a href="" style="background:#70d0ef;">
											<h6> 15 Lbs Per Week</h6>
											<h3>$89.<sup>99</sup>  </h3>
											<p><img src="{{asset('web/images/latu.png')}}"> This cleaning is 2 hours</p>
											<h4> <img src="{{asset('web/images/img6.png')}}"></h4>
										</a>
									</li>
									<li>
										<a href="" style="background:#4c6cb9;" class="over_side">
											<h6> 20 Lbs Per Week</h6>
											<h3>$109.<sup>99</sup>  </h3>
											<p><img src="{{asset('web/images/latu.png')}}"> This cleaning is 2.5-3 hours</p>
											<h4> <img src="{{asset('web/images/img6.png')}}"></h4>
										</a>
									</li>
								</ul>
							</div>
							<div class="item">
								<ul class="">
									<li>
										<a href="" style="background:#f29f00;">
											<h6> 10 Lbs Per Week</h6>
											<h3>$69.<sup>99</sup>  </h3>
											<p><img src="{{asset('web/images/latu.png')}}"> This cleaning is 90 mintus</p>
											<h4> <img src="{{asset('web/images/img6.png')}}"></h4>
										</a>
									</li>
									<li>
										<a href="" style="background:#70d0ef;">
											<h6> 15 Lbs Per Week</h6>
											<h3>$89.<sup>99</sup>  </h3>
											<p><img src="{{asset('web/images/latu.png')}}"> This cleaning is 2 hours</p>
											<h4> <img src="{{asset('web/images/img6.png')}}"></h4>
										</a>
									</li>
									<li>
										<a href="" style="background:#4c6cb9;" class="over_side">
											<h6> 20 Lbs Per Week</h6>
											<h3>$109.<sup>99</sup>  </h3>
											<p><img src="{{asset('web/images/latu.png')}}"> This cleaning is 2.5-3 hours</p>
											<h4> <img src="{{asset('images/img6.png')}}"></h4>
										</a>
									</li>
								</ul>
							</div>

					</div>
					</div>
				</div>
				</div>
        </div> <!-- container close-->


        <div id="upgrade" class="modal fade profile_model" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<button type="button" class="close-1" data-dismiss="modal"> <img src="{{asset('web/images/cross.png')}}" ></button>
        <div class="pro_pop">
		{{-- <h2>Storage </h2> --}}
		{{-- <p>Store large items </p> --}}
		{{-- <div class="row store_pop">
			<div class="col-md-4">
			<div class="qunatity">
				<span class="num"> 01</span>
				<span class="num1"> +</span>
				<span class="num2"> -</span>
			</div>
			</div>
			<div class="col-md-8">
			<div class="monts">
				<select>
					<option>1 Month ($59.99) </option>
				</select>
			</div>
			</div>
		</div> --}}
		{{-- <p>Add more bins  <input type="text"> <a href="" > <img src="images/minus.png"> </a> <a href="" > <img src="images/plus.png"> </a> </p> --}}

        <a href="" onclick="return false" id="edit" class="yellow_btn" > Edit</a>
        <a href="" onclick="return false" id="remove" class="yellow_btn" > Remove</a>

        <input type="hidden" name="service_edit" value="">
        <input type="hidden" name="cart_id_edit" value="">

		</div>
      </div>
    </div>

  </div>
</div>

    <div id="Invoice" class="modal fade profile_model print" role="dialog">

  <div class="modal-dialog" >
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		{{-- <button type="button" class="close-1" data-dismiss="modal"> <img src="images/cross.png" ></button> --}}
        <div class="pro_pop1">

		<h2 id="invoiceforOrderid">Invoice </h2>
		</div>
			 <div class="tabels">
								<table>
								<tbody>
								<tr>
								<td>Bill to</td>
								<td class="transactionDate" style="text-align: right;">Transaction date Aug 30, 2020</td>
								</tr>
								</tbody>
								</table>

								<table>
								<tbody>
								<tr>
								<td style="text-align: left;">{{ $data->first_name.' '.$data->last_name }}</td>
								<td style="font-size: 32px;text-align: right; color:#f29f00">Invoice</td>
								</tr>

								</tbody>
								</table>

								<table>
								<tbody>
								<tr>
								<td class="billingAddress" style="font-size:14px"></td>
								</tr>
								</tbody>
								</table>

								<table class="dat12">
								<thead>
								<tr>
								<th style="text-align: left;">Item </th>
								<th>Discription</th>
								<th style="text-align: right;">price</th>
								</tr>
								</thead>
								<tbody class="tableData">


								 </tbody>
								</table>

                                <div class="py_ment_Card" >
                                    <div class="media position-relative ">
                                            <img style="width: 70px;" src="{{asset('web/images/visa.png')}}" class="mr-4" alt="...">
                                            <div class="media-body">
                                                <strong style="margin: 0px;" class="cardlastdigits"></strong><br>
                                                    <span class="cardadded"></span>

                                            </div>
                                        </div>
                                </div>

                                <strong>Thanks for your payment</strong>
								<div class="dwn"><button onclick="return false">Download</button><span>OR</span><button onclick="return false" id="printIt">Print It</button></div>

         </div>

         <a href="{{ route('web.home') }}"  class="yellow_btn hm33"> HOME </a>

		</div>
      </div>
    </div>
  </div>

	</section>

    <div id="InvoicePrint"  class="modal fade profile_model" role="dialog">

  <div class="modal-dialog" >
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		{{-- <button type="button" class="close-1" data-dismiss="modal"> <img src="images/cross.png" ></button> --}}
        <div class="pro_pop1">

		<h2 id="invoiceforOrderid">Invoice </h2>
		</div>
			 <div class="tabels">
								<table>
								<tbody>
								<tr>
								<td>Bill to</td>
								<td class="transactionDate" style="text-align: right;">Transaction date Aug 30, 2020</td>
								</tr>
								</tbody>
								</table>

								<table>
								<tbody>
								<tr>
								<td style="text-align: left;">{{ $data->first_name.' '.$data->last_name }}</td>
								<td style="font-size: 32px;text-align: right; color:#f29f00">Invoice</td>
								</tr>

								</tbody>
								</table>

								<table>
								<tbody>
								<tr>
								<td class="billingAddress" style="font-size:14px"></td>
								</tr>
								</tbody>
								</table>

								<table class="dat12">
								<thead>
								<tr>
								<th style="text-align: left;">Item </th>
								<th>Discription</th>
								<th style="text-align: right;">price</th>
								</tr>
								</thead>
								<tbody class="tableData">


								 </tbody>
								</table>

								<strong>Thanks for your payment</strong>
								<div class="dwn"><button onclick="return false">Download</button><span>OR</span><button onclick="return false" id="printIt">Print It</button></div>

		 </div>

        <a href="{{ route('web.home') }}"  class="yellow_btn hm33"> HOME </a>
		</div>
      </div>
    </div>
  </div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

    $(document).ready(function(){

        function getCart(){
            $.ajax({
                type:"get",
                url:"{{ url('api/getCart') }}",
                beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
                complete: function(e, xhr, settings){
                    var cart_id = [];

                    console.log(e.responseJSON)

                    var body = e.responseJSON.body
                    if(e.responseJSON.status == 200){
                        var items = body.items
                        console.log(items)
                        if(items.length < 1){
                            alert("Cart is empty")
                            location.replace('{{ route("web.home") }}')
                        }
                        var total = 0;

                        items.forEach(item => {
                            cart_id.push(item.id)

                            if(item.service == 'Laundry'){

                                total = parseFloat(total + parseFloat(item.planDetails.price))

                                if(item.insurance_details){
                                    total = total + (parseFloat(item.insurance_details.priceName));
                                    var insurancePrice = item.insurance_details.priceName
                                    var insuranceName = item.insurance_details.plan_name
                                }else{
                                    var insurancePrice = ''
                                    var insuranceName = ''
                                }

                                total = parseFloat(total).toFixed(2);
                                $('#totalTr').before(`

                                    <tr>
                                        <td style="width: 70%;">
                                            <div class="media position-relative order_list">
                                                <img src="{{asset('web/images/wash.png')}}" class="mr-4" alt="...">
                                                <div class="media-body">
                                                    <h5 class="">`+ item.service +` Service/ <br> Freshman. </h5>
                                                    <h4>`+ item.planDetails.weight +` LBS Per Week</h4>

                                                    `+ ( (insuranceName) ? '<h4> Insurance:- '+ insuranceName +'</h4>' : '' )    +`


                                                </div>
                                            </div>
                                        </td>


                                        <td>$`+ item.planDetails.price +` <a data-service="`+ item.service +`" data-id="`+ item.id +`" data-toggle="modal"  data-dismiss="modal" class="ml-4 edit_remove"> Edit/Remove </a>  `+ ( (insuranceName) ? '$'+ insurancePrice  : '' ) +` </td>
                                    </tr>

                                `)

                            }

                            if(item.service == 'Housekeeping'){
                                console.log(item)
                                var addonsItems = [];
                                var totalAddonPrice = 0;
                                item.addonsItems.forEach(function(addonsItem){
                                    addonsItems.push(addonsItem.name)
                                    totalAddonPrice = totalAddonPrice + parseFloat(addonsItem.price)
                                })

                                if(item.frequency == '1'){
                                    var totalHosuekeeping = parseFloat( totalAddonPrice + parseFloat(item.planDetails.price))

                                }

                                if(item.frequency == '2'){
                                    var totalHosuekeeping = parseFloat( totalAddonPrice + ( parseFloat(item.planDetails.price) * 2  ))

                                }

                                if(item.frequency == '3'){
                                    var totalHosuekeeping = parseFloat( totalAddonPrice + ( parseFloat(item.planDetails.price) * 4  ) )

                                }



                                total = parseFloat(total) + totalHosuekeeping;
                                // console.log(totalHosuekeeping)

                                $('input[name="totalHosuekeeping"]').val(totalHosuekeeping);

                                $('#totalTr').before(`

                                    <tr>
                                        <td style="width: 70%;">
                                            <div class="media position-relative order_list">
                                                <img src="{{asset('web/images/wash.png')}}" class="mr-4" alt="...">
                                                <div class="media-body">
                                                    <h5 class="">`+ item.service +` Service/ <br> Freshman. </h5>
                                                    <h4>`+ item.planDetails.description +` </h4><br>

                                                </div>
                                            </div>
                                        </td>


                                        <td>$`+ totalHosuekeeping +` <a data-service="`+ item.service +`" data-id="`+ item.id +`" data-toggle="modal"  data-dismiss="modal" class="ml-4 edit_remove"> Edit/Remove </a></td>
                                    </tr>

                                `)

                            }

                            if(item.service == 'Storage'){

                                var addonsItems = [];
                                var totalAddonPrice = 0;
                                item.addonsItems.forEach(function(addonsItem){
                                    addonsItems.push(addonsItem.name)
                                    totalAddonPrice = totalAddonPrice + parseFloat(addonsItem.price)
                                })

                                var totalStorage = parseFloat( totalAddonPrice + parseFloat(item.planDetails.price))

                                total = parseFloat(total) + totalStorage;

                                $('#totalTr').before(`

                                    <tr>
                                        <td  style="width: 70%;"   >
                                            <div class="media position-relative order_list">
                                                <img src="{{asset('web/images/wash.png')}}" class="mr-4" alt="...">
                                                <div class="media-body">
                                                    <h5 class="">`+ item.service +` Service/ <br> Freshman. </h5>
                                                    <h4>`+ item.planDetails.description +` </h4>

                                                </div>
                                            </div>
                                        </td>


                                        <td>$`+ totalStorage +` <a data-service="`+ item.service +`" data-id="`+ item.id +`" data-toggle="modal"  data-dismiss="modal" class="ml-4 edit_remove"> Edit/Remove </a></td>
                                    </tr>

                                `)

                            }

                        });

                        cart_id = cart_id.join(',')


                        total = parseFloat(total).toFixed(2)

                        $('.servicefee').html('$'+ body.taxes.service_fees)
                        $('.totalprice').html('$' + total)
                        $('input[name="totalamountfordiscount"]').val(total)
                        total = parseFloat(total) + parseFloat(body.taxes.service_fees) + parseFloat(body.taxes.tax_fees)
                        $('.tax').html('$' + body.taxes.tax_fees)
                        $('.totalPriceWithGratuity').html('$' + total)
                        $('input[name="service_fee"]').val(body.taxes.service_fees)
                        $('input[name="tax"]').val(body.taxes.tax_fees)
                        $('input[name="cart_id"]').val(cart_id)
                        $('input[name="cart_id"]').val(cart_id)
                        $('input[name="total_amount"]').val(total)
                        $('input[name="total"]').val(total)

                    }else{
                        alert('Something went wrong');
                        location.replace("{{ route('web.home') }}")
                    }

                    $.ajax({
                        type:"get",
                        url: "{{ url('demoCardToken') }}",
                        success: function(result){
                            $('input[name="card_token"]').val(result)
                        }
                    })

                }
            })

        }
        getCart();

        function card(){
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
                        $('input[name="card_id"]').val(body.id)
                    }
                }
            });
        }

        card();

		$('.gratuity').click(function(){
            var gratuity = parseInt($('.gratuity:checked').val());
            $('.disocuntGratuity').html(gratuity + '%');
            var total = $('input[name="totalamountfordiscount"]').val();
            total = parseFloat(total);

            gratuity = total *  (gratuity / 100)
            $('.disocuntGratuityprice').html('$' + gratuity.toFixed(2))
            // console.log(gratuity);
            // console.log(total);

            total = parseFloat($('input[name="total_amount"]').val());

            total = (parseFloat((gratuity.toFixed(2))) + total).toFixed(2);

            // total = total.toFixed(2)

            var coupon_discount = $('input[name="coupon_discount"]').val();

            if(coupon_discount){
                // alert('asdsa')
                $('.coupon').trigger('click')
            }

            $('input[name="gratiuty_amount"]').val(gratuity.toFixed(2))
            $('.totalPriceWithGratuity').html('$'+total)
            $('input[name="total"]').val(total)

        })

        $('.coupon').click(function(){
            var coupon = $('input[name="coupon_text"]').val()
            if(coupon == ''){
                alert('Please enter coupon')
                return false;
            }

            $.ajax({
                type:"post",
                url: "{{ url('api/applyPromocode') }}",
                data:{code:coupon},
                beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
                complete: function(e, xhr, settings){

                        if(e.responseJSON.status == 200){

                            if(e.responseJSON.body.status != '1'){
                                alert('Invalid coupon!');
                                return false;
                            }

                            $('.coupon').css({
                                "pointer-events": "none"
                            });

                            // $('.coupon').attr('onclick','return alert("Coupon already Applied")')

                            var discount = e.responseJSON.body.discount

                            var total = parseFloat($('input[name="totalamountfordiscount"]').val());
                            discount = total * (discount / 100)


                            $('input[name="discount_amount"]').val(discount)

                            total = parseFloat($('input[name="total"]').val());
                            console.log(total)

                            total = total - discount.toFixed(2)

                            $('.totalPriceWithGratuity').html('$'+total.toFixed(2))


                            $('input[name="total"]').val(total.toFixed(2))
                            $('input[name="coupon_discount"]').val(total.toFixed(2))
                            $('input[name="coupon"]').val(coupon)

                        }else{
                            alert(e.responseJSON.message)
                            $('input[name="discount_amount"]').val(0)
                            $('input[name="coupon_discount"]').val();
                            $('input[name="coupon"]').val('')
                        }
                }
            })

        })

        $('.canceldiscount').click(function(){
            var discount = $('input[name="discount_amount"]').val();
            if(discount == ''){
                discount = 0
            }

            var total = $('input[name="total"]').val()

            total = parseFloat(total) + parseFloat(discount)
            total = parseFloat(total).toFixed(2)

            $('.totalPriceWithGratuity').html('$'+total)


            $('input[name="total"]').val(total)

            $('input[name="coupon_discount"]').val();
            $('input[name="coupon"]').val('')

            $('.coupon').css({
                        "pointer-events": ""
                    });

            $('input[name="discount_amount"]').val(0)
            $('input[name="coupon_text"]').val('')

            $('.coupon').removeAttr('onclick')

        })

        $('body').on('click','.edit_remove', function(){
            var cart_id = $(this).data('id')
            var service = $(this).data('service')
            $('input[name="cart_id_edit"]').val(cart_id)
            $('input[name="service_edit"]').val(service)

            $('#upgrade').modal({
                        backdrop: 'static',
                        keyboard: false
                    });

            $('#upgrade').modal('show');

        })

    })


</script>


@endsection
