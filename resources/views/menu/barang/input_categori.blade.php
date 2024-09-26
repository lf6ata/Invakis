@extends('index')

@section('title','Categori')
@section('content')

    {{-- fiture add jenis --}}
    @include('fiture.modal_jenis.add_jenis')

    {{-- fiture add jenis --}}
    @include('fiture.modal_merek.add_merek')

    {{-- fiture add categori --}}
    @include('fiture.categori_add')


    @error('id_categori')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
    @enderror

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row-reverse">
                                        <!-- Add Btn Categori -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategori">
                                            <i class="fas fa-plus fa-sm"> Categori</i>
                                        </button>
                                        <!-- Add Btn Jenis -->
                                        <button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#addJenis">
                                            <i class="fas fa-plus fa-sm"> Jenis</i>
                                        </button>
                                        <!-- Add Btn Merek -->
                                        <button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#addMerek">
                                            <i class="fas fa-plus fa-sm"> Merek</i> 
                                        </button>
                                        <!-- Add Btn Warna -->
                                        <button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#addWarna">
                                            <i class="fas fa-plus fa-sm"> Warna</i> 
                                        </button>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable-Categori" width="100%" cellspacing="0">
                                        <thead align="center">
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
                                                    <td align="center">{{ $no+1 }}</td>
                                                    <td>{{ $data->id_categori}}</td>
                                                    <td>{{ $data->categori }}</td>
                                                    <td align="center">
                                                        <a href="javascript:void(0)" id="btn-edit-categori" data-id="{{ $data->id_categori }}" class="btn btn-sm btn-warning">Edit</a>
                                                        <a href="javascript:void(0)" id="btn-delete-categori" data-id="{{ $data->id_categori }}" class="btn btn-sm btn-danger">Delete</a>
                                                    </td>
                                                </tr>

                                            @endforeach
                                            
                                            
                                            {{-- fiture edit categori --}}
                                            @include('fiture.categori_edit')
                                            

                                        </tbody>
                                    </table>
                                </div>
                            </div>
    </div>
    
@endsection
