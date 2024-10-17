@extends('index')

@section('title','User')
@section('content')

        <!-- Form Add User-->
        <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLabel">Add User</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ Route('store.user') }}" method="POST" enctype="multipart/form-data">
                            
                            @csrf

                            <div class="form-group">
                                <label for="npkAdd">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                                    <p id="check_length" class="text-danger"></p>
                            </div>


                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="Text" class="form-control" id="email" name="email" placeholder="Nama Email">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                @if ($errors->has('password'))

                                    <span class="help-block text-danger">

                                        <strong>{{ $errors->first('password') }}</strong>

                                    </span>

                                @endif

                            </div>

                            <div class="form-group">
                                <label for="confirm-password">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="email" name="confirm-password" placeholder="Konfirmasi Password">
                                @if ($errors->has('confirm-password'))

                                    <span class="help-block">
                    
                                        <strong>{{ $errors->first('confirm-password') }}</strong>
                        
                                    </span>
                        
                                @endif
                    
                            </div>
                            
                            <div class="form-group">
                                <label for="roles">Role:</label>
                                <select name="roles" id="roles" class="form-control" required>
                                    <option value="">-- Pilih Role --</option>
                                    @foreach($role as $r)
                                        <option value="{{$r->name}} ">{{$r->name}}</option>
                                     @endforeach
                                </select>
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
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>  
        @endif
        
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="d-flex align-items-center">
                                    <div class="p-2 flex-grow-1">
                                        <h6 class="m-0 font-weight-bold text-primary ">Data User</h6>
                                    </div>
                                    <div class="p-2">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUser">
                                            <i class="fas fa-plus fa-sm"></i> Add User
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
                                                <th>Nama</th> 
                                                <th>Email</th> 
                                                <th>Role</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            @foreach($tb_user as $no=>$u)
                                                <tr id="row-{{ $u->id }}">
                                                    <td>{{ $no+1 }}</td>
                                                    <td>{{ $u->name }}</td>
                                                    <td>{{ $u->email  }}</td>
                                                    <td>{{ $u->getRoleNames()->implode(', ')}}</td>
                                                    <td align="center">
                                                        <a href="javascript:void(0)" id="btn-edit-user" data-id="{{ $u->id }}" class="btn btn-sm btn-warning">Edit</a>
                                                        <a href="javascript:void(0)" id="btn-delete-user" data-id="{{ $u->id }}" class="btn btn-sm btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
    </div>

@include('fiture.modal_user.update_user')
<script>
$(document).ready(function() {
    // $('#nama').change(function() {
    //     let id_npk = $(this).val(); // Ambil nilai NPK yang dipilih
     
    //     if(parseInt(id_npk)){
    //         if (id_npk.length > 7) {
    //         // console.log("NPK tidak boleh lebih dari 7 angka");
    //         $('#check_length').text('NPK tidak boleh lebih dari 7 angkadata');
    //         }
    //         else if (id_npk.length < 7)
    //         {
    //             // console.log("Role tidak boleh kurang dari 7 angka");
    //             $('#check_length').text('Role tidak boleh kurang dari 7 angka');
    //         }
    //         else{
    //             $('#check_length').text('');
    //         }
    //     }
    //     else if(id_npk == ""){
    //         $('#check_length').text('');
    //     }
    //     else {
    //         $('#check_length').text('Tidak boleh huruf');
    //     }
    // });

    $(document).on('click', '#btn-delete-user', function() {
    let userId = $(this).data('id');

    if (confirm('Yakin ingin menghapusnya ?')) {
        $.ajax({
                url: '/Invakis/user/delete/'+userId,
                type: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert(response.success);
                    
                    location.reload(); // Refresh daftar pegawai atau lakukan pembaruan tampilan jika perlu
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.error);
                }
            });
        }
    });
});
</script>
    
@endsection