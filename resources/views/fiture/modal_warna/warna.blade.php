
    <!-- Form Warna-->
    <div class="modal fade" id="addWarna" tabindex="-1" role="dialog" aria-labelledby="addLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div id="warnaAddError" class="alert alert-danger d-none" role="alert"></div>

            <div id="warnaaddSuccess" class="alert alert-success d-none" role="alert"></div>

            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">Add Warna</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body ">

                <form id="inputWarna">

                    @csrf

                    <input hidden type="number" id="id_index_warna">
                    <div class="form-group">
                      <label for="id_warna">Id Warna</label>
                      <input type="text" class="form-control" id="idwarnaAdd" name="id_warna" placeholder="Id Warna" maxlength="2">
                                @error('id_warna')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                    </div>

                    <div class="form-group">
                      <label for="warnaAdd">Jenis</label>
                      <input type="Text" class="form-control" id="warnaAdd" name="warna" placeholder="Warna">
                    </div>
                    
                    {{-- Message Error --}}
                    <div id="error-message" class="text-danger"></div>

                    {{-- Button Warna --}}
                    <div class="d-flex flex-row-reverse">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus fa-sm" id="btn-add-warna"> Add</i>
                        </button>
                        <button type="button" class="btn btn-warning mr-2 ">
                            <i class="fas fa-edit" id="btn-update-warna"> Update</i>
                        </button>
                    </div>

                </form>
            </div>

            <div class="modal-footer" id="TableWarna">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable-Warna" width="100%" cellspacing="0">
                            <thead align="center">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Id Warna</th>
                                    <th>Warna</th>  
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data akan dimuat melalui AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<script>
    $(document).ready(function(){
        
        //Menampilkan Data Tables;
        var table = $('#dataTable-Warna').DataTable({
            processing: false,
            serverSide: true,
            aaSorting:[[1,"desc"]],
            ajax:{
                url:"{{ route('page.warna') }}",
                type: 'GET'
            },
            lengthMenu: [5,10,50,100],
            columns: [
                {data: 'DT_RowIndex', neme: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'id_warna', neme: 'id_warna'},
                {data: 'warna', neme: 'warna'},
                {
                    data: 'id',  // Kolom ini bisa diisi dengan ID atau data lain
                    name: 'action',
                    orderable: false,  // Nonaktifkan sorting untuk kolom action
                    searchable: false, // Nonaktifkan searching untuk kolom action
                    render: function(data, type, row, meta) {
                        // 'data' di sini mengacu pada ID warna, bisa digunakan untuk mengisi URL
                        return `
                            <a href="javascript:void(0)" id="btnUpdate-warna" data-id="${data}" class="btn btn-sm btn-primary"><i class="fas fa-edit"> </i></a>
                            <a href="javascript:void(0)" id="btnDelete-warna" data-id="${data}" class="btn btn-sm btn-danger"><i class="fas fa-trash"> </i></a>
                        `;
                        }
                    }
                ],
                createdRow: function(row, data) {
                    //  menambahkan atribut ke <td> tertentu
                    $(row).find('td:eq(3)').attr('width', '20%'); // Menambahkan atribut width
                    $(row).find('td:eq(3)').attr('align', 'center'); // Menambahkan atribut align

                    $(row).find('td:eq(0)').attr('align', 'center'); // Menambahkan atribut align
                }
        });
    });

    $('#inputWarna').on('submit', function(e) {
      e.preventDefault();  // Mencegah form dikirim secara tradisional
      //console.log($(this).serialize());

      // Reset error message
      $('#error-message').text('');

      $.ajax({
        type: 'POST',
        url: '{{ route("store.warna") }}',  // Route di Laravel
        data: $(this).serialize(),
        success: function(response) {
          if(response.success) {
            alert('Data berhasil disimpan!');
            $('#dataTable-Warna').DataTable().ajax.reload();  // Reload tabel setelah di input
          }
        },
        error: function(xhr) {
          $('#error-message').text("Ada kesalahan"); // Menampilkan pesan error dari server (validasi gagal)
        }
      });
    });


    $('#dataTable-Warna').on('click', '#btnDelete-warna', function (e) {
        e.preventDefault(); 

        let warna_id = $(this).data('id');
    
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
                url: `/invakis/delete_warna/${warna_id})`,  // URL untuk menghapus data
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')  // Laravel CSRF token
                },
                success: function(response) {
                setTimeout(() => {
                    
                    Swal.fire(
                        'Dihapus!',
                        'Data Anda telah dihapus.',
                        'success'
                    );

                    // setTimeout(function() {
                        $('#dataTable-Warna').DataTable().ajax.reload();  // Reload tabel setelah delete
                    // }, 1500); // Jeda 1,5 detik (1500 ms)
                }, 1500); // Jeda 1,5 detik (1500 ms)
                    
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

    $('body').on('click', '#btnUpdate-warna', function (e) {
        
        e.preventDefault(); 
        // console.log("masuk");

        let id_warna = $(this).data('id');

        //fetch detail post with ajax
        $.ajax({
            url: `/invakis/edit_warna/${id_warna}`,
            type: "GET",
            cache: false,
            success:function(response){
                
                //fill data to form
                $('#id_index_warna').val(response.data.id);
                $('#idwarnaAdd').val(response.data.id_warna);
                $('#warnaAdd').val(response.data.warna);
            }
        });
    });

    // Mengupdate warna saat tombol update diklik
    $('#btn-update-warna').on('click', function() {
        
        let id_index= $('#id_index_warna').val();
        let warnaId = $('#idwarnaAdd').val();
        let warnaName = $('#warnaAdd').val();

        $.ajax({
            url: `/invakis/update_warna/${id_index}`,
            type: "PUT",
            data: {
                "id_warna": warnaId, 
                "warna": warnaName,
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.message);
                $('#dataTable-Warna').DataTable().ajax.reload();  // Reload tabel setelah update
            },
            error: function(xhr) {
                alert(xhr.responseJSON.message);
            }
        });
    });

</script>


<!-- End Add Warna -->
