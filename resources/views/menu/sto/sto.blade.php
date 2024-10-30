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
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            @foreach($index_sto as $no=>$s)
                                                <tr>
                                                    <td>{{ $no+1 }}</td>
                                                    <td>{{ $s->tgl_sto }}</td>
                                                    <td>{{ $s->no_asset }}</td>
                                                    <td> 
                                                        <span @if ($s->status == "Sangat Layak")
                                                            class="badge badge-primary"
                                                        @elseif ($s->status == "Cukup Layak")
                                                            class="badge badge-success"
                                                        @elseif ($s->status == "Layak Pakai")
                                                            class="badge badge-warning"
                                                        @elseif ($s->status == "Rusak")
                                                            class="badge badge-danger"
                                                        @endif >
                                                            {{ $s->status }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $s->tgl_save_sto }}</td>
                                                    <td>{{ $s->user }}</td>
                                                    {{-- <td align="center">
                                                        <form method="GET" action="{{ route('edit.sto','02-AA-01-AA-001') }}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-warning" >update</button>
                                                        </form>
                                                    </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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