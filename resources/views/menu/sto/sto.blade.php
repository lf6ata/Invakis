@extends('index')

@section('title','Stock Opname')
@section('content')

    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="d-flex align-items-center">
                                    <div class="p-2 flex-grow-1">
                                        <h6 class="m-0 font-weight-bold text-primary ">Data STO</h6>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width=5%>No</th>
                                                <th width=10%>Tgl Sto</th> 
                                                <th>No Asset</th> 
                                                <th>Status</th> 
                                                <th>Tgl Save Sto</th>
                                                <th>User</th> 
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            {{-- @foreach($tb_sto as $no=>$s) --}}
                                                <tr>
                                                    <td>1</td>
                                                    <td>10-10-2024</td>
                                                    <td>AA-01-AB-02</td>
                                                    <td> <span class="badge badge-primary">Sangat Layak</span></td>
                                                    <td>17-10-2024</td>
                                                    <td></td>
                                                    <td align="center">
                                                        <form method="GET" action="{{ route('edit.sto','31-SA-21-1') }}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-warning" >update</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            {{-- @endforeach --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex align-items-center">
                <div class="p-2 flex-grow-1">
                    <h6 class="m-0 font-weight-bold text-primary ">Data STO</h6>
                </div>
                
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width=5%>No</th>
                            <th width=10%>Tgl Sto</th> 
                            <th>No Asset</th> 
                            <th>Status</th> 
                            <th>Tgl Save Sto</th>
                            <th>User</th> 
                            <th>Action</th>
                        </tr>
                    </thead>
                   
                    <tbody>
                        {{-- @foreach($tb_sto as $no=>$s) --}}
                            <tr>
                                <td>1</td>
                                <td>10-10-2024</td>
                                <td>AA-01-AB-02</td>
                                <td> <span class="badge badge-primary">Sangat Layak</span></td>
                                <td>17-10-2024</td>
                                <td></td>
                                <td align="center">
                                    <form method="GET" action="{{ route('edit.sto','31-SA-21-1') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning" >update</button>
                                    </form>
                                </td>
                            </tr>
                        {{-- @endforeach --}}
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

    if (confirm('Are you sure you want to delete this pegawai?')) {
        $.ajax({
                url: `/invakis/pegawai/delete_pegawai/${pegawaiId}`,
                type: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert(response.message);
                    
                    location.reload(); // Refresh daftar pegawai atau lakukan pembaruan tampilan jika perlu
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message);
                }
            });
        }
    });
});
</script>
    
@endsection