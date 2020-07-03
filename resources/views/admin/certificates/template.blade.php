@extends('admin.layout.layout')
@section('content')
    <div class="container-fluid content">
        <div class="row">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box mt-5">
                                        <div class="box-header text-center mb-1">
                                            <div class="logo text-center">
                                                <img style="width:100px;height: 100px;" src="{{asset(\App\Setting::MainSettings()->logo)}}" alt="asdasd">
                                            </div>
                                            <div>
                                                www.eitd-oman.com
                                            </div>
                                        </div><!-- /.box-header -->
                                        <div class="box-body" id="result">
                                            <h1 class="box-title text-center">English Level Certificate</h1>
                                            <div class="row text-center mb-5">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-12 text-center">
                                                            <h4 class="mb-3">
                                                                Name: {{$test['student_name']}}
                                                            </h4>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h4 class="mb-3">
                                                                ID: {{$test['student_id']}}
                                                            </h4>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span>{{$test['created_at']}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive" style="margin: 0 auto; width: 450px;">
                                                <table class="table table-hover">

                                                    <tr>
                                                        <td>Listening</td>
                                                        <td>{{$test['listening']}}%</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Reading</td>
                                                        <td>{{$test['reading']}}%</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Language System</td>
                                                        <td>{{$test['ls']}}%</td>
                                                    </tr>
                                                    <tr style="line-height:  50px;border-top: 1px solid;font-size: larger;font-weight: bold">
                                                        <td>Overall</td>
                                                        <td>{{$test['listening'] +$test['reading'] + $test['ls'] }}%</td>
                                                    </tr>
                                                </table>
                                                <div style="margin-top: 2px;background-color: #3579b4;width: 100%;text-align: center;margin-bottom: 30px;">
                                                    <h2 id="level" style="-webkit-print-color-adjust: exact;color:white;background-color:#007bff; width: 100%">Level {{$test['level']}}</h2>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <canvas id="barChart" style="min-height: 250px; height: 300px; max-height: 300px; max-width: 400px;"></canvas>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <div style="margin-top: 50px;" class="d-flex justify-content-center align-items-center">
                                            <table class="table table-hover text-center" style="width: 80%" id="levels">
                                                <tr class="bg-primary">
                                                    <th>Level</th>
                                                    <th>One</th>
                                                    <th>Two</th>
                                                    <th>Three</th>
                                                    <th>Four</th>
                                                    <th>Five</th>
                                                    <th>Advanced</th>
                                                </tr>
                                                <tr id="tableleveldown">
                                                    <td>Scale</td>
                                                    <td>0-40 %</td>
                                                    <td>41-60 %</td>
                                                    <td>61-70 %</td>
                                                    <td>71-80 %</td>
                                                    <td>81-90 %</td>
                                                    <td>91-100 %</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>

                        <div class="row mt-auto">
                            <div class="col-12">
                                <div>
                                    {!! \App\Setting::MainSettings()->footer !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('javascript')
    <!-- ChartJS -->
    <script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>
    <script>
        var dataset = {
            labels: ['Listening', 'Reading', 'Language System'],
            datasets: [
                {
                    label: 'Student Result',
                    backgroundColor: 'blue',
                    data: [{{$test['listening']}}, {{$test['reading']}}, {{$test['ls']}}]
                },
                {
                    label: 'Full Mark',
                    backgroundColor: 'red',
                    data: [10, 18, 72]
                }
            ]
        };
        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = jQuery.extend(true, {}, dataset)
        var temp0 = dataset.datasets[0]
        var temp1 = dataset.datasets[1]
        barChartData.datasets[0] = temp1
        barChartData.datasets[1] = temp0

        var barChartOptions = {
            barThickness: 10,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    gridLines: {
                        display: true
                    }
                }],
                xAxes: [{
                    barPercentage: 1,
                    categoryPercentage: 0.6,
                    ticks: {
                        beginAtZero: true
                    },
                    gridLines: {
                        display: false
                    }
                }]
            },
            tooltips: {
                enabled: true,
                mode: 'single',

            },
            responsive: true,
            maintainAspectRatio: false,
        };

        var barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        })
        window.print();
    </script>
@endsection