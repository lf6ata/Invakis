<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="alif">
    <meta name="author" content="alif">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ url('favicon/kiosbank.png') }}" type="image/x-icon">
    <title>INVAKIS</title>
    <!-- Custom fonts for this template-->
    <link href={{ asset("template/vendor/fontawesome-free/css/all.min.css") }} rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href={{ asset("template/css/sb-admin-2.min.css") }} rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href={{ asset("template/vendor/datatables/dataTables.bootstrap4.min.css") }} rel="stylesheet">
    
    <!-- Library Ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

     <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <style>
        input.form-control {
            background-color:  white; /* Warna latar belakang putih */
            border: 1px solid #ccc; /* Gaya border */
            color: black; /* Warna teks */
        }
    </style>
</head>
<body id="page-top" style="background:#4e73df;">
    <!-- Form Stock Opname-->
    <div class="body">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">Stock Opname</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <a href="javascript:history.back()"> x</a>
                </button>
            </div>
            <div class="modal-body">
                
                @foreach ($barang as $b)
                <div class="card">
                    <div class="content" style="display: flex; justify-content: center;" >
                        <div class="form-group text-center pt-3 radius-4" style="max-width: 500px; width: 100%;">
                            <img class="rounded" id="fotoAsset" data-id="{{ $b->id }}" style="max-width: 100%;" src="{{ asset('storage/'.$b->image) }}" alt="Foto Asset">
                        </div>
                    </div>
                </div>
                <div class="modal-footer"></div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="no_asset">No Asset</label>
                        <input type="Text" class="form-control" id="no_asset" name="no_asset" value="{{ $b->no_asset }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="kategori">Kategori</label>
                        <input type="Text" class="form-control" id="kategori" name="kategori" value="{{ $b->tbCategori[0]->categori }}" readonly>
                    </div>
                    {{-- <div class="form-group col-md-4">
                        <label for="jenis">Jenis</label>
                        <input type="Text" class="form-control" id="jenis"  value="{{ $b->tbJenis[0]->jenis }}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="merek">Merek</label>
                        <input type="Text" class="form-control" id="merek"  value="{{ $b->tbMerek[0]->merek }}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="warna">Warna</label>
                        <input type="Text" class="form-control" id="warna"  value="belum" readonly>
                    </div> --}}
                    <div class="form-group col-md-6">
                        <label for="lokasi">Lokasi</label>
                        <input type="Text" class="form-control" id="lokasi"  value="{{ $b->lokasi }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="npk">Npk</label>
                        <input type="Text" class="form-control" id="npk"  value="{{ $b->tbKaryawan[0]->npk }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama_karyawan">Nama Karyawan</label>
                        <input type="Text" class="form-control" id="nama_karyawan"  value="{{ $b->nama_kr }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="divisi">Divisi</label>
                        <input type="Text" class="form-control" id="divisi"  value="{{ $b->tbKaryawan[0]->divisi }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="serial_number">S/N</label>
                        <input type="Text" class="form-control" id="serial_number"  value="{{ $b->serial_number }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jenis_license">Jenis License</label>
                        <input type="Text" class="form-control" id="jenis_license"  value="{{ $b->jenis_license }}" readonly>
                    </div>
                    {{-- <div class="form-group col-md-4">
                        <label for="kode_license">Kode License</label>
                        <input type="Text" class="form-control" id="kode_license"  value="{{ $b->kode_license }}" readonly>
                    </div> --}}
            </div>

            @if ($endpoint == 'edit')
                <form action="{{ route('update.sto') }}" method="POST">   
                    @method('PUT') 
            @else
                <form action="{{ route('store.sto') }}" method="POST">    
            @endif
            
                @csrf
                <div class="card modal-footer">
                    <div class="row">
                        <input type="number" name="id_session" value="{{ substr($id_session , 0, strlen($id_session ) - 5)}}" hidden>
                        <input type="text" name="session_sto" value="{{ $no_sto }}" hidden>
                        <input type="text" name="no_asset_id" value="{{ $b->no_asset }}" hidden>
                      
                        {{-- <div class="form-group col-md-6">
                            <label for="tanggal">Tanggal Terakhir Sto</label>
                            <input type="text" class="form-control" id="datepicker2"  value="{{ $tgl_sto_old }}"  name="tgl_end_sto" placeholder="Pilih tanggal" >
                        </div> --}}
                        
                        <div class="form-group ">
                            <label for="status_id">Status:</label>
                            <select name="status_id" id="status_id" class="form-control" required>
                                <option value="">-- Pilih Status --</option>

                                    @foreach($enum as $n)
                                        <option class="
                                        {{ $n == "Sangat Layak" ? "text-primary" : "" }}
                                        {{ $n == "Cukup Layak" ? "text-success" : "" }}
                                        {{ $n == "Layak Pakai" ? "text-warning" : "" }}
                                        {{ $n == "Rusak" ? "text-danger" : "" }}
                                        {{ $n == "Hilang" ? "text-info" : "" }}
                                        " value="{{ $n}}" {{ $n == $status_old ? "selected" : "" }}>
                                            {{ $n == "Sangat Layak" ? "Sangat Layak (90%)" : "" }}
                                            {{ $n == "Cukup Layak" ? "Cukup Layak (75%)" : "" }}
                                            {{ $n == "Layak Pakai" ? "Layak_Pakai (50%)" : "" }}
                                            {{ $n == "Rusak" ? "Rusak" : "" }}
                                            {{ $n == "Hilang" ? "Hilang" : "" }}
                                        </option>
                                    @endforeach    

                            </select>
                        </div>
                    </div>
                </div> 
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="window.history.back()" type="button" data-dismiss="modal">Cancel</button>
                    <button class="{{ $endpoint == 'edit' ? 'btn btn-warning' : 'btn btn-primary' }}" type="submit">
                        @if ($endpoint == 'edit')
                            Update
                        @else
                            Save
                        @endif
                    </button>
                </div>
            </form>       
            @endforeach
            
            </div>
            
        </div>
    </div>
</div> 
<!-- End Add Button -->


<script>
$(document).ready(function() {
    // Inisialisasi Datepicker
    $('#datepicker2').datepicker({
        format: 'yyyy-mm-dd',  // Format tanggal yang dihasilkan
        autoclose: true,
        todayHighlight: true
    });
});
</script>
{{-- All Plugin --}}
@include('include.script')
</body>
</html>