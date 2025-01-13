<!-- Form Edit Lokasi-->
<div class="modal fade" id="updateLokasiModal" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            @error('lokasi')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror

            <div class="modal-header">
                <h5 class="modal-title" id="editLabel">Edit Lokasi</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    @csrf
                    <input type="number" id="id_index_lokasi" hidden>

                    <div class="form-group">
                        <label for="lokasi_update">Lokasi</label>
                        <input type="Text" class="form-control" id="lokasi_update" name="lokasi" placeholder="Lokasi">
                    </div>
                </form>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="button" id="lokasiUpdateBtn">Update</a>
                </div>
            </div>
        </div>
    </div>
</div> 

<script>
    $(document).ready(function() {
        // Mengupdate kategori saat tombol update diklik
        $('#lokasiUpdateBtn').on('click', function() {
            let id_index = $('#id_index_lokasi').val();
            let lokasiName = $('#lokasi_update').val();
            
            
            Swal.fire({
                        title: 'Mengupdate...',
                        text: 'Silakan tunggu...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
            });
            $.ajax({
                url: `/Invakis/item/update_lokasi/${id_index}`,
                type: "PUT",
                data: {
                    "lokasi": lokasiName,
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
                        $('#updateLokasiModal').modal('hide');
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