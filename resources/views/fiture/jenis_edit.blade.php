<!-- Form Edit Jenis-->
<div class="modal fade" id="updateJenisModal" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            @error('id_jenis')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror

            <div class="modal-header">
                <h5 class="modal-title" id="editLabel">Edit Jenis</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    @csrf
                    <input type="number" id="id_index_jenis" hidden>
                    <div class="form-group">
                    <label for="id_jenis_update">Id Jenis</label>
                    <input type="text" class="form-control" id="id_jenis_update" name="id_jenis" placeholder="Id Jenis" maxlength="2">
                    </div>

                    <div class="form-group">
                    <label for="jenis_update">Jenis</label>
                    <input type="Text" class="form-control" id="jenis_update" name="jenis" placeholder="Jenis">
                    </div>
                </form>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="button" id="jenisUpdateBtn">Update</a>
                </div>
            </div>
        </div>
    </div>
</div> 

<script>
    $(document).ready(function() {
        // Mengupdate kategori saat tombol update diklik
        $('#jenisUpdateBtn').on('click', function() {
            let id_index = $('#id_index_jenis').val();
            let jenisId = $('#id_jenis_update').val();
            let jenisName = $('#jenis_update').val();
            
            
            Swal.fire({
                        title: 'Mengupdate...',
                        text: 'Silakan tunggu...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
            });
            $.ajax({
                url: `/Invakis/item/update_jenis/${id_index}`,
                type: "PUT",
                data: {
                    "id_jenis": jenisId, 
                    "jenis": jenisName,
                    "_token": $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                setTimeout(() => {
                    Swal.fire(
                                'Diupdate!',
                                response.message,
                                'success'
                            );
                    setTimeout(() => {
                        $('#updateJenisModal').modal('hide');
                        location.reload(); // Refresh daftar kategori atau lakukan pembaruan tampilan jika perlu
                    }, 1000); // Jeda 1,5 detik (1500 ms)
                }, 1000); // Jeda 1,5 detik (1500 ms)
                },
                error: function(xhr) {
                    Swal.fire(
                            'Gagal!',
                            xhr.responseJSON.message,
                            'error'
                    );
                }
            });
        });
    });
</script>

<!-- End Edit Button -->