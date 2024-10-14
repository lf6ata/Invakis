
    <!-- Form Edit Barang-->
    <div class="modal fade" id="updateBarangModal" tabindex="-1" role="dialog" aria-labelledby="editLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div id="barangUpdateError" class="alert alert-danger d-none" role="alert"></div>

            <div id="barangUpdateSuccess" class="alert alert-success d-none" role="alert"></div>

            <div class="modal-header">
                <h5 class="modal-title" id="editLabel">Edit Barang</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="barangUpdate" enctype="multipart/form-data">

                        @csrf

                        @method('POST')

                        <div class="form-group">
                            
                            <label for="categori_id">Categori:</label>
                            <input id="id_index_barang_edit" type="number">
                            <select name="categori_id" id="categori_edit_id" class="form-control" required>
                               {{-- Select akan di isi oleh ajax --}}
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="jenis_id">Jenis:</label>
                            <select name="jenis_id" id="jenis_edit_id" class="form-control" required>
                              {{-- Select akan di isi oleh ajax --}}
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="merek_id">Merek:</label>
                            <select name="merek_id" id="merek_edit_id" class="form-control" required>
                              
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="lokasiAdd">Lokasi</label>
                            <input type="Text" class="form-control" id="lokasi_edit_id" name="lokasi_id" placeholder="Lokasi">
                        </div>

                        <div class="form-group">
                            <label for="npk_edit_id">Npk:</label>
                            <select name="npk_edit_id" id="npk_edit_id" class="form-control" required>
                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="karyawan_edit_id">Karyawan</label>
                            <input type="Text" class="form-control" id="karyawan_edit_id" name="karyawan_edit_id" placeholder="Nama Karyawan" readonly>
                        </div>

                        <div class="form-group">
                            <label for="divisi_edit_id">Divisi</label>
                            <input type="Text" class="form-control" id="divisi_edit_id" name="divisi_edit_id" placeholder="Divisi" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label for="image">Pilih Gambar atau Ambil Foto:</label>
                            <input type="file" class="form-control" name="image" id="image_edit" accept="image/*" capture="camera">
                        </div>

                           {{--@if (session('success'))
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
                            @endif --}}
                    </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="updateBaragBtn" type="button">Update</button>
            </div>
        </div>
    </div>
</div> 
<!-- End Edit Button -->

<script>

$(document).ready(function() {

    $('#npk_edit_id').change(function() {
            var id_npk = $(this).val(); // Ambil nilai NPK yang dipilih
            // console.log(id_npk);
            

            if (id_npk) {
                // Lakukan AJAX untuk mengambil data karyawan berdasarkan NPK
                $.ajax({
                    url: `/get-karyawan/${id_npk}`,
                    type: 'GET',
                    success: function(data) {
                        // Jika karyawan ditemukan, tampilkan nama di input field
                        $('#karyawan_edit_id').val(data.nama_kr);
                        $('#divisi_edit_id').val(data.divisi);
                    },
                    error: function(xhr) {
                        // Jika terjadi kesalahan atau karyawan tidak ditemukan
                        alert('data tidak ditemukan');
                        $('#karyawan_edit_id').val(''); // Kosongkan field nama karyawan
                        $('#divisi_edit_id').val(''); // Kosongkan field nama karyawan
                    }
                });
            } else {
                // Kosongkan input nama karyawan jika tidak ada NPK yang dipilih
                $('#nama_edit_karyawan').val('');
            }
        });

   //button view modal edit barang and view data
   $('body').on('click', '#btn-edit-barang', function (e) {
        
        e.preventDefault(); 

        let id_index_barang = $(this).data('id');

        //fetch detail post with ajax
        $.ajax({
            url: `/invakis/barang/edit_barang/${id_index_barang}`,
            type: "GET",
            cache: false,
            success:function(response){

                // console.log(response);

                // console.log(response.data.no_asset);
                $('#id_index_barang_edit').val(response.index_barang.id); // inisialisasi id_index form select

                $('#categori_edit_id').empty().append('<option value="">-- Pilih Kategori --</option>'); //mengosongkan dan menginisialisasikan form select utama

                // Loop dan masukkan opsi kategori yang ada
                $.each(response.get_categori, function(key, categori) {

                    // Jika data barang sudah ada, pilih kategori yang sesuai
                    let selected = (response.index_barang.id_categori == categori.id) ? 'selected' : '';
                    $('#categori_edit_id').append('<option value="' + categori.id + '" ' + selected + '>' + categori.categori + '</option>');
                });


                $('#jenis_edit_id').empty().append('<option value="">-- Pilih Jenis --</option>'); //mengosongkan dan menginisialisasikan form select utama

                // Loop dan masukkan opsi jenis yang ada
                $.each(response.get_jenis, function(key, jenis) {

                    // Jika data barang sudah ada, pilih kategori yang sesuai
                    let selected = (response.index_barang.id_jenis == jenis.id) ? 'selected' : '';
                    $('#jenis_edit_id').append('<option value="' + jenis.id + '" ' + selected + '>' + jenis.jenis + '</option>');
                });

                
                $('#merek_edit_id').empty().append('<option value="">-- Pilih Merek --</option>'); //mengosongkan dan menginisialisasikan form select utama

                // Loop dan masukkan opsi merek yang ada
                $.each(response.get_merek, function(key, mereks) {

                    // Jika data barang sudah ada, pilih kategori yang sesuai
                    let selected = (response.index_barang.id_merek == mereks.id) ? 'selected' : '';
                    $('#merek_edit_id').append('<option value="' + mereks.id + '" ' + selected + '>' + mereks.merek + '</option>');
                });

                $('#lokasi_edit_id').val(response.index_barang.lokasi);

                $('#npk_edit_id').empty().append('<option value="">-- Pilih NPK --</option>'); //mengosongkan dan menginisialisasikan form select utama

                // Loop dan masukkan opsi karyawan yang ada
                $.each(response.get_karyawan, function(key, karyawan) {

                    // Jika data barang sudah ada, pilih kategori yang sesuai
                    let selected = (response.index_barang.npk == karyawan.id) ? 'selected' : '';
                    $('#npk_edit_id').append('<option value="' + karyawan.id + '" ' + selected + '>' + karyawan.npk + '</option>');
                });

                $('#karyawan_edit_id').val(response.index_barang.nama_kr);

                $('#divisi_edit_id').val(response.index_barang.divisi);
                
                //open modal
                $('#updateBarangModal').modal('show');
            },

            error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
  
        });
    });
});

    // Mengupdate barang saat tombol update diklik
    $('#updateBaragBtn').on('click', function() {
        console.log("klik");
        let id_index_barang = $('#id_index_barang_edit').val();
        let categoryId      = $('#categori_edit_id').val();
        let jenisId         = $('#jenis_edit_id').val();
        let merekId         = $('#merek_edit_id').val();
        let lokasi          = $('#lokasi_edit_id').val();
        let npk             = $('#npk_edit_id').val();
        let nama            = $('#karyawan_edit_id').val();
        let divisi          = $('#divisi_edit_id').val();
        let image           = $('#image_edit')[0].files[0];
        // console.log(image);
        // console.log(typeof(image));
         
        var formData = new FormData();
        formData.append('_token',$('meta[name="csrf-token"]').attr('content'));
        formData.append('_method', 'POST');
        formData.append('id_categori',categoryId);
        formData.append('id_jenis',jenisId);
        formData.append('id_merek',merekId);
        formData.append('lokasi',lokasi);
        formData.append('npk',npk);
        formData.append('nama',nama);
        formData.append('divisi',divisi);
        formData.append('imagenew',image);
        
        console.log(formData);
        
        $.ajax({
            url: `/invakis/barang/update_barang/${id_index_barang}`,
            type: "POST",
            contentType: false,  // Harus false untuk `FormData`
            processData: false,  // Harus false untuk `FormData`
            data: 
            formData,
            // {
            //     "id_categori"   : categoryId, 
            //     "id_jenis"      : jenisId,
            //     "id_merek"      : merekId,
            //     "lokasi"        : lokasi,
            //     "npk"           : npk,
            //     "nama"          : nama,
            //     "divisi"        : divisi,
            //     // "imagenew"      : image
            //     "_token"        : $('meta[name="csrf-token"]').attr('content'),
                
            // },
            success: function(response) {
                alert(response.message);
                
                $('#updateBarangModall').modal('hide');
                window.location.href = "/invakis/barang/view_barang/updated_at"; //lakukan pembaruan tampilan updated
            },
            error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
        });
    });

$(document).on('click', '#btn-delete-barang', function() {
    let categoryId = $(this).data('id');
    console.log(typeof(categoryId)+categoryId);
    if (confirm('Are you sure you want to delete this category?')) {
        $.ajax({
            url: `/invakis/barang/delete_barang/${categoryId}`,
            type: "DELETE",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.message);
                // Refresh daftar kategori atau lakukan pembaruan tampilan jika perlu
                location.reload(); // Atau update daftar kategori dengan cara lain
            },
            error: function(xhr) {
                alert(xhr.responseJSON.message);
            }
        });
    }
});


      
</script>