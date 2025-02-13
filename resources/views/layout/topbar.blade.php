                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @auth
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                            {{ Auth::user()->name }}
                                        </span>
                                    @else
                                        
                                    @endauth    
                                <img class="img-profile rounded-circle"
                                    src="/template/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a id="logOut" class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

<script>

$(document).ready(function(){
   
    $('body').on('click','#logOut',function (e){
        console.log('logout');
        
        Swal.fire({
        title: 'Konfirmasi',
        text: "Anda ingin mengakhiri sesi?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                
                $.ajax({
                    url: "{{ route('auth.logout') }}",  // URL untuk menghapus data
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')  // Laravel CSRF token
                    },
                    success: function(response) {
                        setTimeout(() => {
                            window.location.href ='/invakis/login';
                        }, 500);
                        
                        
                        
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON.message);
                    }
                });
            }
        });
    });
});
    // Swal.fire({
    //     title: 'Apakah Anda yakin?',
    //     text: "Anda tidak akan dapat mengembalikan data ini!",
    //     icon: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Ya, hapus!'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             // Tampilkan loading
    //             Swal.fire({
    //                 title: 'Menghapus...',
    //                 text: 'Silakan tunggu...',
    //                 allowOutsideClick: false,
    //                 didOpen: () => {
    //                     Swal.showLoading();
    //                 }
    //             });
    //             $.ajax({
    //                 url: `/tes/delete/${jenis_id}`,  // URL untuk menghapus data
    //                 type: 'DELETE',
    //                 data: {
    //                     _token: $('meta[name="csrf-token"]').attr('content')  // Laravel CSRF token
    //                 },
    //                 success: function(response) {
    //                     setTimeout(() => {
    //                         Swal.fire(
    //                         'Dihapus!',
    //                         'Data Anda telah dihapus.',
    //                         'success'
    //                     );

    //                         $('#dataTable-Jenis').DataTable().ajax.reload();  // Reload tabel setelah delete
    //                         $('#loading').hide();
    //                     }, 1500); // Jeda 1,5 detik (1500 ms)
                        
    //                 },
    //                 error: function(xhr) {
    //                     alert(xhr.responseJSON.message);
    //                 }
    //             });
    //         }
    //     });
</script>