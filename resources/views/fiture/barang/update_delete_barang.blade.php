
    <!-- Form Edit Barang-->
    <div class="modal fade" id="updateBarangModal" tabindex="-1" role="dialog" aria-labelledby="editLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div id="barangUpdateError" class="alert alert-danger d-none" role="alert"></div>

            <div id="barangUpdateSuccess" class="alert alert-success d-none" role="alert"></div>

            <form id="barangUpdateForm">

            <div class="modal-header">
                <h5 class="modal-title" id="editLabel">Edit Barang</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="barangUpdate" enctype="multipart/form-data">

                        @csrf

                        @method('PUT')

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
                        
                        {{-- <div class="form-group">
                            <label for="image">Pilih Gambar atau Ambil Foto:</label>
                            <input type="file" class="form-control" name="image" id="image" accept="image/*" capture="camera">
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
        let categoryId = $('#categori_edit_id').val();
        let jenisId = $('#jenis_edit_id').val();
        let merekId = $('#merek_edit_id').val();
        
        $.ajax({
            url: `/invakis/barang/update_barang/${id_index_barang}`,
            type: "PUT",
            data: {
                "id_categori"   : categoryId, 
                "id_jenis"      : jenisId,
                "id_merek"      : merekId,
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
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