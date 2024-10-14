
    <!-- Form Edit Pegawai-->
    <div class="modal fade" id="updatePegawaiModal" tabindex="-1" role="dialog" aria-labelledby="editLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div id="pegawaiUpdateError" class="alert alert-danger d-none" role="alert"></div>

            <div id="pegawaiUpdateSuccess" class="alert alert-success d-none" role="alert"></div>

            <div class="modal-header">
                <h5 class="modal-title" id="editLabel">Edit Pegawai</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="pegawaiUpdate" enctype="multipart/form-data">

                        @csrf

                        @method('PUT')

                        <div class="form-group">
                            <p id="index_id_pegawai" hidden></p>
                            <label for="npk_edit_id">Npk Pegawai</label>
                            <input type="text" class="form-control" id="npk_edit_id" name="npk_id" placeholder="Npk Pegawai">
                                <p id="check_edit_length" class="text-danger"></p>
                        </div>


                        <div class="form-group">
                            <label for="karyawan_edit_id">Karyawan</label>
                            <input type="Text" class="form-control" id="karyawan_edit_id" name="karyawan_id" placeholder="Nama Karyawan">
                        </div>
                        
                        <div class="form-group">
                            <label for="divisi_edit_id">Divisi</label>
                            <input type="Text" class="form-control" id="divisi_edit_id" name="divisi_id" placeholder="Divisi">
                        </div>
                    </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="updatePegawaiBtn" type="button">Update</button>
            </div>
        </div>
    </div>
</div> 
<!-- End Edit Button -->

<script>

$(document).ready(function() {

    $('#npk_edit_id').change(function() {
        let id_npk = $(this).val(); // Ambil nilai NPK yang dipilih
        console.log(id_npk.length);
        
        if(parseInt(id_npk)){
            if (id_npk.length > 7) {
            // console.log("NPK tidak boleh lebih dari 7 angka");
            $('#check_edit_length').text('NPK tidak boleh lebih dari 7 angkadata');
            }
            else if (id_npk.length < 7)
            {
                // console.log("Npk tidak boleh kurang dari 7 angka");
                $('#check_edit_length').text('Npk tidak boleh kurang dari 7 angka');
            }
            else{
                $('#check_edit_length').text('');
            }
        }
        else if(id_npk == ""){
            $('#check_edit_length').text('Tidak boleh kosong');
        }
        else {
            $('#check_edit_length').text('Tidak boleh huruf');
        }
    });

   //button view modal edit pegawai and view data
   $('body').on('click', '#btn-edit-pegawai', function (e) {
        console.log("tes");
        
        e.preventDefault(); 

        let id_index_pegawai = $(this).data('id');

        //fetch detail get with ajax
        $.ajax({
            url: `/invakis/pegawai/edit/${id_index_pegawai}`,
            type: "GET",
            cache: false,
            success:function(response){

                $('#index_id_pegawai').text(response.index_karyawan.id);
                $('#npk_edit_id').val(response.index_karyawan.npk);
                $('#karyawan_edit_id').val(response.index_karyawan.nama_kr);
                $('#divisi_edit_id').val(response.index_karyawan.divisi);
                
                //open modal
                $('#updatePegawaiModal').modal('show');
            },

            error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
  
        });
    });

    // Mengupdate kategori saat tombol update diklik
    $('#updatePegawaiBtn').on('click', function() {
        // console.log("DI KLIK");
            let id_pegawai = $('#index_id_pegawai').text();
            let npk = $('#npk_edit_id').val();
            let nama = $('#karyawan_edit_id').val();
            let divisi = $('#divisi_edit_id').val();

            $.ajax({
                url: `/invakis/pegawai/update/${id_pegawai}`,
                type: "PUT",
                data: {
                    "npk": npk, 
                    "nama_kr": nama,
                    "divisi": divisi,
                    "_token": $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert(response.message);

                    $('#updateBarangModall').modal('hide');
                    window.location.href = "/invakis/pegawai/updated_at"; //lakukan pembaruan tampilan updated
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message);
                }
        });
    });
});
      
</script>