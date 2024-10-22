
    <!-- Form Edit Useri-->
    <div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="editLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="editLabel">Edit User</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="userUpdate" enctype="multipart/form-data">

                        @csrf

                        @method('PUT')

                        <div class="form-group">
                            <p id="index_id_user" hidden></p>
                            <label for="nama_edit">Nama</label>
                            <input type="text" class="form-control" id="nama_edit" name="nama_edit" placeholder="Nama">
                                <p id="check_edit_length" class="text-danger"></p>
                        </div>


                        <div class="form-group">
                            <label for="email_edit">Email</label>
                            <input type="Text" class="form-control" id="email_edit" name="email_edit" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select name="role_edit_id" id="role_edit_id" class="form-control" required>
                              <option value="">--- Pilih Role ---</option>
                            </select>
                        </div>
                        
                    </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="updateUserBtn" type="button">Update</button>
            </div>
        </div>
    </div>
</div> 
<!-- End Edit Button -->

<script>

$(document).ready(function() {

    // $('#email_edit').change(function() {
    //     let id_email_edit = $(this).val(); // Ambil nilai NPK yang dipilih
    //     console.log(id_email_edit.length);
        
    //     if(parseInt(id_email_edit)){
    //         if (id_email_edit.length > 7) {
    //         // console.log("NPK tidak boleh lebih dari 7 angka");
    //         $('#check_edit_length').text('NPK tidak boleh lebih dari 7 angkadata');
    //         }
    //         else if (id_email_edit.length < 7)
    //         {
    //             // console.log("Npk tidak boleh kurang dari 7 angka");
    //             $('#check_edit_length').text('Npk tidak boleh kurang dari 7 angka');
    //         }
    //         else{
    //             $('#check_edit_length').text('');
    //         }
    //     }
    //     else if(id_email_edit == ""){
    //         $('#check_edit_length').text('Tidak boleh kosong');
    //     }
    //     else {
    //         $('#check_edit_length').text('Tidak boleh huruf');
    //     }
    // });

   //button view modal edit pegawai and view data
   $('body').on('click', '#btn-edit-user', function (e) {
        
        e.preventDefault(); 

        let id_index_user = $(this).data('id');

        //fetch detail get with ajax
        $.ajax({
            url: `/Invakis/user/edit/${id_index_user}`,
            type: "GET",
            cache: false,
            success:function(response){

                $('#index_id_user').text(response.index_user.id);

                 // Mengisi select dengan role
                const roleSelect = $('#role_edit_id');
                roleSelect.empty().append('<option value="">-- Pilih Role --</option>'); //mengosongkan dan menginisialisasikan form select utama
                response.roles.forEach(role => {

                        roleSelect.append(`<option value="${role.name.name}" ${role.isSelected ? 'selected' : ''}>${role.name.name}</option>`);
                        
                });
                

                $('#nama_edit').val(response.index_user.name);
                $('#email_edit').val(response.index_user.email);
                
                //open modal
                $('#updateUserModal').modal('show');
            },

            error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
  
        });
    });

    // Mengupdate kategori saat tombol update diklik
    $('#updateUserBtn').on('click', function(e) {
            e.preventDefault();

            let id_index_user = $('#index_id_user').text();
            let nama_edit = $('#nama_edit').val();
            let email_edit = $('#email_edit').val();
            let role_edit = $('#role_edit_id').val();

            $.ajax({
                url: `/Invakis/user/update/${id_index_user}`,
                type: "PUT",
                data: {
                    "nama_edit": nama_edit, 
                    "email_edit": email_edit,
                    "role_edit" : role_edit,
                    "_token": $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    
                    alert(response.success);

                    $('#updateUserModal').modal('hide');
                    location.reload();
                    
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message);
                }
        });
    });
});
      
</script>