@extends('layouts.app')
@section('content')

<style>
.card {
    margin-bottom: 30px;
    margin: 5px 10px;
}
</style>


<div class="card-group main_grp">

                    <!-- Column -->
                    <div class="card">
                        <a href="{{route('staff_members.index')}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="m-b-0"><i class="mdi mdi-account-star-variant" aria-hidden="true"></i></h2>
                                    <h3 class="">{{$totalstaff}}</h3>
                                    <h6 class="card-subtitle">Staff Members</h6></div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 26%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                     <div class="card" >
                        <a href="{{route('users.index')}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="m-b-0"><i class="mdi mdi-account"></i></h2>
                                    <h3 class="">{{$totalusers}}</h3>
                                    <h6 class="card-subtitle">Users</h6></div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 26%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

 					 <div class="card" >
					 <a href="{{route('coupons.index')}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="m-b-0"><i class="mdi mdi-ticket-percent" aria-hidden="true"></i></h2>
                                    <h3 class="">{{$totalCoupons}}</h3>
                                    <h6 class="card-subtitle">Total Coupons Used</h6></div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 26%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         </a>
                    </div>

                </div>

                    <h2 style="padding-left: 10px;    margin-top: 10px;"><u>Total Sales</u></h2>

                <div class="card-group main_grp">

                    <!-- Column -->
                    <div class="card">
                        <a href="{{route('transactions.indexDaily')}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="m-b-0"><i class="mdi mdi-cash" aria-hidden="true"></i></h2>
                                    <h3 class="">${{$todayTotalSale}}</h3>
                                    <h6 class="card-subtitle">Today Total Sale</h6></div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 26%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                     <div class="card" >
                        <a href="{{route('transactions.monthly')}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="m-b-0"><i class="mdi mdi-cash"></i></h2>
                                    <h3 class="">${{$monthlyTotalSale}}</h3>
                                    <h6 class="card-subtitle">This Month Total Sale</h6></div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 26%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

 					 <div class="card" >
					 <a href="{{route('transactions.year')}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="m-b-0"><i class="mdi mdi-cash" aria-hidden="true"></i></h2>
                                    <h3 class="">${{$yearlyTotalSale}}</h3>
                                    <h6 class="card-subtitle">This Year Total Sale</h6></div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 26%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         </a>
                    </div>

                </div>

     <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12 col-xlg-12">

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap">
                                    <div>
                                        <h4 class="card-title">Analytics Overview</h4>
                                        <h6 class="card-subtitle">Overview of Monthly analytics</h6>
                                    </div>
                                    <div class="ml-auto align-self-center">
                                        <ul class="list-inline m-b-0" style="display: grid;">
                                            <li>
                                                <h6 class=" text-danger"><i class="fa fa-circle font-10 m-r-10 "></i>User Per Month</h6>
                                            </li>
                                            <li>
                                                <h6 class="" style="color: #85f192!important;"><i class="fa fa-circle font-10 m-r-10 "></i>Laundry Orders Per Month</h6>
                                            </li>
                                             <li>
                                                <h6 class="" style="color: #b7bfff!important;"><i class="fa fa-circle font-10 m-r-10 "></i>Housekeeping Orders Per Month</h6>
                                            </li>
                                            <li>
                                                <h6 class="" style="color: #e6ca7a!important"><i class="fa fa-circle font-10 m-r-10 "></i>Storage Orders Per Month</h6>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <canvas id="myChart" class="campaign ct-charts" style="height:305px!important;"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-xlg-12"  style="display:block">

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap">
                                    <div>
                                        <h4 class="card-title">Weight Chart</h4>
                                        <h6 class="card-subtitle"></h6>
                                    </div>
                                    <div class="ml-auto align-self-center">
                                    </div>
                                </div>
                                <canvas id="myChart32" class="campaign ct-charts" style="height:305px!important;"></canvas>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12 col-xlg-12" id="storage-units">

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap">
                                    <div>
                                        <h4 class="card-title">Storage Graph</h4>
                                        <h6 class="card-subtitle">Currently Hold Items</h6>
                                    </div>
                                    <div class="ml-auto align-self-center">
                                        <ul class="list-inline m-b-0" style="display: inline-block;">
                                            <a class="btn btn-default" style="color: black;" data-id="storage-units">Piece</a>
                                            <a class="btn btn-primary storage-price" style="color: white;" data-id="storage-units">Sales</a>
                                        </ul>
                                    </div>
                                </div>
                                <canvas id="myChart1" class="campaign ct-charts" style="height:305px!important;"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-xlg-12" id="storage-price" style="display:none" >

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap">
                                    <div>
                                        <h4 class="card-title">Storage Graph</h4>
                                        <h6 class="card-subtitle">Currently Hold Items</h6>
                                    </div>
                                    <div class="ml-auto align-self-center">
                                        <ul class="list-inline m-b-0" style="display: grid;">
                                            <ul class="list-inline m-b-0" style="display: inline-block;">
                                            <a class="btn btn-primary storage-units" style="color: white;" data-id="storage-price"  >Piece</a>
                                            <a class="btn btn-default" style="color: back;" data-id="storage-price">Sales (in $)</a>
                                        </ul>
                                        </ul>
                                    </div>
                                </div>
                                <canvas id="myChart4" class="campaign ct-charts" style="height:305px!important;"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-xlg-12" id="dryclean-units">

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap">
                                    <div>
                                        <h4 class="card-title">Dry Cleaning </h4>
                                        <h6 class="card-subtitle">Items Processed</h6>
                                    </div>
                                    <div class="ml-auto align-self-center">
                                        <ul class="list-inline m-b-0" style="display: inline-block;">
                                            <a class="btn btn-default" style="color: black;" data-id="dryclean-units"  >Piece</a>
                                            <a class="btn btn-primary dryclean-price" style="color: white;" data-id="dryclean-units">Sales</a>
                                        </ul>
                                    </div>
                                </div>
                                <canvas id="myChart2" class="campaign ct-charts" style="height:305px!important;"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-xlg-12" id="dryclean-units">

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap">
                                    <div>
                                        <h4 class="card-title">House Keeping Items</h4>
                                        <h6 class="card-subtitle">Items Processed</h6>
                                    </div>
                                    <div class="ml-auto align-self-center">
                                        <ul class="list-inline m-b-0" style="display: inline-block;">
                                            <a class="btn btn-default" style="color: black;" data-id="dryclean-units"  >Piece</a>
                                            {{-- <a class="btn btn-primary dryclean-price" style="color: white;" data-id="dryclean-units">Sales</a> --}}
                                        </ul>
                                    </div>
                                </div>
                                <canvas id="myChart212" class="campaign ct-charts" style="height:305px!important;"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-xlg-12" id="dryclean-price" style="display:none">

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap">
                                    <div>
                                        <h4 class="card-title">Dry Cleaning  </h4>
                                        <h6 class="card-subtitle">Items Processed</h6>
                                    </div>
                                    <div class="ml-auto align-self-center">
                                        <ul class="list-inline m-b-0" style="display: inline-block;">
                                            <a class="btn btn-primary dryclean-units" style="color: white;" data-id="dryclean-price"  >Piece</a>
                                            <a class="btn btn-default" style="color: back;" data-id="dryclean-price">Sales (in $)</a>
                                        </ul>
                                    </div>
                                </div>
                                <canvas id="myChart3" class="campaign ct-charts" style="height:305px!important;"></canvas>
                            </div>
                        </div>
                    </div>


                </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>

            <script>
               var ctx = document.getElementById('myChart');
               var pausecontent = new Array();
                        <?php foreach($usersCountMonthly as $key => $val){ ?>
                            pausecontent.push('<?php echo $val; ?>');
                        <?php } ?>
                var pausecontent1 = new Array();
                        <?php foreach($laundryCountMonthly as $key => $val){ ?>
                            pausecontent1.push('<?php echo $val; ?>');
                        <?php } ?>

                var pausecontent2 = new Array();
                        <?php foreach($housekeepingCountMonthly as $key => $val){ ?>
                            pausecontent2.push('<?php echo $val; ?>');
                        <?php } ?>

                var pausecontent3 = new Array();
                        <?php foreach($storageCountMonthly as $key => $val){ ?>
                            pausecontent3.push('<?php echo $val; ?>');
                        <?php } ?>

                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label:"Users",
                        data: pausecontent,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',

                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 1
                    },
                    {
                        label:"Laundry Orders",
                        data: pausecontent1,
                        backgroundColor: [
                            'rgba(0, 255, 0, 0.3)',
                        ],
                        borderColor: [
                            'rgba(0, 255, 0, 0.3)',
                        ],
                        borderWidth: 1
                    },
                    {
                        label:"Housekeeping Orders",
                        data: pausecontent2,
                        backgroundColor: [
                            'rgba(0, 0, 255, 0.3)',
                        ],
                        borderColor: [
                            'rgba(0, 0, 255, 0.3)',
                        ],
                        borderWidth: 1
                    },
                    {
                        label:"Storage Orders",
                        data: pausecontent3,
                        backgroundColor: [
                            'rgba(255, 206, 86, 0.2)',

                        ],
                        borderColor: [
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
                });


                var ctx = document.getElementById('myChart1');
                var bargraph = new Array();
                        <?php foreach($bargraphdata as $key => $val){ ?>
                            bargraph.push('<?php echo $val; ?>');
                        <?php } ?>

                var storageAddons = new Array();
                            <?php foreach($storageAddons as $key => $addons){ ?>
                            storageAddons.push('<?php echo $addons; ?>');
                        <?php } ?>

                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                    labels: storageAddons,
                    datasets: [
                    {
                        label:"Storage Orders",
                        data: bargraph,
                        backgroundColor: [
                            'rgba(255, 206, 86, 0.2)',

                        ],
                        borderColor: [
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
                });


                var ctx = document.getElementById('myChart2');
                var bargraph1 = new Array();
                        <?php foreach($laundrybargraph as $key => $val){ ?>
                            bargraph1.push('<?php echo $val; ?>');
                        <?php } ?>

                var laundryAddonsNames = new Array();
                            <?php foreach($laundryAddonsNames as $key => $addons){ ?>
                            laundryAddonsNames.push('<?php echo $addons; ?>');
                        <?php } ?>


                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                    labels: laundryAddonsNames,
                    datasets: [
                    {
                        label:"Dryclean Orders",
                        data: bargraph1,
                        backgroundColor: [
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
                });

                 var ctx = document.getElementById('myChart212');
                var bargraph121 = new Array();
                        <?php foreach($housekeepingbargraph as $key => $val){ ?>
                            bargraph121.push('<?php echo $val; ?>');
                        <?php } ?>

                var housekeepingAddonsNames = new Array();
                            <?php foreach($housekeepingAddonsNames as $key => $addons){ ?>
                            housekeepingAddonsNames.push('<?php echo $addons; ?>');
                        <?php } ?>


                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                    labels: housekeepingAddonsNames,
                    datasets: [
                    {
                        label:"Housekeeping Orders",
                        data: bargraph121,
                        backgroundColor: [
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
                });




                var ctx = document.getElementById('myChart3');
                var bargraph2 = new Array();
                        <?php foreach($laundrySalesData as $key => $val){ ?>
                            bargraph2.push('<?php echo $val; ?>');
                        <?php } ?>

                var laundryAddonsNames = new Array();
                            <?php foreach($laundryAddonsNames as $key => $addons){ ?>
                            laundryAddonsNames.push('<?php echo $addons; ?>');
                        <?php } ?>


                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                    labels: laundryAddonsNames,
                    datasets: [
                    {
                        label:"Dryclean Orders",
                        data: bargraph2 ,
                        backgroundColor: [
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
                });


                var ctx = document.getElementById('myChart4');
                var bargraph5 = new Array();
                        <?php foreach($storageSalesData as $key => $val){ ?>
                            bargraph5.push('<?php echo $val; ?>');
                        <?php } ?>

                var storageAddons = new Array();
                            <?php foreach($storageAddons as $key => $addons){ ?>
                            storageAddons.push('<?php echo $addons; ?>');
                        <?php } ?>

                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                    labels: storageAddons,
                    datasets: [
                    {
                        label:"Storage Orders",
                        data: bargraph5,
                        backgroundColor: [
                            'rgba(255, 206, 86, 0.2)',

                        ],
                        borderColor: [
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
                });


                 var weightexpected = new Array();
                            <?php foreach($weightCollected as $key => $addons){ ?>
                            weightexpected.push('<?php echo $addons; ?>');
                        <?php } ?>


                var weightOver = new Array();
                            <?php foreach($weightOver as $key => $addons){ ?>
                            weightOver.push('<?php echo $addons; ?>');
                        <?php } ?>




                var ctx = document.getElementById("myChart32").getContext("2d");

                var data = {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                    datasets: [
                         {
                            label: "Weight Expected",
                            backgroundColor: "blue",
                            data: weightexpected
                        },
                        {
                            label: "Weight Received",
                            backgroundColor: "orange",
                            data: weightOver
                        }
                    ]
                };

                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: {
                        barValueSpacing: 20,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0,
                                }
                            }]
                        }
                    }
                });


            </script>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script>

            $(document).ready(function(){
                    $('.dryclean-price').click(function(){
                        var id = $(this).data('id');

                        console.log($('#'+id).css('display','none'))
                        $('#dryclean-price').css('display','block')
                    })


                    $('.dryclean-units').click(function(){
                        var id = $(this).data('id');
                        console.log($('#'+id).css('display','none'))
                        $('#dryclean-units').css('display','block')
                    })


                    $('.storage-price').click(function(){
                        var id = $(this).data('id');

                        console.log($('#'+id).css('display','none'))
                        $('#storage-price').css('display','block')
                    })


                    $('.storage-units').click(function(){
                        var id = $(this).data('id');
                        console.log($('#'+id).css('display','none'))
                        $('#storage-units').css('display','block')
                    })
                })

            </script>

@endsection
