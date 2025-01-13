@extends('index')

@section('title','Dashboard')
@section('content')
<style>
        #wrapper-chart{
        position: relative;
        background: #ffffff;
        border: 1px solid #f8ebeb;
        box-shadow: 0 22px 35px -16px rgba(0, 0, 0, 0.31);
        margin: 0 auto;
        }

        #chart-bar {
        position: relative;
        margin-top: -38px;
        }

         /* SMPINNER LOAD ALL PAGE */
         #loading-spinner2 {
            position: relative;
            top: 0;
            left: 0;
            width: 100%;
            height: 365px;
            background: #ffffff;
            z-index: 9999;
            /* Pastikan spinner berada di atas elemen lain */
            display: none;
            align-items: center;
            justify-content: center;
        }

        .spinner2 {
            border: 8px solid #f3f3f3;
            /* Light gray */
            border-top: 8px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }


</style>

<!-- Begin Page Content -->
{{-- <div class="container-fluid"> --}}
    @if(session('message'))
    <script>
        setTimeout(function() {
            Swal.fire({
                title: 'Error',
                text: '{{ session("message") }}',
                icon: 'error',
                confirmButtonColor: '#4e73df',
            });
        }, 1000); // Jeda 1,5 detik (1500 ms)
    </script>
    {{-- <div class="alert alert-warning">
        {{ session('message') }}
    </div> --}}
    @endif

    {{ $count_status }}

    <!-- Content Row -->
    <div class="row">

        {{-- <!-- Progress Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Progress</div>
                                <h7 class="left">Progress : <span id="persen"></span></h7><br>
                                <progress id="progressBar" value="0" max="100"></progress>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-check2-circle fa-2x text-gray-600"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <script>
            function getProgress() {
                $.ajax({
                    url: "{{ route('get.progress') }}",
                    method: "GET",
                    success: function(data) {
                        const percentage = data.percentage;
                        $('#persen').text(percentage + '%');
                        $('#progressBar').val(percentage);
    
                        // Set timeout to update progress every 10 seconds
                        setTimeout(getProgress, 10000);
                        console.log('hello');
                    }
                });
            }
    
            // Start the real-time progress update when the page is loaded
            $(document).ready(function() {
                getProgress();
            });
        </script> --}}

        <!-- Total Barang Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah Session STO</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_session }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-calendar3 fa-2x text-gray-600"></i>
                        </div>
                    </div>
                    {{-- <div class="mt-1">
                        <h7 class="left">Progress : <span id="persen"></span></h7><br>
                        <progress id="progressBar" value="0" max="100"></progress>
                    </div> --}}
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
                                Total Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_barang }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-boxes fa-2x text-gray-600"></i>
                        </div>
                    </div>
                    {{-- <div class="mt-1">
                        <h7 class="left">Progress : <span id="persen"></span></h7><br>
                        <progress id="progressBar" value="0" max="100"></progress>
                    </div> --}}
                </div>
            </div>
        </div>
        

        {{-- <!-- Total Barang Card Example -->
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
        </div> --}}

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
                            <i class="bi bi-people-fill fa-2x text-gray-600"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Sangat Layak Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                              Sangat Layak</div>
                            {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_status[2]->total_count }}</div> --}}
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-check-circle-fill fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Cukup Layak Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                               Cukup Layak</div>
                            {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_status[0]->total_count }}</div> --}}
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-check-circle fa-2x text-success"></i>
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
                               Layak Pakai</div>
                            {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_status[2]->total_count }}</div> --}}
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-exclamation-circle fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Total User Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Rusak</div>
                            {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_status[1]->total_count }}</div> --}}
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-x-circle fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Total User Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                               Hilang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_user }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-question-circle fa-2x text-info"></i>
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
                            <th align="center">Action</th>
                            
                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach($session_sto as $no=>$s)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td>{{ $s->session_sto }}</td>
                                <td class="{{ $s->progress > 50 ? 'text-primary' : 'text-danger' }}">{{ $s->progress == 100 ? 'complate' : $s->progress.'%'}}</td>
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
                                        <a href={{ url('/invakis/sto/'.$s->session_sto.'/true') }}  class="btn btn-sm btn-primary">Detail</a>
                                        <a href={{ url('/invakis/sto/'.$s->session_sto.'/true') }}  class="btn btn-sm btn-success">Export Excel</a>
                                        <a href={{ url('/invakis/sto/'.$s->session_sto.'/true') }}  class="btn btn-sm btn-info">Export BA</a>
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
        <div id="loading-spinner2" >
                <div class="spinner2"></div>
        </div>
        <div id="chart-area"></div>
        {{-- <div id="chart-bar">
      
        </div> --}}
    </div>

{{-- </div> --}}
<!-- End Page Content -->

<script src={{ asset("plugin/js/apexcharts.min.js") }}></script>
<script>

var chart;
function updateChart(){

    if (chart) { hart.destroy();}

    document.getElementById('loading-spinner2').style.display = 'flex';
        
        $.get('/chart-data', function(data) {
            const months = data.months;
            const currentYear = data.currentYear
            const statusCounts = data.statusCounts
            // console.log(statusCounts['Sangat Layak']);
            
        // Jika chart sudah ada, destroy sebelum membuat yang baru
            // if (chart) {
            //     chart.destroy();
            //     console.log('tes');
                
            // }

        var options = {
                series: [{
                name: 'Sangat Layak',
                data: statusCounts['Sangat Layak']
                // data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                }, {
                name: 'Cukup Layak',
                data: statusCounts['Cukup Layak']
                // data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                }, {
                name: 'Layak Pakai',
                data: statusCounts['Layak Pakai']
                // data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
                }, {
                name: 'Rusak',
                data: statusCounts['Rusak']
                // data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
                }],
                chart: {
                type: 'bar',
                height: 350,
                },
                plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    borderRadius: 3,
                    borderRadiusApplication: 'end'
                },
                },
                dataLabels: {
                enabled: false
                },
                stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
                },
                xaxis: {
                categories: months,
                title: {
                    text: 'Tahun '+currentYear
                }
                },
                yaxis: {
                title: {
                    text: 'Jumlah STO ' + currentYear
                }
                },
                fill: {
                opacity: 1
                },
                tooltip: {
                y: {
                    formatter: function (val) {
                    return val + " sto"
                    }
                }
                }
                };

                chart = new ApexCharts(document.querySelector("#chart-area"), options);
                chart.render();
                document.getElementById('chart-area').style.display = 'none';
        })

        setTimeout(function() {
        document.getElementById('chart-area').style.display = 'flex';
        document.getElementById('loading-spinner2').style.display = 'none';
    }, 1800); // Jeda 1,5 detik (1500 ms)
    
}  

//  Update grafik setiap 5 detik
 setInterval(updateChart, 115000); // Update setiap 5000 ms (5 detik)
 updateChart();

    // function generateDayWiseTimeSeries(baseval, count, yrange) {
    // var i = 0;
    // var series = [];
    // while (i < count) {
    //     var x = baseval;
    //     var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

    //     series.push([x, y]);
    //     baseval += 86400000;
    //     i++;
    // }
    // return series;
    // }
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
