
    <!-- Form Edit Categori-->
    <div class="modal fade" id="updateCategoriModal" tabindex="-1" role="dialog" aria-labelledby="editLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div id="categoriUpdateError" class="alert alert-danger d-none" role="alert"></div>

            <div id="categoriUpdateSuccess" class="alert alert-success d-none" role="alert"></div>

            <form id="categoriUpdateForm">

            <div class="modal-header">
                <h5 class="modal-title" id="editLabel">Edit Categori</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="categoriUpdate">

                    @csrf
                    <input type="number" id="id_index_categori" hidden>
                    <div class="form-group">
                      <label for="idcategoriUpdate">Id Kategori</label>
                      <input type="Text" class="form-control" id="idcategoriUpdate" name="id_categori" placeholder="Id Categori">
                    </div>

                    <div class="form-group">
                      <label for="categoriUpdate">Kategori</label>
                      <input type="Text" class="form-control" id="categoriUpdate" name="categori" placeholder="Categori">
                    </div>
                
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="button" id="categoriUpdateBtn">Update</a>
            </div>
        </div>
    </div>
</div> 
<!-- End Edit Button -->

<script>

$(document).ready(function() {
   //button view modal edit categori and view data
   $('body').on('click', '#btn-edit-categori', function (e) {
        
        e.preventDefault(); 

        let id_index = $(this).data('id');

        //fetch detail post with ajax
        $.ajax({
            url: `/invakis/barang/edit_categori/${id_index}`,
            type: "GET",
            cache: false,
            success:function(response){
                
                //fill data to form
                $('#id_index_categori').val(response.data.id);
                $('#idcategoriUpdate').val(response.data.id_categori);
                $('#categoriUpdate').val(response.data.categori);

                //open modal
                $('#updateCategoriModal').modal('show');
            }
        });
    });

    // Mengupdate kategori saat tombol update diklik
    $('#categoriUpdateBtn').on('click', function() {
        let id_index = $('#id_index_categori').val();
        let categoryId = $('#idcategoriUpdate').val();
        let categoryName = $('#categoriUpdate').val();
        
        Swal.fire({
                    title: 'Mengupdate...',
                    text: 'Silakan tunggu...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
        });
        $.ajax({
            url: `/invakis/barang/edit_categori/post/${id_index}`,
            type: "PUT",
            data: {
                "id_categori": categoryId, 
                "categori": categoryName,
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
            setTimeout(() => {
                Swal.fire(
                            'Diupdate!',
                            response.message,
                            'success'
                        );
                // alert(response.message);
                setTimeout(() => {
                    $('#updateCategoryModal').modal('hide');
                    location.reload(); // Refresh daftar kategori atau lakukan pembaruan tampilan jika perlu
                }, 1500); // Jeda 1,5 detik (1500 ms)
            }, 1500); // Jeda 1,5 detik (1500 ms)
            },
            error: function(xhr) {
                alert(xhr.responseJSON.message);
            }
        });
    });

    $(document).on('click', '#btn-delete-categori', function() {
    let id_index = $(this).data('id');
    
    // if (confirm('Are you sure you want to delete this category?')) {
    //     $.ajax({
    //         url: `/invakis/barang/delete/${id_index}`,
    //         type: "DELETE",
    //         data: {
    //             _token: $('meta[name="csrf-token"]').attr('content')
    //         },
    //         success: function(response) {
    //             alert(response.message);
    //             location.reload(); // Refresh daftar kategori atau lakukan pembaruan tampilan jika perlu
    //         },
    //         error: function(xhr) {
    //             alert(xhr.responseJSON.message);
    //         }
    //     });
    // }

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
            // Tampilkan loading
            Swal.fire({
                    title: 'Menghapus...',
                    text: 'Silakan tunggu...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
            });
            $.ajax({
                url: `/invakis/barang/delete/${id_index}`,
            type: "DELETE",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                setTimeout(() => {
                    Swal.fire(
                            'Dihapus!',
                            'Data Anda telah dihapus.',
                            'success'
                        );
                    setTimeout(function() {
                        location.reload(); // Refresh daftar kategori atau lakukan pembaruan tampilan jika perlu
                    }, 1500); // Jeda 1,5 detik (1500 ms)
                }, 1500); // Jeda 1,5 detik (1500 ms)
                
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
});
});
      
</script>