@extends('index')

@section('title','Jenis Barang')
@section('content')

    <!-- Add Button -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBarang">
        <i class="fas fa-plus fa-sm"></i> Add Jenis
    </button>

        <!-- Form Add Barang-->
        <div class="modal fade" id="addBarang" tabindex="-1" role="dialog" aria-labelledby="addLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLabel">Add Jenis</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                              <label for="categoriLabel">Id Jenis</label>
                              <input type="Text" class="form-control" id="categoriLabel"  placeholder="Id Categori">
                            </div>

                            <div class="form-group">
                              <label for="jenisLabel">Jenis</label>
                              <input type="Text" class="form-control" id="jenisLabel" placeholder="Categori">
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Save</a>
                    </div>
                </div>
            </div>
        </div> 
    <!-- End Add Button -->

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
                                                <th>Id Categori</th>
                                                <th>Categori</th>  
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            <tr>
                                                <td>001</td>
                                                <td>Laptop</td>
                                            </tr>
                                            <tr>
                                                <td>002</td>
                                                <td>Mouse</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
    </div>
    
@endsection
