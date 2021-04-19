@extends('layouts.web')

@section('content')

<section class="banner">
		<div class="container-fluid">
			<div class="row align-items-center h-100">
				<div class="col-md-12 ">
					<div class="main_img  text-center btm_left ">
						<h2>Class Schedule	</h2>
					</div>
				</div>
			</div><!-- row close-->
		</div> <!-- container close-->
	</section>

	<section class="flate_back1">
		<div class="container">
			<div class="row">
				<div class="col-md-8 offset-md-2">
					<div class="thank_you">
						<h1> Monday</h1>
						<table class="table">
							<thead>
								<tr>
									<th><img src="{{asset('web/images/time1.png')}}" > Time</th>
									<th><img src="{{asset('web/images/time2.png')}}" > Subject</th>
									<th><img src="{{asset('web/images/time3.png')}}" > Room No.</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td> 9.00AM-9.45PM</td>
									<td> English</td>
									<td> 102</td>
								</tr>
								<tr>
									<td> 9.00AM-9.45PM</td>
									<td> Math</td>
									<td> 102</td>
								</tr>
								<tr>
									<td> 9.00AM-9.45PM</td>
									<td> Science</td>
									<td> 102</td>
								</tr>
								<tr>
									<td> 9.00AM-9.45PM</td>
									<td> Biology</td>
									<td> 102</td>
								</tr>
							</tbody>
						</table>

						<h1> Tuesday</h1>
						<table class="table">
							<thead>
								<tr>
									<th><img src="{{asset('web/images/time1.png')}}" > Time</th>
									<th><img src="{{asset('web/images/time2.png')}}" > Subject</th>
									<th><img src="{{asset('web/images/time3.png')}}" > Room No.</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td> 9.00AM-9.45PM</td>
									<td> English</td>
									<td> 102</td>
								</tr>
								<tr>
									<td> 9.00AM-9.45PM</td>
									<td> Math</td>
									<td> 102</td>
								</tr>
								<tr>
									<td> 9.00AM-9.45PM</td>
									<td> Science</td>
									<td> 102</td>
								</tr>
								<tr>
									<td> 9.00AM-9.45PM</td>
									<td> Biology</td>
									<td> 102</td>
								</tr>
							</tbody>
						</table>
						<h1> Wednesday</h1>
						<table class="table">
							<thead>
								<tr>
									<th><img src="{{asset('web/images/time1.png')}}" > Time</th>
									<th><img src="{{asset('web/images/time2.png')}}" > Subject</th>
									<th><img src="{{asset('web/images/time3.png')}}" > Room No.</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td> 9.00AM-9.45PM</td>
									<td> English</td>
									<td> 102</td>
								</tr>
								<tr>
									<td> 9.00AM-9.45PM</td>
									<td> Math</td>
									<td> 102</td>
								</tr>
								<tr>
									<td> 9.00AM-9.45PM</td>
									<td> Science</td>
									<td> 102</td>
								</tr>
								<tr>
									<td> 9.00AM-9.45PM</td>
									<td> Biology</td>
									<td> 102</td>
								</tr>
							</tbody>
						</table>
						<div class="col-md-6 offset-md-3">
							 <a href="" class="yellow_btn"> Update</a>
						</div>
					</div>
				</div>




			</div><!-- row close-->

		</div> <!-- container close-->
	</section>


@endsection
