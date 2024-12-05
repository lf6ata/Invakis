@extends('index')

@section('title','Dashboard')
@section('content')
<style>
        #wrapper-chart {
        position: relative;
        background: #000524;
        border: 1px solid #000;
        box-shadow: 0 22px 35px -16px rgba(0, 0, 0, 0.71);
        margin: 0 auto;
        }

        #chart-bar {
        position: relative;
        margin-top: -38px;
        }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">
    @if(session('message'))
    <script>
        setTimeout(function() {
            Swal.fire('Membuat Session!', '{{ session("message") }}', 'error');
        }, 1000); // Jeda 1,5 detik (1500 ms)
    </script>
    {{-- <div class="alert alert-warning">
        {{ session('message') }}
    </div> --}}
    @endif

    <!-- Content Row -->
    <div class="row">

        <!-- Total Barang Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_barang }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Barang Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Barang Rusak</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_rusak }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Total User Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                               Total User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_user }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End Row -->

    <!-- DataTales Session STO -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex align-items-center">
                <div class="p-2 flex-grow-1">
                    <h6 class="m-0 font-weight-bold text-primary ">Session STO</h6>
                </div>
                <div class="p-2">
                    <form action="{{ route('create_session_sto') }}">
                        <button id="createSto" type="submit" class="btn btn-primary" data-toggle="modal" data-target="#addRole">
                            <i class="fas fa-plus fa-sm"></i> Buat STO
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width=5%>No</th>
                            <th>Session</th> 
                            <th>Progress</th>
                            <th>Durasi</th>
                            <th>Date Start</th>
                            <th>Date End</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach($session_sto as $no=>$s)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td>{{ $s->session_sto }}</td>
                                <td class="{{ $s->progress > 50 ? 'text-primary' : 'text-danger' }}">{{ $s->progress }}%</td>
                                <td class="{{ $s->durasi != '00:00:00' ? 'text-dark' : 'text-danger' }}">{{ $s->durasi }}</td>
                                <td>{{ $s->tgl_sto }}</td>
                                @if ($s->save_sto == '' || $s->save_sto == NULL)
                                    <td>-</td>
                                @else
                                    <td>{{ $s->save_sto }}</td>
                                @endif
                                
                                @if ($s->save_sto == '' || $s->save_sto == NULL )
                                    <td align="center">
                                        <a href={{ url('/invakis/sto/'.$s->session_sto.'/false') }}  class="btn btn-sm btn-primary">Lanjutkan</a>
                                    </td>
                                @else
                                    <td align="center">
                                        <a href={{ url('/invakis/sto/'.$s->session_sto.'/true') }}  class="btn btn-sm btn-warning">View</a>
                                    </td>
                                @endif
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Grafik Line -->
    <div id="wrapper-chart">
        <div id="chart-area">
      
        </div>
        <div id="chart-bar">
      
        </div>
    </div>

</div>
<!-- End Page Content -->

<script src={{ asset("plugin/js/apexcharts.min.js") }}></script>
<script>
    
    var data = generateDayWiseTimeSeries(new Date("22 Apr 2017").getTime(), 115, {
    min: 30,
    max: 90
    });
    var options1 = {
    chart: {
        id: "chart2",
        type: "area",
        height: 230,
        foreColor: "#ccc",
        toolbar: {
        autoSelected: "pan",
        show: false
        }
    },
    colors: ["#00BAEC"],
    stroke: {
        width: 3
    },
    grid: {
        borderColor: "#555",
        clipMarkers: false,
        yaxis: {
        lines: {
            show: false
        }
        }
    },
    dataLabels: {
        enabled: false
    },
    fill: {
        gradient: {
        enabled: true,
        opacityFrom: 0.55,
        opacityTo: 0
        }
    },
    markers: {
        size: 5,
        colors: ["#000524"],
        strokeColor: "#00BAEC",
        strokeWidth: 3
    },
    series: [
        {
        name: 'Sangat Layak',
        data: data
        }
    ],
    tooltip: {
        theme: "dark"
    },
    xaxis: {
        type: "datetime"
    },
    yaxis: {
        min: 0,
        tickAmount: 4
    }
    };
    var chart1 = new ApexCharts(document.querySelector("#chart-area"), options1);
    chart1.render();

    var options2 = {
    chart: {
        id: "chart1",
        height: 130,
        type: "bar",
        foreColor: "#ccc",
        brush: {
        target: "chart2",
        enabled: true
        },
        selection: {
        enabled: true,
        fill: {
            color: "#fff",
            opacity: 0.4
        },
        xaxis: {
            min: new Date("27 Jul 2017 10:00:00").getTime(),
            max: new Date("14 Aug 2017 10:00:00").getTime()
        }
        }
    },
    colors: ["#FF0080"],
    series: [
        {
        data: data
        }
    ],
    stroke: {
        width: 2
    },
    grid: {
        borderColor: "#444"
    },
    markers: {
        size: 0
    },
    xaxis: {
        type: "datetime",
        tooltip: {
        enabled: false
        }
    },
    yaxis: {
        tickAmount: 2
    }
    };
    var chart2 = new ApexCharts(document.querySelector("#chart-bar"), options2);
    chart2.render();

    function generateDayWiseTimeSeries(baseval, count, yrange) {
    var i = 0;
    var series = [];
    while (i < count) {
        var x = baseval;
        var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

        series.push([x, y]);
        baseval += 86400000;
        i++;
    }
    return series;
    }
</script>

{{-- <script>
    let nameItems = {
        'sangat': {{ $count_sangat }},
        'cukup' : {{ $count_cukup }},
        'layak' : {{ $count_layak }} ,
        'rusak' : {{ $count_rusak }},
    };
</script>

<!-- Page level plugins -->
<script src="{{ asset('') }}template/vendor/chart.js/Chart.min.js"></script>
<!-- Page level custom scripts -->
<script src="{{ asset('') }}template/js/demo/chart-bar-demo.js"></script> --}}

@endsection
