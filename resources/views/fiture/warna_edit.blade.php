<!-- Form Edit Warna-->
<div class="modal fade" id="updateWarnaModal" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            @error('id_warna')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror

            <div class="modal-header">
                <h5 class="modal-title" id="editLabel">Edit Warna</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    @csrf
                    <input type="number" id="id_index_warna" hidden>
                    <div class="form-group">
                    <label for="id_warna_update">Id Warna</label>
                    <input type="text" class="form-control" id="id_warna_update" name="id_warna" placeholder="Id Warna" maxlength="2">
                    </div>

                    <div class="form-group">
                    <label for="warna_update">Warna</label>
                    <input type="Text" class="form-control" id="warna_update" name="warna" placeholder="Warna">
                    </div>
                </form>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="button" id="warnaUpdateBtn">Update</a>
                </div>
            </div>
        </div>
    </div>
</div> 

<script>
    $(document).ready(function() {
        // Mengupdate kategori saat tombol update diklik
        $('#warnaUpdateBtn').on('click', function() {
            let id_index = $('#id_index_warna').val();
            let warnaId = $('#id_warna_update').val();
            let warnaName = $('#warna_update').val();
            
            
            Swal.fire({
                        title: 'Mengupdate...',
                        text: 'Silakan tunggu...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
            });
            $.ajax({
                url: `/Invakis/item/update_warna/${id_index}`,
                type: "PUT",
                data: {
                    "id_warna": warnaId, 
                    "warna": warnaName,
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
                        $('#updateWarnaModal').modal('hide');
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