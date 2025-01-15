@extends('index')

@if ($status === 'false')
    @section('title','Stock Opname')
@else
    @section('title', 'Rekap Sto')
@endif
@section('content')


 <div class="d-flex flex-row-reverse mb-3">
        <div class="p-2">

                <a href="{{ route('page.dashboard') }}" class="btn btn-primary mr-2">
                    <i class="fas fa-arrow-left fa-sm"></i> Kembali
                </a>
                
                @if ($status === 'false')
                    <a href="{{ route('save_timer',$id) }}" class="btn btn-success">
                        <i class="bi bi-floppy2-fill fa-sm fa-sm"></i> Save
                    </a>

                    <div class="btn">
                        <form action="{{ route('save_sto',$id) }}">
                            @csrf
                            <button id="saveSto" type="submit" class="btn btn-info">
                                <i class="bi bi-floppy2-fill fa-sm"></i> Finish Sto
                            </button>
                        </form>   
                    </div>


                @endif
            
        </div>
    </div>

<!-- Content Row -->
<div class="row">
    {{-- <!-- Persentase STO -->
    <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                        Peresentase sto</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">6%</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-percent fa-2x text-gray-600"></i>
                </div>
            </div>
        </div>
    </div>
    </div> --}}

    @if ($status === 'false')
       <!-- Progress Card -->
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
    </div>

    <script>
        function getProgress() {
            $.ajax({
                url: "{{ route('get.progress') }}",
                method: "GET",
                success: function(data) {
                    const percentage = data.percentage;
                    $('#persen').text(percentage + '%');
                    $('#progressBar').val(percentage);

                    // Set timeout to update progress every 10 seconds
                    // setTimeout(getProgress, 100000);
                    // console.log(percentage);
                }
            });
        }

        // Start the real-time progress update when the page is loaded
        $(document).ready(function() {
            getProgress();
        });
    </script>

    @endif

   <!-- Timer Card -->
    <div  class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Timer</div>
                    <div id="timer" class="h5 mb-0 font-weight-bold text-gray-800">00:00:00</div>
                </div>
                <div class="col-auto">
                    <i class="bi bi-stopwatch fa-2x text-gray-600"></i>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php 
        $id_session_sto = $total_durasi[0]->id;
        $session_sto = $total_durasi[0]->session_sto;
    ?>
    @if ($status === 'false')
        <!-- Qr Code Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <a href={{ route('page.scan',$id_session_sto) }} class="nav-link nav-dst">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Scan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Qr-Code</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-upc-scan fa-2x text-gray-600"></i>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    @endif

 

</div>
<!-- End Row -->

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>  
@endif
<!-- DataTales Sudah STO -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex align-items-center">
            <div class="p-2 flex-grow-1">
                <h6 class="m-0 font-weight-bold text-primary ">Data Sudah STO</h6>
            </div>
            
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width=5%>No</th>
                        <th>No Asset</th> 
                        <th>Nama Barang</th>
                        <th>Lokasi</th>
                        <th>User</th> 
                        <th>Status</th> 
                        <th>Tgl Sto</th>
                        @if ($status === 'false')
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    {{-- @foreach($index_sto as $no=>$s) --}}
                    @foreach ($finish_sto as $no=>$s)
                        <tr>
                            <td>{{ $no+1 }}</td>
                            <td>{{ $s->no_asset }}</td>
                            <td>{{ $s->tbBarang[0]->tbCategori[0]->categori }}</td>
                            <td>{{ $s->tbBarang[0]->tbZona[0]->lokasi }}</td>
                            <td>{{ $s->user }}</td>
                            <td> 
                                <span @if ($s->status == "Sangat Layak")
                                    class="badge badge-primary"
                                @elseif ($s->status == "Cukup Layak")
                                    class="badge badge-success"
                                @elseif ($s->status == "Layak Pakai")
                                    class="badge badge-warning"
                                @elseif ($s->status == "Rusak")
                                    class="badge badge-danger"
                                @elseif ($s->status == "Hilang")
                                    class="badge badge-info"
                                @endif >
                                    {{ $s->status }}
                                </span>
                            </td>
                            <td>{{ $s->created_at }}</td>
                            @if ($status === 'false')
                                <td align="center">
                                    <form method="GET" action="{{ route('edit.sto',[$s->no_asset,$session_sto,$id_session_sto.'_edit']) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning " >Edit</button>
                                    </form>
                                {{-- <form method="GET" action="{{ route('edit.sto',[$s->no_asset,$session_sto,$id_session_sto]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary " >View</button>
                                </form> --}}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--End Sudah STO-->


@if ($status === 'false')
    <!-- DataTales Belum STO -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex align-items-center">
                <div class="p-2 flex-grow-1">
                    <h6 class="m-0 font-weight-bold text-danger ">Data Belum STO</h6>
                </div>
                
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width=5%>No</th>
                            <th width=10%>No Asset</th> 
                            <th>Nama Barang</th>
                            <th>Lokasi</th>
                            <th>Karyawan</th>
                            <th>Divisi</th>
                            <th>Tanggal Input</th>
                            <th>Tanggal Sto</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($not_yet_sto as $no=>$n_sto)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td>{{ $n_sto->no_asset }}</td>
                                <td>{{ $n_sto->tbCategori[0]->categori }}</td>
                                <td>{{ $n_sto->tbZona[0]->lokasi }}</td>
                                <td>{{ $n_sto->tbKaryawan[0]->nama_kr }}</td>
                                <td>{{ $n_sto->divisi }}</td>
                                <td>{{ $n_sto->tgl_masuk }}</td>
                                <td>{{ $n_sto->tgl_terakhir_sto }}</td>
                                <td align="center">
                                    <form method="GET" action="{{ route('edit.sto',[$n_sto->no_asset,$session_sto,$id_session_sto.'_post']) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary px-4" >Sto</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--End Belum STO-->
@endif
     
<script>

    const status = '{{ $status }}';
    const total_durasi = '{{ $total_durasi[0]->durasi }}';
    let timerDisplay = document.getElementById('timer');
    // console.log(total_durasi);

    let serverTime = 0; // Waktu awal dari server
    let intervalId;

     function formatTime(hours, minutes, seconds) {
        return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    }

    function startLocalTimer() {
        clearInterval(intervalId); // Hentikan timer sebelumnya
        intervalId = setInterval(() => {
            serverTime++;
            const hours = Math.floor(serverTime / 3600);
            const minutes = Math.floor((serverTime % 3600) / 60);
            const seconds = serverTime % 60;
            timerDisplay.textContent = formatTime(hours, minutes, seconds);
            
        }, 1000);
    }

    async function fetchTimer() {
        const response = await fetch('/timer');
        const data = await response.json();
        if (data.elapsed_time !== 0) {
            serverTime = data.elapsed_time; // Timestamp dari server
            if ('{{ $flag_timer }}' == 'false') {
                startLocalTimer();    
            }
            
        }
    }

    if (status === 'false') {
        fetchTimer();
    } else {
        timerDisplay.textContent = total_durasi;
    }
    

    // // Fungsi untuk memformat waktu
    // function formatTime(hours, minutes, seconds) {
    //     return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    // }

    // // Fungsi untuk mengambil waktu dari server
    // async function fetchTimer() {
    //     const response = await fetch('/timer');
    //     const data = await response.json();

    //     // Update tampilan timer
    //     timerDisplay.textContent = formatTime(data.hours, data.minutes, data.seconds);
    // }

    // // Jalankan fetchTimer setiap detik
    // setInterval(fetchTimer, 1000);
</script>

<script>
$(document).ready(function() {
    $('#dataTable2').DataTable();
    $('#npk_id').change(function() {
        let id_npk = $(this).val(); // Ambil nilai NPK yang dipilih
     
        if(parseInt(id_npk)){
            if (id_npk.length > 7) {
            // console.log("NPK tidak boleh lebih dari 7 angka");
            $('#check_length').text('NPK tidak boleh lebih dari 7 angkadata');
            }
            else if (id_npk.length < 7)
            {
                // console.log("Npk tidak boleh kurang dari 7 angka");
                $('#check_length').text('Npk tidak boleh kurang dari 7 angka');
            }
            else{
                $('#check_length').text('');
            }
        }
        else if(id_npk == ""){
            $('#check_length').text('');
        }
        else {
            $('#check_length').text('Tidak boleh huruf');
        }
    });

    $(document).on('click', '#btn-delete-pegawai', function() {
    let pegawaiId = $(this).data('id');

    if (confirm('Are you sure you want to delete this pegawai?')) {
        $.ajax({
                url: `/invakis/pegawai/delete_pegawai/${pegawaiId}`,
                type: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert(response.message);
                    
                    location.reload(); // Refresh daftar pegawai atau lakukan pembaruan tampilan jika perlu
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message);
                }
            });
        }
    });
});
</script>
    
@endsection