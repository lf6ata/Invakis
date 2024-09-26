
    <!-- Form Add Jenis-->
    <div class="modal fade" id="addJenis" tabindex="-1" role="dialog" aria-labelledby="addLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div id="jenisAddError" class="alert alert-danger d-none" role="alert"></div>

            <div id="jenisaddSuccess" class="alert alert-success d-none" role="alert"></div>

            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">Add Jenis</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body ">

                <form id="inputJenis">

                    @csrf

                    <div class="form-group">
                      <label for="idjenisAdd">Id Jenis</label>
                      <input type="Text" class="form-control" id="idjenisAdd" name="id_jenis" placeholder="Id Jenis">
                        <span style="color: red; font-size:13px;">form value harus di isi dengan 2 charcter, contoh : AA</span>
                    </div>

                    <div class="form-group">
                      <label for="jenisAdd">Jenis</label>
                      <input type="Text" class="form-control" id="jenisAdd" name="jenis" placeholder="Jenis">
                    </div>
                    
                    {{-- Message Error --}}
                    <div id="error-message" class="text-danger"></div>

                    {{-- Button Add Jenis --}}
                    <div class="d-flex flex-row-reverse">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus fa-sm" id="btn-add-jenis"> Add</i>
                        </button>
                        <button type="button" class="btn btn-warning mr-2 ">
                            <i class="fas fa-sm" id="btn-update-jenis"> Update</i>
                        </button>
                    </div>

                </form>
            </div>

            <div class="modal-footer" id="TableJenis">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable-Jenis" width="100%" cellspacing="0">
                            <thead align="center">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Id Jenis</th>
                                    <th>Jenis</th>  
                                    <th>Action</th>
                                </tr>
                            </thead>
                                <!-- Data akan dimuat melalui AJAX -->
                            <tbody>
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
        var table = $('#dataTable-Jenis').DataTable({
            processing: false,
            serverSide: true,
            aaSorting:[[0,"desc"]],
            ajax:{
                url:"{{ route('jenis.get') }}",
                type: 'GET'
            },
            columns: [
                {data: 'DT_RowIndex', neme: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'id_jenis', neme: 'id_jenis'},
                {data: 'jenis', neme: 'jenis'},
                {
                    data: 'id_jenis',  // Kolom ini bisa diisi dengan ID atau data lain
                    name: 'action',
                    orderable: false,  // Nonaktifkan sorting untuk kolom action
                    searchable: false, // Nonaktifkan searching untuk kolom action
                    render: function(data, type, row, meta) {
                        // 'data' di sini mengacu pada ID kategori, bisa digunakan untuk mengisi URL
                        return `
                            <a href="javascript:void(0)" id="btnUpdate" data-id="${data}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="javascript:void(0)" id="btnDelete" data-id="${data}" class="btn btn-sm btn-danger">Delete</a>
                        `;
                        }
                    }
                ]
        });
    });

    $('#inputJenis').on('submit', function(e) {
      e.preventDefault();  // Mencegah form dikirim secara tradisional
      //console.log($(this).serialize());
      
      // Reset error message
      $('#error-message').text('');

      $.ajax({
        type: 'POST',
        url: '{{ route("create.jenis") }}',  // Route di Laravel
        data: $(this).serialize(),
        success: function(response) {
          if(response.success) {
            alert('Data berhasil disimpan!');
            $('#dataTable-Jenis').DataTable().ajax.reload();  // Reload tabel setelah di input
            //$('#addJenis').modal('hide');  // Tutup modal
          }
        },
        error: function(xhr) {
          // Menampilkan pesan error dari server (validasi gagal)
          $('#error-message').text("Ada kesalahan");
        }
      });
    });

    

    $('body').on('click', '#btnDelete', function (e) {
        e.preventDefault(); 

        $('#loading').show();

        let jenis_id = $(this).data('id');
        console.log(typeof(jenis_id));
        // console.log("Fungsi deleteCategory dipanggil untuk id: "+ jenis_id);
        if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
            $.ajax({
                url: `/tes/delete/${jenis_id}`,  // URL untuk menghapus data
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')  // Laravel CSRF token
                },
                success: function(response) {
                    
                    alert('Kategori berhasil dihapus.');
                    $('#dataTable-Jenis').DataTable().ajax.reload();  // Reload tabel setelah delete
                    $('#loading').hide();
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message);
                }
                });
            }
    });


    $('body').on('click', '#btnUpdate', function (e) {
        
        e.preventDefault(); 

        let id_jenis = $(this).data('id');

        //fetch detail post with ajax
        $.ajax({
            url: `/tes/edit/${id_jenis}`,
            type: "GET",
            cache: false,
            success:function(response){
                
                //fill data to form
                $('#idjenisAdd').val(response.data.id_jenis);
                $('#jenisAdd').val(response.data.jenis);

                // //open modal
                // $('#updateCategoriModal').modal('show');
            }
        });
    });

    // Mengupdate kategori saat tombol update diklik
    $('#btn-update-jenis').on('click', function() {
        console.log("DI KLIK");
        
        let jenisId = $('#idjenisAdd').val();
        let jenisName = $('#jenisAdd').val();

        $.ajax({
            url: `/tes/update/${jenisId}`,
            type: "PUT",
            data: {
                "id_jenis": jenisId, 
                "jenis": jenisName,
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.message);
                $('#dataTable-Jenis').DataTable().ajax.reload();  // Reload tabel setelah update
            },
            error: function(xhr) {
                alert(xhr.responseJSON.message);
            }
        });
    });  
        
    
</script>

{{-- <script>

 $(document).ready(function() {
    
    getData(); 
    //  Input Data Jenis
    $('#inputJenis').on('submit', function(e) {
      e.preventDefault();  // Mencegah form dikirim secara tradisional
      //console.log($(this).serialize());
      
      // Reset error message
      $('#error-message').text('');

      $.ajax({
        type: 'POST',
        url: '{{ route("create.jenis") }}',  // Route di Laravel
        data: $(this).serialize(),
        success: function(response) {
          if(response.success) {
            alert('Data berhasil disimpan!');
            //$('#addJenis').modal('hide');  // Tutup modal
          }
        },
        error: function(xhr) {
          // Menampilkan pesan error dari server (validasi gagal)
          $('#error-message').text("Ada kesalahan");
        }
      });
    });

    function getData(){
        console.log("masuk");
        
        $.ajax({
            type: 'GET',
            url: '{{ route("halaman.jenis") }}',  // URL dari route Laravel
            dataType: 'json',
            success: function(response) {
                // Proses data yang diterima dan tampilkan di halaman
                //$('#tbody').html('');  // Kosongkan kontainer sebelumnya
                $.each(response, function(index, dataItem) {
                    // console.log(dataItem.id_jenis);
                    // Tambahkan setiap data item ke dalam container
                    $('tbody').append('<tr>'+
                                                     '<td>'+ dataItem.id_jenis + '</td>'+
                                                     '<td>' + dataItem.jenis + '</td>'+
                                                     '<td align="center">' +
                                                    '<a href="javascript:void(0)" id="btn-edit-jenis" data-id="' + dataItem.id_jenis + '" class="btn btn-sm btn-warning">Edit</a> ' +
                                                    '<a href="javascript:void(0)" id="btn-delete-jenis" data-id="' + dataItem.id_jenis + '" class="btn btn-sm btn-danger">Delete</a>' +
                                                    '</td>' +
                                                     '</tr>');
                });
            },
            error: function(xhr, status, error) {
                console.log('Terjadi kesalahan: ' + error);
            }
        });
    }
  });
</script> --}}
<!-- End Add Jenis -->
