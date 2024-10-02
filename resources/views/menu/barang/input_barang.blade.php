@extends('index')

@section('title','Input Barang')
@section('content')

    <!-- Add Button -->
    <div class="card-header py-3 d-flex flex-row-reverse">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBarang">
            <i class="fas fa-plus fa-sm"></i> Add Barang
        </button>
    </div>

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
                                <label for="categori_id">Categori:</label>
                                <select name="categori_id" id="categori_id" class="form-control" required>
                                    <option value="">-- Pilih Categori --</option>
                                    @foreach($get_categori as $c)
                                        <option value="{{ $c->id }} ">{{ $c->categori }}</option>
                                     @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jenis_id">Jenis:</label>
                                <select name="jenis_id" id="jenis_id" class="form-control" required>
                                    <option value="">-- Pilih Jenis --</option>
                                    @foreach($get_jenis as $j)
                                        <option value="{{ $j->id }} ">{{ $j->jenis }}</option>
                                     @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="merek_id">Merek:</label>
                                <select name="merek_id" id="merek_id" class="form-control" required>
                                    <option value="">-- Pilih Merek --</option>
                                    @foreach($get_merek as $m)
                                        <option value="{{ $m->id}} ">{{ $m->merek }}</option>
                                     @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="lokasiAdd">Lokasi</label>
                                <input type="Text" class="form-control" id="lokasiAdd" name="lokasi" placeholder="Lokasi">
                            </div>

                            <div class="form-group">
                                <label for="merek_id">Npk:</label>
                                <select name="merek_id" id="merek_id" class="form-control" required>
                                    <option value="">-- Pilih Npk --</option>
                                    @foreach($get_merek as $m)
                                        <option value="{{ $m->id}} ">{{ $m->merek }}</option>
                                     @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="karyawanAdd">Karyawan</label>
                                <input type="Text" class="form-control" id="karyawanAdd" name="karyawan" placeholder="Nama Karyawan" readonly>
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
    @include('fiture.barang.update_delete_barang')
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
                                                <th width=10%>No</th>
                                                <th width=20%>No Asset</th> 
                                                <th>Categori</th> 
                                                <th>Jenis</th> 
                                                <th>Merek</th>
                                                <th>Action</th> 
                                                
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            @foreach($get_barang as $no=>$b)
                                                <tr id="row-{{ $b->id }}">
                                                    {{-- <td>{{ $b->tbCategori[0]->id_categori }}-{{ strtoupper($b->tbJenis[0]->id_jenis) }}-{{ strtoupper($b->tbMerek[0]->id_merek) }}-{{ $b->id }}</td> --}}
                                                    <td>{{ $no+1 }}</td>
                                                    <td>{{ strtoupper($b->no_asset) }}</td>
                                                    <td>{{ $b->tbCategori[0]->categori }}</td>
                                                    <td>{{ $b->tbJenis[0]->jenis }}</td>
                                                    <td>{{ $b->tbMerek[0]->merek  }}</td>
                                                    <td align="center">
                                                        <a href="javascript:void(0)" id="btn-edit-barang" data-id="{{ $b->id }}" class="btn btn-sm btn-warning">Edit</a>
                                                        <a href="javascript:void(0)" id="btn-delete-barang" data-id="{{ $b->id }}" class="btn btn-sm btn-danger">Delete</a>
                                                    </td>
                                                    {{-- <td>
                                                        @if (!empty($b->tbMerek[0]->merek) )
                                                            {{ $b->tbMerek[0]->merek  }}
                                                        @else
                                                            <span class="btn btn-secondary">dihapus</span>
                                                        @endif
                                                    </td> --}}

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
    </div>
    
@endsection
