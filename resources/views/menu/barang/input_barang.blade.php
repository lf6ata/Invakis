@extends('index')

@section('title','Barang')
@section('content')

        <!-- Form Add Barang-->
        <div class="modal fade" id="addBarang" tabindex="-1" role="dialog" aria-labelledby="addLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLabel">Add Barang</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data">
                            
                            @csrf

                            <div class="form-group">
                                <label for="categori_id">Categori:</label>
                                <select name="categori_id" id="categori_id" class="form-control" required>
                                    <option value="">-- Pilih Categori --</option>
                                    @foreach($get_categori as $c)
                                        <option value="{{ $c->id }} ">{{ $c->categori }}</option>
                                     @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jenis_id">Jenis:</label>
                                <select name="jenis_id" id="jenis_id" class="form-control" required>
                                    <option value="">-- Pilih Jenis --</option>
                                    @foreach($get_jenis as $j)
                                        <option value="{{ $j->id }} ">{{ $j->jenis }}</option>
                                     @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="merek_id">Merek:</label>
                                <select name="merek_id" id="merek_id" class="form-control" required>
                                    <option value="">-- Pilih Merek --</option>
                                    @foreach($get_merek as $m)
                                        <option value="{{ $m->id}} ">{{ $m->merek }}</option>
                                     @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="lokasiAdd">Lokasi</label>
                                <input type="Text" class="form-control" id="lokasi_id" name="lokasi_id" placeholder="Lokasi">
                            </div>

                            <div class="form-group">
                                <label for="npk_id">Npk:</label>
                                <select name="npk_id" id="npk_id" class="form-control" required>
                                    <option value="">-- Pilih Npk --</option>
                                    @foreach($get_karyawan as $k)
                                        <option value="{{ $k->id}} ">{{ $k->npk }}</option>
                                     @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="karyawan_id">Karyawan</label>
                                <input type="Text" class="form-control" id="karyawan_id" name="karyawan_id" placeholder="Nama Karyawan" readonly>
                            </div>

                            <div class="form-group">
                                <label for="divisi_id">Divisi</label>
                                <input type="Text" class="form-control" id="divisi_id" name="divisi_id" placeholder="Divisi" readonly>
                            </div>
                            

                            <div class="form-group">
                                <label for="image">Pilih Gambar atau Ambil Foto:</label>
                                <input type="file" class="form-control" name="image" id="image" accept="image/*" capture="camera">
                            </div>

                            <div class="form-group">
                                <label for="sn_id">Serial Number</label>
                                <input type="Text" class="form-control" id="sn_id" name="sn_id" placeholder="Serial Number">
                            </div>

                            <div class="form-group">
                                <label for="jlicense_id">Jenis License</label>
                                <input type="Text" class="form-control" id="jlicense_id" name="jlicense_id" placeholder="Jenis License">
                            </div>

                            <div class="form-group">
                                <label for="kdlicense_id">Kode License</label>
                                <input type="Text" class="form-control" id="kdlicense_id" name="kdlicense_id" placeholder="Kode License">
                            </div>

                            <div class="form-group">
                                <label for="tanggal">Tangggal Masuk:</label>
                                <input type="text" class="form-control" id="datepicker" name="tanggal_masuk" placeholder="Pilih tanggal" required>
                            </div>

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    
                                    <img src="{{ asset('storage/images/' . session('image')) }}" alt="Uploaded Image" style="max-width: 200px;">
                                @endif
                    
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div> 
    <!-- End Add Button -->
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
                                    <div class="col-md-auto mb-2">
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
                                    <div class="col col-lg-2">
                                        <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#addBarang">
                                            <i class="fas fa-plus fa-sm"></i> Add Barang
                                        </button>
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
                                                <th>Categori</th> 
                                                <th>Jenis</th> 
                                                <th>Merek</th>
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
                                                    @if (!empty($b->lokasi))
                                                        {{ $b->lokasi }}
                                                    @else
                                                        <span class="btn btn-sm btn-outline-warning">empty</span>
                                                    @endif
                                                    </td>
                                                    <td>
                                                    @if (!empty($b->tbKaryawan[0]->npk))
                                                        {{ $b->tbKaryawan[0]->npk }}
                                                    @else
                                                        <span class="btn btn-sm btn-outline-warning">remove</span>
                                                    @endif
                                                    </td>
                                                    <td>{{ $b->nama_kr  }}</td>
                                                    <td>{{ $b->divisi }}</td>
                                                    <td>
                                                        <img id="fotoAsset" data-id="{{ $b->id }}" style="max-width: 50px; cursor: cell;" src="{{ asset('storage/'.$b->image) }}" alt="Foto Asset">
                                                    </td>
                                                    <td>{{ $b->serial_number }}</td>
                                                    <td>{{ $b->jenis_license }}</td>
                                                    <td>{{ $b->kode_license }}</td>
                                                    <td>{{ $b->tanggal_masuk }}</td>
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
                    },
                    error: function(xhr, status, error) {
                        alert('Error generating PDF: ' + error);
                    }
                });
        }
        else {
            alert("Please select at least one record to export.");
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
                        }

                        var link = document.createElement('a');
                        var blob = new Blob([response], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
                        link.href = window.URL.createObjectURL(blob);
                        link.download = filename || 'inventaris.xlsx';
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    },
                    error: function(response) {
                        alert("An error occurred while exporting data.");
                    }
                });
            } else {
                alert("Please select at least one record to export.");
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

    console.log(table);
    

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

    // Delete ALL
    $('#deleteAll').on('click', function(e) {
            // console.log("DI KLIK");
            e.preventDefault();

            // if (confirm('Are you sure you want to delete this category?')) {

                // Ambil ID dari checkbox yang dipilih
                var selectedIds = [];

                $('.dataCheckbox:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length > 0) {
                    // alert("wah ada");
                    $.ajax({
                        url: '/invakis/barang/delete_all/', // Route untuk export
                        method: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            data: selectedIds
                        },
                        success: function(response) {
                            alert(response.success);
                            // Refresh daftar kategori atau lakukan pembaruan tampilan jika perlu
                            location.reload(); // Atau update daftar kategori dengan cara lain
                            $('#selectAll').prop('checked', '');
                            $('.dataCheckbox').prop('checked', '');
                        },
                        error: function(response) {
                            alert("An error occurred while delete data.");
                        }
                    });
                } else {
                    alert("Please select at least one record to delete.");
                    
                }
            // }
        });


    
});

</script>
@endsection
