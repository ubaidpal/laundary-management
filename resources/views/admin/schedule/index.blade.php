@extends('layouts.app')

@section('content')

<style>
    .fc-basic-view .fc-day-number {
    padding: 10px 15px;
    display: table-cell !important;
}
</style>

<div class="container-fuild">
    <div class="card">
    <div class="card-body">

        <div id='calendar'></div>


</div>
    </div>
</div>


<style>
  .w35{
    width: 35%;
  }
  .message{
    width: 50%;
    margin: 20px;
    margin-left: 0px;
  }

</style>

<div class="container-fuild" style="display:none" id="orderdata">
  <div class="card">
    <div class="card-body">

  <div class="clearfix"></div>
  <div class="pull-right">

  </div>
  <br>

  <table class="table" id="myTable">
    <thead>
      <tr>
        <th>Name</th>
        <th>Service</th>
        <th>Service Address</th>
        <th>Cleaning Schedule</th>
        <th>Addon Service</th>
        <th>Notes</th>
        <th>Assignment</th>
      </tr>
    </thead>
    <tbody id="table_data">

    </tbody>
  </table>
  {{-- <span class="mr-15 mt-10 pull-right">{{ $data->links() }}</span> --}}

</div>
  </div>
</div>


<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
{{-- <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script>
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery.min.js'></script> --}}
{{-- <script src="http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery-ui.custom.min.js"></script> --}}
{{--<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script>
<link rel='stylesheet' href='https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.css' /> --}}



<script src='{{asset('calender/moment.min.js')}}'></script>
<script src='{{asset('calender/jquery.min.js')}}'></script>
<script src="{{asset('calender/jquery-ui.custom.min.js')}}"></script>
<script src='{{asset('calender/fullcalendar.min.js')}}'></script>


<link rel='stylesheet' href='{{asset('calender/fullcalendar.min.css')}}' />

{{-- {{ dd($data) }} --}}
<script>


$(document).ready(function() {

    var array = [];

    <?php  foreach($data as $detials) {  
    //dd($detials->service);
    ?>
    dt = new Date();
    var curr_day = dt.getDate();
    var curr_month = dt.getMonth();
    var curr_year = dt.getFullYear();
    //alert(curr_year+'-'+curr_day+'-'+curr_month);
    array.push({
        title:"{{ $detials->service }}",
        start:"{{$detials->order_date}}",
        orderid:"{{$detials->id}}",
        color: '@if($detials->service == "Laundry"){{"purple"}}@endif @if($detials->service == "Housekeeping"){{"green"}}@endif @if($detials->service == "Laundry" ){{"red"}}@endif',
        url: "<?php if (\Auth::user()->type == "ADMIN") { echo route('orders.view', $detials->id); }else{ echo route('staff.orders.view', $detials->id); } ?>",
    });

    <?php } ?>

        $('#calendar').fullCalendar({
            left:   'Calendar',
             center: 'prevYear,prev,title, next,nextYear',
            right:  'today prev,next',
            //defaultDate: curr_year+'-'+curr_day+'-'+curr_month,
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            //gotoDate : curr_year+'-'+curr_day+'-'+curr_month,
            events: array, 
            dayClick: function(date, jsEvent, view, resourceObj) {
              var  date = new Date(date);
              var  mnth = ("0" + (date.getMonth() + 1)).slice(-2);
              var  day = ("0" + date.getDate()).slice(-2);
              date = [date.getFullYear(), mnth, day].join("-"); 

              //var redirect = 'today-view-orders/'+date;
              <?php 
                if(\Auth::user()->type == 'ADMIN'){ ?>
                   var url = "{{ url('admin/today-view-orderlist') }}";
                  var redirect =  "{{ url('admin/schedule/today-view-orders') }}/"+date;

                <?php }else{ ?>
                 var url = "{{ url('staff/schedule/today-view-orderlist') }}";
                  var redirect =  "{{ url('staff/schedule/today-view-orders') }}/"+date;
               <?php }
              ?>

              $.ajax({

                  url: redirect,
                  type: 'get',
                  data:{date:date},
                  success: function(result){ 
                    window.location.href = redirect;
                  }, 
              });

            }
        });

        const monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
        ];
         

        const d = new Date();
        //console.log(monthNames[d.getMonth()]);
       // $(".fc-left h2").text(monthNames[d.getMonth()] +" "+ d.getFullYear() );
         
}); 
</script>

@endsection
