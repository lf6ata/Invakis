@extends('index')

@section('title','Input Barang')
@section('content')

    <!-- Add Button -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBarang">
        <i class="fas fa-plus fa-sm"></i> Add Barang
    </button>

        <!-- Form Add Barang-->
        <div class="modal fade" id="addBarang" tabindex="-1" role="dialog" aria-labelledby="addLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLabel">Add Barang</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                              <label for="categoriLabel">Categori</label>
                              <input type="Text" class="form-control" id="categoriLabel"  placeholder="Categori">
                            </div>

                            <div class="form-group">
                              <label for="jenisLabel">Jenis</label>
                              <input type="Text" class="form-control" id="jenisLabel" placeholder="Jenis">
                            </div>

                            <div class="form-group">
                                <label for="merekLabel">Merek</label>
                                <input type="Text" class="form-control" id="merekLabel" placeholder="Merek">
                            </div>

                            <div class="form-group">
                                <label for="merekLabel">Merek</label>
                                <input type="Text" class="form-control" id="merekLabel" placeholder="Merek">
                            </div>

                            <div class="form-group">
                                <label for="merekLabel">Merek</label>
                                <input type="Text" class="form-control" id="merekLabel" placeholder="Merek">
                            </div>

                            <div class="form-group">
                                <label for="merekLabel">Merek</label>
                                <input type="Text" class="form-control" id="merekLabel" placeholder="Merek">
                            </div>

                            <div class="form-group">
                                <label for="merekLabel">Merek</label>
                                <input type="Text" class="form-control" id="merekLabel" placeholder="Merek">
                            </div>

                            <div class="form-group">
                                <label for="merekLabel">Merek</label>
                                <input type="Text" class="form-control" id="merekLabel" placeholder="Merek">
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
    @yield('fiture')
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
                                                <th>No Asset</th>
                                                <th>Categori</th>
                                                <th>Jenis</th>
                                                <th>Merek</th>
                                                <th>Warna</th>
                                                <th>Lokasi</th>
                                                <th>NPK</th>
                                                <th>Foto Asset</th>
                                                <th>Nama Karyawan</th>
                                                <th>Divisi</th>
                                                <th>Serial Number</th>
                                                <th>Jenis License</th>
                                                <th>Kode License</th>
                                                <th>Tanggal Masuk</th>  
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            <tr>
                                                <td>001-AA-AA-02</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                            </tr>
                                            <tr>
                                                <td>002-AB-BA-01</td>
                                                <td>Accountant</td>
                                                <td>Tokyo</td>
                                                <td>63</td>
                                                <td>2011/07/25</td>
                                                <td>$170,750</td>
                                                <td>$320,800</td>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
    </div>
    
@endsection
