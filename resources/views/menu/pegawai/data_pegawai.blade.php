@extends('index')

@section('title','Pegawai')
@section('content')

        <!-- Form Add Pegawai-->
        <div class="modal fade" id="addPegawai" tabindex="-1" role="dialog" aria-labelledby="addLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLabel">Add Pegawai</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ Route('store.pegawai') }}" method="POST" enctype="multipart/form-data">
                            
                            @csrf

                            <div class="form-group">
                                <label for="npkAdd">Npk Pegawai</label>
                                <input type="text" class="form-control" id="npk_id" name="npk_id" placeholder="Npk Pegawai">
                                    <p id="check_length" class="text-danger"></p>
                            </div>


                            <div class="form-group">
                                <label for="karyawan_id">Karyawan</label>
                                <input type="Text" class="form-control" id="karyawan_id" name="karyawan_id" placeholder="Nama Karyawan">
                            </div>
                            
                            <div class="form-group">
                                <label for="divisi_id">Divisi</label>
                                <input type="Text" class="form-control" id="divisi_id" name="divisi_id" placeholder="Divisi">
                            </div>


                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit">Add</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div> 
    <!-- End Add Button -->
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="d-flex align-items-center">
                                    <div class="p-2 flex-grow-1">
                                        <h6 class="m-0 font-weight-bold text-primary ">Data Pegawai</h6>
                                    </div>
                                    <div class="p-2">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPegawai">
                                            <i class="fas fa-plus fa-sm"></i> Add Pegawai
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width=5%>No</th>
                                                <th width=10%>Npk</th> 
                                                <th>Nama Karyawan</th> 
                                                <th>Divisi</th> 
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            @foreach($get_pegawai as $no=>$p)
                                                <tr id="row-{{ $p->id }}">
                                                    <td>{{ $no+1 }}</td>
                                                    <td>{{ $p->npk }}</td>
                                                    <td>{{ $p->nama_kr  }}</td>
                                                    <td>{{ $p->divisi  }}</td>
                                                    <td align="center">
                                                        <a href="javascript:void(0)" id="btn-edit-pegawai" data-id="{{ $p->id }}" class="btn btn-sm btn-warning">Edit</a>
                                                        <a href="javascript:void(0)" id="btn-delete-pegawai" data-id="{{ $p->id }}" class="btn btn-sm btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
    </div>

@include('fiture.modal_pegawai.update_pegawai')
<script>
$(document).ready(function() {
    $('#npk_id').change(function() {
        let id_npk = $(this).val(); // Ambil nilai NPK yang dipilih
     
        if(parseInt(id_npk)){
            if (id_npk.length > 7) {
            // console.log("NPK tidak boleh lebih dari 7 angka");
            $('#check_length').text('NPK tidak boleh lebih dari 7 angkadata');
            }
            else if (id_npk.length < 7)
            {
                // console.log("Npk tidak boleh kurang dari 7 angka");
                $('#check_length').text('Npk tidak boleh kurang dari 7 angka');
            }
            else{
                $('#check_length').text('');
            }
        }
        else if(id_npk == ""){
            $('#check_length').text('');
        }
        else {
            $('#check_length').text('Tidak boleh huruf');
        }
    });

    $(document).on('click', '#btn-delete-pegawai', function() {
        let pegawaiId = $(this).data('id');

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
            $.ajax({
                url: `/invakis/pegawai/delete_pegawai/${pegawaiId}`,
                type: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire(
                        'Dihapus!',
                        'Data Anda telah dihapus.',
                        'success'
                    );
                    setTimeout(function() {

                        location.reload(); // Refresh daftar pegawai atau lakukan pembaruan tampilan jika perlu
                        
                    }, 3000); // Jeda 1,5 detik (1500 ms)
                    
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
    
@endsection