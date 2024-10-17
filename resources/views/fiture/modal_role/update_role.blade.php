
    <!-- Form Edit Rolei-->
    <div class="modal fade" id="updateRoleModal" tabindex="-1" role="dialog" aria-labelledby="editLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="editLabel">Edit Role</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="userUpdate" enctype="multipart/form-data">

                        @csrf

                        @method('PUT')

                        <div class="form-group">
                            <p id="index_id_role" hidden></p>
                            <label for="role_edit">Nama Role</label>
                            <input type="text" class="form-control" id="role_edit" name="role_edit" placeholder="Nama Role">
                                <p id="check_edit_length" class="text-danger"></p>
                        </div>
                        
                    </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="updateRoleBtn" type="button">Update</button>
            </div>
        </div>
    </div>
</div> 
<!-- End Edit Button -->

<script>

$(document).ready(function() {


   //button view modal edit role and view data
   $('body').on('click', '#btn-edit-role', function (e) {
        console.log("tes");
        
        e.preventDefault(); 

        let id_index_role = $(this).data('id');

        //fetch detail get with ajax
        $.ajax({
            url: `/invakis/role/edit/${id_index_role}`,
            type: "GET",
            cache: false,
            success:function(response){

                $('#index_id_role').text(response.index_role.id);
                $('#role_edit').val(response.index_role.name);
                
                //open modal
                $('#updateRoleModal').modal('show');
            },

            error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
  
        });
    });

    // Mengupdate role saat tombol update diklik
    $('#updateRoleBtn').on('click', function(e) {
            e.preventDefault();

            let id_index_role = $('#index_id_role').text();
            let role_edit = $('#role_edit').val();

            $.ajax({
                url: `/invakis/role/update/${id_index_role}`,
                type: "PUT",
                data: {
                    "role_edit": role_edit, 
                    "_token": $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    
                    alert(response.success);

                    $('#updateRoleModal').modal('hide');
                    location.reload();
                    
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message);
                }
        });
    });
});
      
</script>