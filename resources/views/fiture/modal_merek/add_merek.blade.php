
    <!-- Form Add Jenis-->
    <div class="modal fade" id="addMerek" tabindex="-1" role="dialog" aria-labelledby="addLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div id="merekAddError" class="alert alert-danger d-none" role="alert"></div>

            <div id="merekaddSuccess" class="alert alert-success d-none" role="alert"></div>

            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">Add Merek</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body ">

                <form id="inputMerek">

                    @csrf

                    <div class="form-group">
                      <label for="idmerekAdd">Id Merek</label>
                      <input hidden type="number" id="id_index_merek">
                      <input type="Number" class="form-control" id="idmerekAdd" name="id_merek" placeholder="Id Merek" maxlength="2" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==this.maxLength) return false;">
                                @error('id_merek')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                    </div>

                    <div class="form-group">
                      <label for="merekAdd">Jenis</label>
                      <input type="Text" class="form-control" id="merekAdd" name="merek" placeholder="Merek">
                    </div>
                    
                    {{-- Message Error --}}
                    <div id="error-message" class="text-danger"></div>

                    {{-- Button Add Jenis --}}
                    <div class="d-flex flex-row-reverse">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus fa-sm" id="btn-add-merek"> Add</i>
                        </button>
                        <button type="button" class="btn btn-warning mr-2 ">
                            <i class="fas fa-sm" id="btn-update-merek"> Update</i>
                        </button>
                    </div>

                </form>
            </div>

            <div class="modal-footer" id="TableMerek">
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
    // swalInstance = Swal.fire({
    //                 title: 'Loading...',
    //                 text: 'Silakan tunggu...',
    //                 allowOutsideClick: false,
    //                 didOpen: () => {
    //                     Swal.showLoading();
    //                 }
    //             });
    $(document).ready(function(){
        
        // setTimeout(() => {
        //     swalInstance.close();            
        // }, 1500); // Jeda 1,5 detik (1500 ms)
        //Menampilkan Data Tables;
        var table = $('#dataTable-Merek').DataTable({
            processing: false,
            serverSide: true,
            aaSorting:[[1,"desc"]],
            ajax:{
                url:"{{ route('merek.get') }}",
                type: 'GET'
            },
            lengthMenu: [5,10,50,100],
            columns: [
                {data: 'DT_RowIndex', neme: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'id_merek', neme: 'id merek'},
                {data: 'merek', neme: 'merek'},
                {
                    data: 'id',  // Kolom ini bisa diisi dengan ID atau data lain
                    name: 'action',
                    orderable: false,  // Nonaktifkan sorting untuk kolom action
                    searchable: false, // Nonaktifkan searching untuk kolom action
                    render: function(data, type, row, meta) {
                        // 'data' di sini mengacu pada ID kategori, bisa digunakan untuk mengisi URL
                        return `
                            <a href="javascript:void(0)" id="btnUpdate-merek" data-id="${data}" class="btn btn-sm btn-primary"><i class="fas fa-edit"> </i></a>
                            <a href="javascript:void(0)" id="btnDelete-merek" data-id="${data}" class="btn btn-sm btn-danger"><i class="fas fa-trash"> </i></a>
                        `;
                        }
                }
                ],
                createdRow: function(row, data) {
                    // menambahkan atribut ke <td> tertentu
                    $(row).find('td:eq(3)').attr('width', '20%'); // Menambahkan atribut data-info
                    $(row).find('td:eq(3)').attr('align', 'center'); // Menambahkan atribut data-info

                    $(row).find('td:eq(0)').attr('align', 'center'); // Menambahkan atribut align
                }
        });
    });

    $('#inputMerek').on('submit', function(e) {
      e.preventDefault();  // Mencegah form dikirim secara tradisional
      //console.log($(this).serialize());
      
      // Reset error message
      $('#error-message').text('');

      $.ajax({
        type: 'POST',
        url: '{{ route("store.merek") }}',  // Route di Laravel
        data: $(this).serialize(),
        success: function(response) {
          if(response.success) {
            alert('Data berhasil disimpan!');
            $('#dataTable-Merek').DataTable().ajax.reload();  // Reload tabel setelah di input
            //$('#addJenis').modal('hide');  // Tutup modal
          }
        },
        error: function(xhr) {
          // Menampilkan pesan error dari server (validasi gagal)
          $('#error-message').text("Ada kesalahan");
        }
      });
    });


    $('#dataTable-Merek').on('click', '#btnDelete-merek', function (e) {
        e.preventDefault(); 

        let merek_id = $(this).data('id');
        // console.log(typeof(jenis_id));
        // console.log("Fungsi deleteCategory dipanggil untuk id: "+ jenis_id);
    
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
                url: `/invakis/delete/merek/${merek_id}`,  // URL untuk menghapus data
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
                        $('#dataTable-Merek').DataTable().ajax.reload();  // Reload tabel setelah delete
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

    $('body').on('click', '#btnUpdate-merek', function (e) {
        
        e.preventDefault(); 
        // console.log("masuk");
        

        let id_merek = $(this).data('id');

        //fetch detail post with ajax
        $.ajax({
            url: `/invakis/edit/${id_merek}`,
            type: "GET",
            cache: false,
            success:function(response){
                let idMerek = response.data.id_merek < 10 ? '0'+response.data.id_merek : response.data.id_merek;
                //fill data to form
                $('#id_index_merek').val(response.data.id);
                $('#idmerekAdd').val(idMerek);
                $('#merekAdd').val(response.data.merek);

                // //open modal
                // $('#updateCategoriModal').modal('show');
            }
        });
    });

    // Mengupdate kategori saat tombol update diklik
    $('#btn-update-merek').on('click', function() {
        // console.log("DI KLIK");
        
        let id_index= $('#id_index_merek').val();
        let merekId = $('#idmerekAdd').val();
        let merekName = $('#merekAdd').val();

        $.ajax({
            url: `/invakis/update/${id_index}`,
            type: "PUT",
            data: {
                "id_merek": merekId, 
                "merek": merekName,
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.message);
                $('#dataTable-Merek').DataTable().ajax.reload();  // Reload tabel setelah update
            },
            error: function(xhr) {
                alert(xhr.responseJSON.message);
            }
        });
    });
 
</script>


<!-- End Add Merek -->
