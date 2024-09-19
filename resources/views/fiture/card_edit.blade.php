
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

    //button create post event
    
    $(document).ready(function () {
    $('#categoriUpdate').on('click', '#btn-edit-categori', function () {
        console.log('sukses');
    
        });
    });
        
        //$('#updateCategoriModal').modal('show');
        // let post_id = $(this).data('id');

        // //fetch detail post with ajax
        // $.ajax({
        //     url: `/invakis/barang/edit_categori/${post_id}`,
        //     type: "GET",
        //     cache: false,
        //     success:function(response){

        //         //fill data to form
        //         $('#idcategoriUpdate').val(response.data.id_categori);
        //         $('#categoriUpdate').val(response.data.categori);

        //         //open modal
        //         $('#updateCategoriModal').modal('show');
        //     }
        // });
    // });
      
</script>