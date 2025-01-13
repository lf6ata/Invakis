@extends('index')

@section('title','Divisi')
@section('content')

    {{-- fiture add divisi --}}
    @include('fiture.divisi_add')

    @error('divisi')
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

    <!-- DataTales Divisi -->
    <div class="card shadow mb-4">
        
            <div class="card-header py-3">
                <div class="d-flex align-items-center">
                    <div class="p-2 flex-grow-1">
                        <h6 class="m-0 font-weight-bold text-primary ">ITEM DIVISI</h6>
                    </div>
                    <div class="p-2">
                        <!-- Add Btn Divisi -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDivisi">
                            <i class="fas fa-plus fa-sm"> Add Divisi</i>
                        </button>
                    </div>
                </div>
            </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable-Divisi" width="100%" cellspacing="0">
                    <thead align="center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="50%">Divisi</th>  
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    
                        @foreach ($Divisi as $no=>$data)
                    
                            <tr>
                                <td align="center">{{ $no+1 }}</td>
                                <td>{{ $data->divisi}}</td>
                                <td width="20%" align="center">
                                    <a href="javascript:void(0)" id="btn-edit-divisi" data-id="{{ $data->id }}" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="javascript:void(0)" id="btn-delete-divisi" data-id="{{ $data->id }}" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>

                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Page Modal View Edit Divisi --}}
    @include('fiture.divisi_edit')

    <script>
    $(document).ready(function() {
        // BUTTON VIEW EDIT JENIS
        $('body').on('click', '#btn-edit-divisi', function (e) {
        
            e.preventDefault(); 

            let id_index = $(this).data('id');
            

            //fetch detail post with ajax
            $.ajax({
                url: `/Invakis/item/edit_divisi/${id_index}`,
                type: "GET",
                cache: false,
                success:function(response){
                    
                    //fill data to form
                    $('#id_index_divisi').val(response.data.id);
                    $('#divisi_update').val(response.data.divisi);

                    //open modal edit
                    $('#updateDivisiModal').modal('show');
                }
            });
        });

        // BUTTON DELETE JENIS
        $(document).on('click', '#btn-delete-divisi', function() {
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
                        url: `/Invakis/item/delete_divisi/${id_index}`,
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
