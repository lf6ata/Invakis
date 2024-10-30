@extends('index')

@section('title','Kategori')
@section('content')

    {{-- fiture add warna --}}
    @include('fiture.modal_warna.warna')

    {{-- fiture add jenis --}}
    @include('fiture.modal_jenis.add_jenis')

    {{-- fiture add merek --}}
    @include('fiture.modal_merek.add_merek')

    {{-- fiture add categori --}}
    @include('fiture.categori_add')


    @error('id_categori')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
    @enderror

    @if (session('success'))
        <script>
            Swal.fire('Sukses!', '{{ session('success') }}', 'success');
        </script>
    @elseif (@session('unsuccess'))
        <script>
            Swal.fire('Sukses!', '{{ session('unsuccess') }}', 'success');
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire('Error!', '{{ $errors->first() }}', 'error');
        </script>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row-reverse">
                                        <!-- Add Btn Categori -->
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addCategori">
                                            <i class="fas fa-plus fa-sm"> Kategori</i>
                                        </button>
                                        <!-- Add Btn Jenis -->
                                        <button type="button" class="btn btn-sm btn-info mr-2" data-toggle="modal" data-target="#addJenis">
                                            <i class="fas fa-plus fa-sm"> Jenis</i>
                                        </button>
                                        <!-- Add Btn Merek -->
                                        <button type="button" class="btn btn-sm btn-info mr-2" data-toggle="modal" data-target="#addMerek">
                                            <i class="fas fa-plus fa-sm"> Merek</i> 
                                        </button>
                                        <!-- Add Btn Warna -->
                                        <button type="button" class="btn btn-sm btn-info mr-2" data-toggle="modal" data-target="#addWarna">
                                            <i class="fas fa-plus fa-sm"> Warna</i> 
                                        </button>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable-Categori" width="100%" cellspacing="0">
                                        <thead align="center">
                                            <tr>
                                                <th width="5%">No</th>
                                                <th>Id Kategori</th>
                                                <th>Kategori</th>  
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                        
                                            @foreach ($Categori as $no=>$data)
                                        
                                                <tr>
                                                    <td align="center">{{ $no+1 }}</td>
                                                    <td>{{ sprintf('%02d',$data->id_categori)}}</td>
                                                    <td>{{ ucfirst($data->categori) }}</td>
                                                    <td width="20%" align="center">
                                                        <a href="javascript:void(0)" id="btn-edit-categori" data-id="{{ $data->id }}" class="btn btn-sm btn-warning">Edit</a>
                                                        <a href="javascript:void(0)" id="btn-delete-categori" data-id="{{ $data->id }}" class="btn btn-sm btn-danger">Delete</a>
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
