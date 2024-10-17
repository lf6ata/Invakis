@extends('index')

@section('title','Roles')
@section('content')

        <!-- Form Add Roles-->
        <div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="addLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLabel">Add Role</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('store.roles') }}" method="POST" enctype="multipart/form-data">
                            
                            @csrf

                            <div class="form-group">
                                <label for="nama_roles">Nama Permission</label>
                                <input type="text" class="form-control" id="nama_roles" name="nama_roles" placeholder="Nama Roles">
                                    <p id="check_length" class="text-danger"></p>
                            </div>          
                            
                            <div class="form-group">
                                <label for="roles">Pilih Role:</label>
                                <select class="form-control" id="roles" name="roles[]" multiple>
                                    @foreach ($tb_permission as $p)
                                        <option value="{{ $p->name }}">{{ $p->name }}</option>
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
    <!-- End Add Roles -->
        
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
                                        <h6 class="m-0 font-weight-bold text-primary ">Data Roles</h6>
                                    </div>
                                    <div class="p-2">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRole">
                                            <i class="fas fa-plus fa-sm"></i> Add Roles
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
                                                <th>Role Name</th> 
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            @foreach($tb_role as $no=>$r)
                                                <tr id="row-{{ $r->id }}">
                                                    <td>{{ $no+1 }}</td>
                                                    <td>{{ $r->name }}</td>
                                                    <td align="center">
                                                        <a href="javascript:void(0)" id="btn-permission-role" data-id="{{ $r->id }}" class="btn btn-sm btn-info">Permission</a>
                                                        <a href="javascript:void(0)" id="btn-edit-role" data-id="{{ $r->id }}" class="btn btn-sm btn-warning">Edit</a>
                                                        <a href="javascript:void(0)" id="btn-delete-role" data-id="{{ $r->id }}" class="btn btn-sm btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
    </div>

@include('fiture.modal_role.update_role')




<script>
$(document).ready(function() {
    
    $('#roles').select2({
        placeholder: 'Pilih Permission',
        allowClear: true
    });


    $(document).on('click', '#btn-delete-role', function() {
    let roleId = $(this).data('id');

    if (confirm('Yakin ingin menghapusnya ?')) {
        $.ajax({
                url: '/invakis/delete/role/'+roleId,
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    
@endsection