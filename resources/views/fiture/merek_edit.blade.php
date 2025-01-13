<!-- Form Edit Merek-->
<div class="modal fade" id="updateMerekModal" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            @error('id_merek')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror

            <div class="modal-header">
                <h5 class="modal-title" id="editLabel">Edit Merek</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    @csrf
                    <input type="number" id="id_index_merek" hidden>
                    <div class="form-group">
                    <label for="id_merek_update">Id Merek</label>
                    <input type="number" class="form-control" id="id_merek_update" name="id_merek" placeholder="Id Merek" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;">
                    </div>

                    <div class="form-group">
                    <label for="merek_update">Merek</label>
                    <input type="Text" class="form-control" id="merek_update" name="merek" placeholder="Merek">
                    </div>
                </form>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="button" id="merekUpdateBtn">Update</a>
                </div>
            </div>
        </div>
    </div>
</div> 

<script>
    $(document).ready(function() {
        // Mengupdate kategori saat tombol update diklik
        $('#merekUpdateBtn').on('click', function() {
            let id_index = $('#id_index_merek').val();
            let merekId = $('#id_merek_update').val();
            let merekName = $('#merek_update').val();
            
            
            Swal.fire({
                        title: 'Mengupdate...',
                        text: 'Silakan tunggu...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
            });
            $.ajax({
                url: `/Invakis/item/update_merek/${id_index}`,
                type: "PUT",
                data: {
                    "id_merek": merekId, 
                    "merek": merekName,
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
                        $('#updateMerekModal').modal('hide');
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