@extends('index')

@section('title','Dashboard')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
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

        <!-- Qr Code Example -->
        <a href={{ route('page.scan') }} class="nav-link nav-dst col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                               Scan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Qr-Code</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-qrcode fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>

    </div>
    <!-- End Row -->

    <!-- Bar Chart -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
        </div>
        <div class="card-body">
            <div class="chart-bar">
                <canvas id="myBarChart"></canvas>
            </div>
            <hr>
            <code><a href={{ route('page.sto') }} class="nav-link">View Detail</a></code>
        </div>
    </div>
</div>
<!-- End Page Content -->
<script>
    let nameItems = {
        'sangat': {{ $count_sangat }},
        'cukup' : {{ $count_cukup }},
        'layak' : {{ $count_layak }} ,
        'rusak' : {{ $count_rusak }},
    };

    console.log(nameItems.layak);
    
</script>
<!-- Page level plugins -->
<script src="{{ asset('') }}template/vendor/chart.js/Chart.min.js"></script>
<!-- Page level custom scripts -->
<script src="{{ asset('') }}template/js/demo/chart-bar-demo.js"></script>

@endsection
