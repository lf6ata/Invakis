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

    {{-- {{ $count_status }} --}}

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
        <div class="col-xl-4 col-md-6 mb-4">
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
        <div class="col-xl-4 col-md-6 mb-4">
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
        <div class="col-xl-4 col-md-6 mb-4">
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
    </div>
    <!-- End Row -->
    
    <div class="card shadow mb-4">
            <div class="card-header ">
                <h6 class="m-0 font-weight-bold text-primary ">Status sto saat ini</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <!--Sangat Layak Card Example -->
                    <div class="col-xl-2 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Sangat Layak</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_sangat_layak ?? 0}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-check-circle-fill fa-2x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!--Cukup Layak Card Example -->
                    <div class="col-xl-2 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Cukup Layak</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_cukup_layak  ?? 0}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-check-circle fa-2x text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!--Total User Card Example -->
                    <div class="col-xl-2 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Layak Pakai</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_layak_pakai ?? 0 }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-exclamation-circle fa-2x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!--Total User Card Example -->
                    <div class="col-xl-2 col-md-6 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                            Rusak</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_rusak ?? 0 }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-x-circle fa-2x text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!--Total User Card Example -->
                    <div class="col-xl-2 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Hilang</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_hilang ?? 0 }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-question-circle fa-2x text-info"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
    </div>

     <!-- Grafik Line -->
     <div id="wrapper-chart">
        {{-- <div id="loading-spinner2" >
                <div class="spinner2"></div>
        </div> --}}
        <div id="chart-area"></div>
        
    </div>

    <!-- DataTales Session STO -->
    <div class="card shadow mt-4">
        <div class="card-header py-3">
            <div class="d-flex align-items-center">
                <div class="p-2 flex-grow-1">
                    <h6 class="m-0 font-weight-bold text-primary ">Session STO</h6>
                </div>
                @if (Auth::user()->getRoleNames()->implode(', ') == 'admin')
                    <div class="p-2">
                        <form action="{{ route('create_session_sto') }}">
                            <button id="createSto" type="submit" class="btn btn-primary" data-toggle="modal" data-target="#addRole">
                                <i class="fas fa-plus fa-sm"></i> Buat STO
                            </button>
                        </form>
                    </div>
                @endif
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
                                <td align="center" class="{{ $s->progress > 50 ? 'text-primary' : 'text-danger' }}">{{ $s->progress == 100 ? 'Complete' : $s->progress.'%'}}</td>
                                <td class="{{ $s->durasi != '00:00:00' ? 'text-dark' : 'text-danger' }}">{{ $s->durasi }}</td>
                                <td>{{ $s->tgl_sto }}</td>
                                @if ($s->save_sto == '' || $s->save_sto == NULL)
                                    <td>-</td>
                                @else
                                    <td>{{ $s->save_sto }}</td>
                                @endif
                                
                                @if ($s->save_sto == '' || $s->save_sto == NULL )
                                    <td align="center">
                                        <a href={{ url('/invakis/sto/'.$s->session_sto.'/false') }}  class="btn btn-sm btn-success">Lanjutkan</a>
                                    </td>
                                @else
                                    <td align="center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <form action="{{ route('page.sto',[$s->session_sto,'true/']) }}" method="GET">
                                                <button id="createSto" type="submit" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addRole">
                                                    <i class="fas fa-list fa-sm"></i> Detail
                                                </button>
                                            </form>

                                            <div class="mx-2">
                                                <button class="btn btn-info btn-sm dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="true">
                                                    Export
                                                </button>
                                                <div class="dropdown-menu animated--fade-in"
                                                    aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" id="exportBa" data-id="{{ $s->id }}" href="javascript:void(0)"><i class="bi-file-earmark-pdf fa-sm"></i> Cetak BA</a>    
                                                    <a class="dropdown-item" id="exportExcel" data-id="{{ $s->id }}" href="javascript:void(0)"><i class="bi  bi-file-earmark-spreadsheet fa-sm"></i> Export Excel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                @endif
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

{{--     
    <div class="card shadow mb-4">
        <div class="row d-flex justify-content-center">
            <div class="py-3 col-md-6" >
                <div class="px-4">
                    <div class="d-flex justify-content-center">
                        <label class="text-primary font-weight-bold" >FILTER GRAFIK</label>
                    </div>
                    <div class="form-group">
                        <label for="from-sto">Dari :</label>
                        <input id="from-sto" class="form-control" type="text"  name="sto3" placeholder="STO01" style="width:100%    ">
                    </div>

                    <div class="form-group ">
                        <label for="to-sto">Ke :</label>
                        <input id="to-sto" class="form-control" type="text" name="sto2" placeholder="STO10  " style="width:100%">
                        <button type="submit" class="btn btn-sm btn-primary my-3 btn-block">FILTER</button>    
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    

    
    <!-- Grafik Line -->
    <div id="wrapper-chart">
        {{-- <div id="loading-spinner2" >
                <div class="spinner2"></div>
        </div> --}}
        <div id="chart-area"></div>
        
    </div>

{{-- </div> --}}
<!-- End Page Content -->

<script src={{ asset("plugin/js/apexcharts.min.js") }}></script>
<script>

// var chart;
// function updateChart(){

    // if (chart) { hart.destroy();}

    // document.getElementById('loading-spinner2').style.display = 'flex';
        
        $.get('/chart-data', function(data) {
            // const months = data.months;
            const arrSto = data.sessions;
            const currentYear = data.currentYear
            const statusCounts = data.statusCounts
            const totalBarang = data.totalBarang
            // console.log(arrSto);
            
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
                        }, {
                        name: 'Hilang',
                        data: statusCounts['Hilang']
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
                            borderRadiusApplication: 'end',
                            dataLabels: {
                                position: 'top', // top, center, bottom
                            },
                        },
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val, { seriesIndex, dataPointIndex, w }) {
                                const total = w.config.xaxis.totalBarang[dataPointIndex];
                                return `${parseInt(val / total * 100)}%,${val}`;
                            },
                            offsetY: -20,
                            style: {
                                fontSize: '12px',
                                colors: ["#304758"]
                            }
                        },
                        stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                        },
                        xaxis: {
                        categories: arrSto ,
                        totalBarang : totalBarang,
                        title: {
                            text: 'Session '
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
                                    formatter: function (val,{ seriesIndex, dataPointIndex, w }) {
                                            // Mengambil kategori berdasarkan dataPointIndex
                                            const total = w.config.xaxis.totalBarang[dataPointIndex];
                                            return `${parseInt(val / total * 100)}%,${val}`;
                                    }
                                }
                            }
                    };

        // var options = {
        //     series: [{
        //         name: 'Sangat Layak',
        //         data: statusCounts['Sangat Layak']
        //     }, {
        //         name: 'Cukup Layak',
        //         data: statusCounts['Cukup Layak']
        //     }, {
        //         name: 'Layak Pakai',
        //         data: statusCounts['Layak Pakai']
        //     }, {
        //         name: 'Rusak',
        //         data: statusCounts['Rusak']
        //     }],
        //     chart: {
        //         type: 'bar',
        //         height: 350,
        //         zoom: {
        //             enabled: true,
        //             type: 'x', // Enables zoom in X direction (horizontal)
        //         },
        //     },
        //     plotOptions: {
        //         bar: {
        //             horizontal: false,
        //             columnWidth: '55%',
        //             borderRadius: 3,
        //             borderRadiusApplication: 'end'
        //         },
        //     },
        //     dataLabels: {
        //         enabled: false
        //     },
        //     stroke: {
        //         show: true,
        //         width: 2,
        //         colors: ['transparent']
        //     },
        //     xaxis: {
        //         categories: ["STO01", "STO02", "STO03"], // Kategori STO
        //         title: {
        //             text: 'Tahun ' + currentYear
        //         },
        //         labels: {
        //             rotate: -45, // Optional: Rotate the labels if needed
        //             show: true
        //         },
        //         tooltip: {
        //             enabled: true,
        //             offsetY: 10,
        //         },
        //         scrollbar: {
        //             enabled: true // Enables horizontal scrollbar
        //         }
        //     },
        //     yaxis: {
        //         title: {
        //             text: 'Jumlah STO ' + currentYear
        //         }
        //     },
        //     fill: {
        //         opacity: 1
        //     },
        //     tooltip: {
        //         y: {
        //             formatter: function (val) {
        //                 return val + " sto";
        //             }
        //         }
        //     }
        // };


        //  var options = {
        //   series: [{
        //   name: 'PRODUCT A',
        //   data: [44, 55, 41, 67, 22, 43]
        // }, {
        //   name: 'PRODUCT B',
        //   data: [13, 23, 20, 8, 13, 27]
        // }, {
        //   name: 'PRODUCT C',
        //   data: [11, 17, 15, 15, 21, 14]
        // }, {
        //   name: 'PRODUCT D',
        //   data: [21, 7, 25, 13, 22, 8]
        // }],
        //   chart: {
        //   type: 'bar',
        //   height: 350,
        //   stacked: true,
        //   toolbar: {
        //     show: true
        //   },
        //   zoom: {
        //     enabled: true
        //   }
        // },
        // responsive: [{
        //   breakpoint: 480,
        //   options: {
        //     legend: {
        //       position: 'bottom',
        //       offsetX: -10,
        //       offsetY: 0
        //     }
        //   }
        // }],
        // plotOptions: {
        //   bar: {
        //     horizontal: false,
        //     borderRadius: 10,
        //     borderRadiusApplication: 'end', // 'around', 'end'
        //     borderRadiusWhenStacked: 'last', // 'all', 'last'
        //     dataLabels: {
        //       total: {
        //         enabled: true,
        //         style: {
        //           fontSize: '13px',
        //           fontWeight: 900
        //         }
        //       }
        //     }
        //   },
        // },
        // xaxis: {
        //   type: 'datetime',
        //   categories: ['01/01/2011 GMT', '01/02/2011 GMT', '01/03/2011 GMT', '01/04/2011 GMT',
        //     '01/05/2011 GMT', '01/06/2011 GMT'
        //   ],
        // },
        // legend: {
        //   position: 'right',
        //   offsetY: 40
        // },
        // fill: {
        //   opacity: 1
        // }
        // };

                chart = new ApexCharts(document.querySelector("#chart-area"), options);
                chart.render();
                // document.getElementById('chart-area').style.display = 'none';
        });

    //     setTimeout(function() {
    //     document.getElementById('chart-area').style.display = 'flex';
    //     document.getElementById('loading-spinner2').style.display = 'none';
    // }, 1800); // Jeda 1,5 detik (1500 ms)
    
// }  
// updateChart();

//  Update grafik setiap 5 detik
//  setInterval(updateChart, 115000); // Update setiap 5000 ms (5 detik)

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

    $(document).ready(function() {
        // Post Export Excel
        $('body').on('click','#exportExcel', function(e) {
            
            e.preventDefault();

            // Ambil ID session
            let id_session = $(this).data('id');
            console.log(id_session);
            
                if (id_session != 0) {
                    Swal.fire({
                        title: 'Mengekport Data...',
                        text: 'Silakan tunggu...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    setTimeout(function() {
                        $.ajax({
                            url: '{{ route("export.excel") }}', // Route untuk export
                            method: 'POST',
                            data: {
                                id_session: id_session,
                                _token: '{{ csrf_token() }}' // Kirim CSRF token
                            },
                            xhrFields: {
                                responseType: 'blob' // Mendapatkan response sebagai file
                            },
                            success: function(response, status, xhr) {
                                // Buat URL dari blob dan download file
                                var filename = "";
                                var disposition = xhr.getResponseHeader('Content-Disposition');
                                if (disposition && disposition.indexOf('attachment') !== -1) {
                                    var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                                    var matches = filenameRegex.exec(disposition);
                                    if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                                    Swal.close();
                                }

                                var link = document.createElement('a');
                                var blob = new Blob([response], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
                                link.href = window.URL.createObjectURL(blob);
                                link.download = filename || 'inventaris.xlsx';
                                document.body.appendChild(link);
                                link.click();
                                document.body.removeChild(link);
                                Swal.close();
                            },
                            error: function(response) {
                                alert("An error occurred while exporting data.");
                            }
                        });
                    }, 1000); // Jeda 1,5 detik (1500 ms)
                } else {
                    // alert("Please select at least one record to export.");
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Tolong pilih data yang ingin diexport",
                        confirmButtonColor: '#4e73df',
                    });
                }
        });

        $('body').on('click','#exportBa', function(e) {
            
            e.preventDefault();

            // Ambil ID session
            let id_session = $(this).data('id');
            console.log(id_session);
            
                if (id_session != 0) {
                    Swal.fire({
                        title: 'Mengekport Data...',
                        text: 'Silakan tunggu...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    setTimeout(function() {
                        $.ajax({
                            url: '{{ route("export.ba") }}', // Route untuk export
                            method: 'POST',
                            data: {
                                id_session: id_session,
                                _token: '{{ csrf_token() }}' // Kirim CSRF token
                            },
                            xhrFields: {
                                responseType: 'blob' // Mendapatkan response sebagai file
                            },
                            success: function (response, status, xhr) {
                                
                                // Dapatkan header Content-Disposition untuk menentukan nama file
                                var disposition = xhr.getResponseHeader('Content-Disposition');
                                var filename = 'exported_file.xlsx'; // Default filename

                                // Mengekstrak nama file dari header Content-Disposition
                                if (disposition && disposition.indexOf('attachment') !== -1) {
                                    var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                                    var matches = filenameRegex.exec(disposition);
                                    if (matches != null && matches[1]) {
                                        filename = matches[1].replace(/['"]/g, '');
                                    }
                                }

                                // Membuat link untuk mengunduh file
                                var link = document.createElement('a');
                                var blob = new Blob([response], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
                                link.href = window.URL.createObjectURL(blob);
                                link.download = filename; // Menetapkan nama file yang didapat
                                document.body.appendChild(link);
                                link.click(); // Memulai download
                                document.body.removeChild(link); // Menghapus link dari DOM

                                // Menutup loading Swal
                                Swal.close();
                            },
                            error: function(xhr) {
                                
                                // Jika error, menampilkan pesan error dari server
                                if (xhr.status === 404) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Data Tidak Ditemukan',
                                        text:  'Data dengan status "Rusak" tidak ditemukan untuk session ini.',
                                        confirmButtonColor: '#4e73df'
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Terjadi Kesalahan',
                                        text: 'Terjadi kesalahan saat mengekspor data.',
                                        confirmButtonColor: '#4e73df'
                                    });
                                }
                            }
                        });
                    }, 1000); // Jeda 1,5 detik (1500 ms)
                } else {
                    // alert("Please select at least one record to export.");
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Tolong pilih data yang ingin diexport",
                        confirmButtonColor: '#4e73df',
                    });
                }
        });
    });
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
