@extends('index')

@section('title','Categori')
@section('content')

    <!-- Add Categori -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategori">
        <i class="fas fa-plus fa-sm"></i> Add Categori
    </button>
    <!-- Add Categori -->
        <!-- Form Add Barang-->
        <div class="modal fade" id="addCategori" tabindex="-1" role="dialog" aria-labelledby="addLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLabel">Add Categori</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('create.categori') }}" method="POST">

                            @csrf

                            <div class="form-group">
                              <label for="idcategoriLabel">Id Categori</label>
                              <input type="Text" class="form-control" id="idcategoriLabel" name="id_categori" placeholder="Id Categori">
                            </div>

                            <div class="form-group">
                              <label for="categoriLabel">Categori</label>
                              <input type="Text" class="form-control" id="categoriLabel" name="categori" placeholder="Categori">
                            </div>
                        
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit">Save</a>
                            </div>
                        </form>
                </div>
            </div>
        </div> 
    <!-- End Add Button -->

    <a href="javascript:void(0)" id="btn-edit-categori"  class="btn btn-sm btn-warning">Edit</a>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th>Id Categori</th>
                                                <th>Categori</th>  
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                        
                                            @foreach ($Categori as $no=>$data)
                                        
                                                <tr>
                                                    <td>{{ $no+1 }}</td>
                                                    <td>{{ $data->id_categori}}</td>
                                                    <td>{{ $data->categori }}</td>
                                                    <td>
                                                        <a href="javascript:void(0)" id="btn-edit-categori" data-id="{{ $data->id_categori }}" class="btn btn-sm btn-warning">Edit</a>
                                                    </td>
                                                </tr>

                                            @endforeach
                                            
                                            @include('fiture.card_edit')
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
    </div>
    
@endsection
