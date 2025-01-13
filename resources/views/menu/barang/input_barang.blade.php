@extends('index')

@section('title','Barang')
@section('content')

@if (@session('success'))
    <script>
        Swal.fire({
                    title: 'Menambahkan...',
                    text: 'Silakan tunggu...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
        });
        setTimeout(function() {
            Swal.fire('Menambahkan data!', '{{ session("success") }}', 'success');
        }, 1500); // Jeda 1,5 detik (1500 ms)
    </script>
@endif

{{-- @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif --}}
    
@if ($errors->any())
<script>
    Swal.fire({
    icon: "error",
    title: "Error",
    html: `<div align='left' class="alert alert-danger">
                <ul >
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>`,
    });
</script>
@endif
{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
    @include('fiture.barang.barang_add')
    @include('fiture.barang.update_delete_barang')
    @include('fiture.zoom.zoom_images')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col mb-2 ">
                    <button type="button" id="deleteAll"class="btn  btn-danger">
                        <i class="fas fa-trash fa-sm"></i> Delete
                    </button>
                </div>
                <div class="d-flex flex-row-reverse">
                    <div>
                        <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#addBarang">
                            <i class="fas fa-plus fa-sm"></i> Add Barang
                        </button>
                    </div>
                    <div class="mx-2">
                        <button class="btn btn-info dropdown-toggle" type="button"
                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="true">
                            Export
                        </button>
                        <div class="dropdown-menu animated--fade-in"
                            aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" id="exportPdf" href="javascript:void(0)"><i class="fas fa-qrcode fa-sm"></i> Cetak Qr-Code</a>
                            <a class="dropdown-item" id="exportExcel" href="javascript:void(0)"><i class="fas fa-print fa-sm"></i> Export Excel</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <form id="exportForm" action="{{ route('export.selected') }}" method="POST">
                
                @csrf

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width=5%>No</th>
                            <th><input type="checkbox" id="selectAll"></th>
                            <th width=10%>No Asset</th> 
                            <th>Kategori</th> 
                            <th>Jenis</th> 
                            <th>Merek</th>
                            <th>Warna</th>
                            <th>Lokasi</th>
                            <th>Npk</th>
                            <th>Karyawan</th>
                            <th>Divisi</th>
                            <th>Foto</th>
                            <th>S/N</th>
                            <th>Jenis License</th>
                            <th>Kode License</th>
                            <th>Tanggal Masuk</th>
                            <th>Action</th> 
                            
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($get_barang as $no=>$b)
                            <tr id="row-{{ $b->id }}">
                                <td align="center">{{ $no+1 }}</td>
                                <td><input type="checkbox" class="dataCheckbox" name="selected_ids[]" value="{{ $b->id }}"></td>
                                <td>{{ strtoupper($b->no_asset) }}</td>
                                <td>
                                @if (!empty($b->tbCategori[0]->categori))
                                    {{ $b->tbCategori[0]->categori }}
                                @else
                                    <span class="btn btn-sm btn-outline-warning">empty</span>
                                @endif
                                </td>
                                <td>
                                @if (!empty($b->tbJenis[0]->jenis))
                                    {{ $b->tbJenis[0]->jenis }}
                                @else
                                    <span class="btn btn-sm btn-outline-warning">empty</span>
                                @endif
                                </td>
                                <td>
                                @if ( !empty($b->tbMerek[0]->merek) )
                                    {{ $b->tbMerek[0]->merek  }}</td>    
                                @else
                                    <span class="btn btn-sm btn-outline-warning">empty</span>
                                @endif
                                </td>
                                <td>
                                    @if ( !empty($b->tbWarna[0]->warna) )
                                        {{ $b->tbWarna[0]->warna  }}</td>    
                                    @else
                                        <span class="btn btn-sm btn-outline-warning">empty</span>
                                    @endif
                                    </td>
                                
                                @if (!empty($b->tbZona[0]->lokasi))
                                <td>
                                    {{ $b->tbZona[0]->lokasi }}
                                </td>
                                @else
                                <td class="bg-secondary">
                                </td>
                                @endif
                                
                                <td>
                                @if (!empty($b->tbKaryawan[0]->npk))
                                    {{ $b->tbKaryawan[0]->npk }}
                                @else
                                    <span class="btn btn-sm btn-outline-warning">remove</span>
                                @endif
                                </td>
                                <td>{{ $b->tbKaryawan[0]->nama_kr  }}</td>
                                <td>{{ $b->tbKaryawan[0]->divisi }}</td>
                                <td>
                                    @if ($b->image == 'Not Image')
                                        Not Image
                                    @else
                                        <img id="fotoAsset" data-id="{{ $b->id }}" style="max-width: 50px; cursor: cell;" src="{{ asset('storage/'.$b->image) }}" alt="Foto Asset">    
                                    @endif
                                        
                                </td>

                                @if (!empty($b->serial_number))
                                    <td>
                                        {{ $b->serial_number }}
                                    </td>
                                @else
                                    <td class="bg-secondary">
                                    </td>
                                @endif
                                
                                @if (!empty($b->jenis_license))
                                <td>
                                    {{ $b->jenis_license }}
                                </td>
                                @else
                                    <td class="bg-secondary">
                                    </td>
                                @endif

                                @if (!empty($b->kode_license))
                                    <td>
                                        {{ $b->kode_license }}
                                    </td>
                                @else
                                    <td class="bg-secondary">
                                    </td>
                                @endif
                                
                                <td>{{ $b->tgl_masuk }}</td>
                                <td align="center">
                                    <a href="javascript:void(0)" id="btn-edit-barang" data-id="{{ $b->id }}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="javascript:void(0)" id="btn-delete-barang" data-id="{{ $b->id }}" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                                {{-- <td>
                                    @if (!empty($b->tbMerek[0]->merek) )
                                        {{ $b->tbMerek[0]->merek  }}
                                    @else
                                        <span class="btn btn-secondary">dihapus</span>
                                    @endif
                                </td> --}}

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            </div>
        </div>
    </div>

<script>
$(document).ready(function() {
     
    $('#selectAll').prop('checked', false);
    $('.dataCheckbox').prop('checked', false);
    
    // Fungsi untuk memilih/deselect semua checkbox
    $('#selectAll').click(function() {
        var isChecked = $(this).prop('checked');
        $('.dataCheckbox').prop('checked', isChecked);
    });
    

    // Export PDF QR-CODE
    $('#exportPdf').on('click', function(e) {
        
        e.preventDefault(); 

        // Ambil ID dari checkbox yang dipilih
        var selectedIds = [];

        // Ambil CSRF token Laravel
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        
        $('.dataCheckbox:checked').each(function() {
                selectedIds.push($(this).val());
        });

        if (selectedIds.length > 0) {
                Swal.fire({
                        title: 'Mengexport Data...',
                        text: 'Silakan tunggu...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                });

                setTimeout(function() {
                    $.ajax({
                        url: '{{ route("exportpdf.selected") }}', // Route untuk export
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: {
                            selected_ids: selectedIds,
                        },
                        xhrFields: {
                            responseType: 'blob'  // Untuk menerima file blob PDF
                        },
                        success: function(response) {
                            var blob = new Blob([response], { type: 'application/pdf' });
                            var link = document.createElement('a');
                            link.href = window.URL.createObjectURL(blob);
                            link.download = "barang.pdf";  // Nama file PDF yang didownload
                            link.click();
                            Swal.close();
                        },
                        error: function(xhr, status, error) {
                            alert('Error generating PDF: ' + error);
                        }
                    });
                }, 1500); // Jeda 1,5 detik (1500 ms)
        }
        else {
            // alert("Please select at least one record to export.");
            Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Tolong pilih data yang ingin diexport",
                    confirmButtonColor: '#4e73df',
            });
        }

    });

    // Post Export Excel
    $('#exportExcel').on('click', function(e) {
        // console.log("DI KLIK");
        e.preventDefault();

        // Ambil ID dari checkbox yang dipilih
        var selectedIds = [];

            $('.dataCheckbox:checked').each(function() {
                selectedIds.push($(this).val());
            });

            if (selectedIds.length > 0) {
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
                        url: '{{ route("export.selected") }}', // Route untuk export
                        method: 'POST',
                        data: {
                            selected_ids: selectedIds,
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

   var table = $('#dataTable').DataTable({
        "columnDefs": [
            { 
            "orderable": false, 
            "searchable": false,
            "targets": [1] 
        } // Disable sorting on the first and third column
        ]
    });

    // console.log(table);
    

    // Inisialisasi Datepicker
    $('#datepicker').datepicker({
        format: 'yyyy-mm-dd',  // Format tanggal yang dihasilkan
        autoclose: true,
        todayHighlight: true
    });

    $('#npk_id').change(function() {
        var id_npk = $(this).val(); // Ambil nilai NPK yang dipilih
        // console.log(id_npk);

        if (id_npk) {
            // Lakukan AJAX untuk mengambil data karyawan berdasarkan NPK
            $.ajax({
                url: `/get-karyawan/${id_npk}`,
                type: 'GET',
                success: function(data) {
                    // Jika karyawan ditemukan, tampilkan nama di input field
                    $('#karyawan_id').val(data.nama_kr);
                    $('#divisi_id').val(data.divisi);
                },
                error: function(xhr) {
                    // Jika terjadi kesalahan atau karyawan tidak ditemukan
                    alert('Karyawan tidak ditemukan');
                    $('#nama_karyawan').val(''); // Kosongkan field nama karyawan
                }
            });
        } else {
            // Kosongkan input nama karyawan jika tidak ada NPK yang dipilih
            $('#karyawan_id').val('');
            $('#divsi_id').val('');
        }
    });

    $('#deleteAll').on('click', function(e) {
        e.preventDefault();
        // Ambil ID dari checkbox yang dipilih
        var selectedIds = [];

        $('.dataCheckbox:checked').each(function() {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length > 0) {
            Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan data ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                        $.ajax({
                            url: '/invakis/barang/delete_all/', // Route untuk export
                            method: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                data: selectedIds
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Dihapus!',
                                    'Data Anda telah dihapus.',
                                    'success'
                                );

                                setTimeout(function() {
                                    location.reload(); // Atau update daftar kategori dengan cara lain
                                    $('#selectAll').prop('checked', '');
                                    $('.dataCheckbox').prop('checked', '');
                                }, 3000);
        
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus data.',
                                    'error'
                                );
                            }
                        }); 
                    }
                });
        }
        else {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Tolong pilih data yang ingin dihapus",
                confirmButtonColor: '#4e73df',
            });
        }
    });    
    
});

</script>
@endsection
