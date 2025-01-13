@extends('index')

@section('title','Merek')
@section('content')

    {{-- fiture add merek --}}
    @include('fiture.merek_add')

    @error('id_merek')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
    @enderror

    @if (session('success'))
        <script>
            Swal.fire('Sukses!', '{{ session('success') }}', 'success');
        </script>
    @elseif (@session('unsuccess'))
        <script>
            Swal.fire('Sukses!', '{{ session('unsuccess') }}', 'success');
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire('Error!', '{{ $errors->first() }}', 'error');
        </script>
    @endif

    <!-- DataTales Merek -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex align-items-center">
                <div class="p-2 flex-grow-1">
                    <h6 class="m-0 font-weight-bold text-primary ">ITEM MEREK</h6>
                </div>
                <div class="p-2">
                     <!-- Add Btn Merek -->
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMerek">
                        <i class="fas fa-plus fa-sm"> Add Merek</i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable-Merek" width="100%" cellspacing="0">
                    <thead align="center">
                        <tr>
                            <th width="5%">No</th>
                            <th>Id Merek</th>
                            <th>Merek</th>  
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    
                        @foreach ($Merek as $no=>$data)
                    
                            <tr>
                                <td align="center">{{ $no+1 }}</td>
                                <td>{{ sprintf('%02d',$data->id_merek)}}</td>
                                <td>{{ ucfirst($data->merek) }}</td>
                                <td width="20%" align="center">
                                    <a href="javascript:void(0)" id="btn-edit-merek" data-id="{{ $data->id }}" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="javascript:void(0)" id="btn-delete-merek" data-id="{{ $data->id }}" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>

                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Page Modal View Edit Merek --}}
    @include('fiture.merek_edit')

    <script>
    $(document).ready(function() {
        // BUTTON VIEW EDIT JENIS
        $('body').on('click', '#btn-edit-merek', function (e) {
        
            e.preventDefault(); 

            let id_index = $(this).data('id');
            

            //fetch detail post with ajax
            $.ajax({
                url: `/Invakis/item/edit_merek/${id_index}`,
                type: "GET",
                cache: false,
                success:function(response){

                    let idMerek = response.data.id_merek < 10 ? '0'+response.data.id_merek : response.data.id_merek;
                    
                    //fill data to form
                    $('#id_index_merek').val(response.data.id);
                    $('#id_merek_update').val(idMerek);
                    $('#merek_update').val(response.data.merek);

                    //open modal edit
                    $('#updateMerekModal').modal('show');
                }
            });
        });

        // BUTTON DELETE JENIS
        $(document).on('click', '#btn-delete-merek', function() {
            let id_index = $(this).data('id');
            console.log(id_index);
            

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
                    // Tampilkan loading
                    Swal.fire({
                            title: 'Menghapus...',
                            text: 'Silakan tunggu...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                    });
                    $.ajax({
                        url: `/Invakis/item/delete_merek/${id_index}`,
                        type: "DELETE",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                                setTimeout(() => {
                                    Swal.fire(
                                            'Dihapus!',
                                            response.message,
                                            'success'
                                        );
                                    setTimeout(function() {
                                        location.reload(); // Refresh daftar kategori atau lakukan pembaruan tampilan jika perlu
                                    }, 1000); // Jeda 1,5 detik (1500 ms)
                                }, 1000); // Jeda 1,5 detik (1500 ms)
                                
                            },
                        error: function(xhr) {
                            Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus data.'+xhr.error,
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
