@extends('layouts.app')
@section('content')

<style>
.card {
    margin-bottom: 30px;
    margin: 5px 10px;
}
</style>


<div class="card-group main_grp">




                </div>

     <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12 col-xlg-12">

                        <div class="card">

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


                </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>

            <script>
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
