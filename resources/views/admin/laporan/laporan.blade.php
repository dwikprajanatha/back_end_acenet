@extends('admin.template.header')

@section('title', $title)

@section('css')
<link href={{ asset("assets/vendor/datatables/dataTables.bootstrap4.min.css") }} rel="stylesheet">
@endsection


@section('body')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$title}}</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Instalasi Baru</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$instalasi_baru}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-plus-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Maintenance Client</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$maintenance_client}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Maintenance BTS</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$maintenance_bts}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wrench fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pencabutan Perangkat</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pencabutan}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cubes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Datatables -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Pekerjaan Selesai</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>No. SPK</th>
                            <th>Jenis Pekerjaan</th>
                            <th>Client</th>
                            <th>ATTN</th>
                            <th>Jenis Client</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list_pekerjaan as $list)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$list->no_spk}}</td>

                            @if($list->jenis_pekerjaan == 1)
                            <td>Instalasi Baru</td>
                            @elseif($list->jenis_pekerjaan == 2)
                            <td>Maintenance Client</td>
                            @elseif($list->jenis_pekerjaan == 3)
                            <td>Maintenance BTS</td>
                            @elseif($list->jenis_pekerjaan == 4)
                            <td>Pencabutan Perangkat</td>
                            @endif

                            <td>{{$list->nama}}</td>
                            <td>{{$list->attn}}</td>
                            <td>{{$list->jenis_layanan}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Diagram SPK selama {{$periode}}</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="testArea"></canvas>
                    </div>
                </div>
            </div>
        </div>



        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Proporsi Kerja Teknisi</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="text-info font-italic">*Warna di-Generate secara otomatis
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <a href="{{route('laporan.export.excel')}}" class="btn btn-success"><i class="fa fa-file-excel" aria-hidden="true"></i>&nbsp;&nbsp;Export Excel</a>
            <a href="{{route('laporan.export.pdf')}}" class="btn btn-success"><i class="fa fa-file-pdf" aria-hidden="true"></i>&nbsp;&nbsp;Export PDF</a>
        </div>
    </div>
    <br>
    <br>



</div>

@endsection


@push('javascript')
<script src={{ asset("assets/vendor/datatables/jquery.dataTables.min.js") }}></script>
<script src={{ asset("assets/vendor/datatables/dataTables.bootstrap4.min.js") }}></script>
<script src={{ asset("assets/js/demo/datatables-demo.js") }}></script>
<script src={{ asset("assets/vendor/chart.js/Chart.min.js") }}></script>



<script>
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    $(document).ready(function() {
        var host = "http://test.lpk-resortkuta.com/"

        var url = $(location).attr('href').split("/");

        if (url[4] == 'tahunan') {
            var apiLineChart = "chart/laporan/tahunan";
            var apiDonutChart = "donut/laporan/tahunan";
        } else if (url[4] == 'bulanan') {
            var apiLineChart = "chart/laporan/bulanan";
            var apiDonutChart = "donut/laporan/bulanan";
        } else if (url[4] == 'mingguan') {
            var apiLineChart = "chart/laporan/mingguan";
            var apiDonutChart = "donut/laporan/mingguan";
        }

        $.ajax({
            url: host + apiLineChart,
            method: "GET",
            success: function(data) {
                var label = [];
                var value = [];

                for (var i in data) {
                    label.push(data[i][0]);
                    value.push(data[i][1]);
                }
                var value = value;
                var ctx = document.getElementById("testArea");
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: label,
                        datasets: [{
                            label: "Jumlah SPK",
                            lineTension: 0.3,
                            backgroundColor: "rgba(78, 115, 223, 0.05)",
                            borderColor: "rgba(78, 115, 223, 1)",
                            pointRadius: 3,
                            pointBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointBorderColor: "rgba(78, 115, 223, 1)",
                            pointHoverRadius: 3,
                            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                            pointHitRadius: 10,
                            pointBorderWidth: 2,
                            data: value,
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                left: 10,
                                right: 25,
                                top: 25,
                                bottom: 0
                            }
                        },
                        scales: {
                            xAxes: [{
                                time: {
                                    unit: 'date'
                                },
                                gridLines: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    maxTicksLimit: 12
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    maxTicksLimit: 5,
                                    padding: 10,
                                    // Include a dollar sign in the ticks
                                    callback: function(value, index, values) {
                                        return number_format(value);
                                    }
                                },
                                gridLines: {
                                    color: "rgb(234, 236, 244)",
                                    zeroLineColor: "rgb(234, 236, 244)",
                                    drawBorder: false,
                                    borderDash: [2],
                                    zeroLineBorderDash: [2]
                                }
                            }],
                        },
                        legend: {
                            display: false
                        },

                    }
                })

            }
        });

        // Pie Chart Example
        $.ajax({
            url: host + apiDonutChart,
            method: "GET",
            success: function(data) {
                var nama = [];
                var value = [];
                var warna_awal = [];
                var warna_select = [];

                for (var i in data) {
                    warna_awal.push(data[i][0]);
                    warna_select.push(data[i][1]);
                    nama.push(data[i][2]);
                    value.push(data[i][3]);
                }

                var ctx = document.getElementById("myPieChart");
                var myPieChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: nama,
                        datasets: [{
                            data: value,
                            backgroundColor: warna_awal,
                            hoverBackgroundColor: warna_select,
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10,
                        },
                        legend: {
                            display: false
                        },
                        cutoutPercentage: 60,
                    },
                });

            }
        })



    });
</script>

@endpush