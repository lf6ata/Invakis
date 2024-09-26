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
                        <form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data">
                            
                            @csrf

                            <div class="form-group">
                                <label for="brand_id">Categori:</label>
                                <select name="brand_id" id="brand_id" class="form-control" required>
                                    <option value="">-- Pilih Categori --</option>
                                    @foreach($get_categori as $c)
                                        <option value="{{ $c->id_categori }} ">{{ $c->categori }}</option>
                                     @endforeach
                                </select>
                            </div>

                            {{-- <div class="form-group">
                                <label for="brand_id">Jenis:</label>
                                <select name="brand_id" id="brand_id" class="form-control" required>
                                    <option value="">-- Pilih Jenis --</option>
                                    @foreach($get_barang as $b)
                                        <option value="{{ $b->tbJenis[0]->id_jenis }} ">{{ $b->tbJenis[0]->jenis }}</option>
                                     @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="brand_id">Merek:</label>
                                <select name="brand_id" id="brand_id" class="form-control" required>
                                    <option value="">-- Pilih Merek --</option>
                                    @foreach($get_barang as $b)
                                        <option value="{{ $b->tbMerek[0]->id_merek }} ">{{ $b->tbMerek[0]->merek }}</option>
                                     @endforeach
                                </select>
                            </div> --}}
                            

                            <div class="form-group">
                                <label for="image">Pilih Gambar atau Ambil Foto:</label>
                                <input type="file" class="form-control" name="image" id="image" accept="image/*" capture="camera">
                            </div>

                            

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    <img src="{{ asset('storage/images/' . session('image')) }}" alt="Uploaded Image" style="max-width: 200px;">
                                @endif
                    
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        
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
                                                <th width=20%>No Asset</th> 
                                                <th>Categori</th> 
                                                <th>Jenis</th> 
                                                <th>Merek</th> 
                                                
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            @foreach($get_barang as $no=>$b)
                                                <tr>
                                                    <td>{{ $b->tbCategori[0]->id_categori }}-{{ $b->tbJenis[0]->id_jenis }}</td>
                                                    <td>{{ $b->tbCategori[0]->categori }}</td>
                                                    <td>{{ $b->tbJenis[0]->jenis }}</td>
                                                    <td>{{ $b->tbMerek[0]->merek }}</td>

                                                </tr>
                                            @endforeach
                                            {{-- @foreach($get_jenis as $data_jenis)
                                                <tr>
                                                    @foreach($data_jenis->getJenis as $no=>$djenis)
                                                        
                                                            <td>{{ $djenis->id_jenis}}</td>
                                                        
                                                    @endforeach
                                                </tr>
                                            @endforeach --}}
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
    </div>
    
@endsection
