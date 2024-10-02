
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

                    <div class="form-group">
                      <label for="idcategoriUpdate">Id Categori</label>
                      <input type="number" id="id_index_categori">
                      <input type="Text" class="form-control" id="idcategoriUpdate" name="id_categori" placeholder="Id Categori">
                    </div>

                    <div class="form-group">
                      <label for="categoriUpdate">Categori</label>
                      <input type="Text" class="form-control" id="categoriUpdate" name="categori" placeholder="Categori">
                    </div>
                
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="button" id="categoriUpdateBtn">Save</a>
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

        $.ajax({
            url: `/invakis/barang/edit_categori/post/${id_index}`,
            type: "PUT",
            data: {
                "id_categori": categoryId, 
                "categori": categoryName,
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.message);
                $('#updateCategoryModal').modal('hide');
                location.reload(); // Refresh daftar kategori atau lakukan pembaruan tampilan jika perlu
            },
            error: function(xhr) {
                alert(xhr.responseJSON.message);
            }
        });
    });

    $(document).on('click', '#btn-delete-categori', function() {
    let id_index = $(this).data('id');
    // console.log(typeof(categoryId)+categoryId);
    if (confirm('Are you sure you want to delete this category?')) {
        $.ajax({
            url: `/invakis/barang/delete/${id_index}`,
            type: "DELETE",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.message);
                location.reload(); // Refresh daftar kategori atau lakukan pembaruan tampilan jika perlu
            },
            error: function(xhr) {
                alert(xhr.responseJSON.message);
            }
        });
    }
});
});
      
</script>