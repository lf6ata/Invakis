        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="javascript:void(0)">
                <div class="sidebar-brand-icon">
                    <!--<i class="fas fa-laugh-wink"></i>-->
                    <img class="fas" src="/template/img/icon-kiosbank.png" width="40px" style="margin-top: -8px">
                </div>
                <div class="sidebar-brand-text mx-3">
                    <h4>KIOSBANK</h4>
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link nav-dst" href={{ route('page.dashboard') }}>
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            @if (Auth::user()->getRoleNames()->implode(', ') == 'admin')
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
                <div class="sidebar-heading">
                    Config
                </div>
                <!-- Nav Item - Pages Collapse Menu -->
                <li
                    class="nav-item {{ Route::currentRouteName() == 'page.user' || Route::currentRouteName() == 'page.role' ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse"
                        data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog "></i>
                        <span>Setting User</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">User:</h6>
                            <a class="collapse-item nav-dst {{ Route::currentRouteName() == 'page.user' ? 'active' : '' }}"
                                href="{{ route('page.user') }}">User</a>
                            <a class="collapse-item nav-dst {{ Route::currentRouteName() == 'page.role' ? 'active' : '' }}"
                                href="{{ route('page.role') }}">Role</a>
                        </div>
                    </div>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Fiture
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li
                class="nav-item {{ Route::currentRouteName() == 'page.categori' || Route::currentRouteName() == 'page.barang' ? 'active' : '' }}">
                <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse"
                    data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="bi fa-fw bi-box-seam-fill"></i>
                    <span>Master Barang</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Barang:</h6>
                        <a class="collapse-item nav-dst {{ Route::currentRouteName() == 'page.categori' ? 'active' : '' }}"
                            href={{ Route('page.categori') }}>Kategori</a>
                        <a class="collapse-item nav-dst {{ Route::currentRouteName() == 'page.barang' ? 'active' : '' }}"
                            href={{ Route('page.barang', 'created_at') }}>Barang</a>
                        <div class="collapse-divider"></div>
                    </div>
                </div>
            </li>
            @if (Auth::user()->getRoleNames()->implode(', ') == 'admin')
                <!-- Nav Item - Pegawai -->
                <li class="nav-item {{ Route::currentRouteName() == 'page.pegawai' ? 'active' : '' }}">
                    <a class="nav-link nav-dst" href={{ Route('page.pegawai', 'created_at') }}>
                        <i class="fas fa-fw fa-user"></i>
                        <span>Data Pegawai</span>
                    </a>
                </li>
            @endif

            <!-- Nav Item - Laporan -->
            <li class="nav-item {{ Route::currentRouteName() == 'page.sto' ? 'active' : '' }}">
                <a class="nav-link nav-dst" href="{{ url('/invakis/sto/STO02/false ')}}">
                    <i class="fas fa-fw fa-file"></i>
                    <span>STO</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Menunggu stelah perloaderd
                checkLoad = window.getComputedStyle(document.getElementById('loading-spinner'));
                console.log(checkLoad.display);

                setTimeout(() => {
                    document.getElementById('loading-spinner').style.display = 'none';
                }, 500);


                const links = document.querySelectorAll('.nav-dst');


                links.forEach(link => {
                    link.addEventListener('click', function(e) {
                        const href = this.getAttribute('href');


                        // Tampilkan spinner
                        document.getElementById('loading-spinner').style.display = 'flex';

                        // Menunggu 500ms sebelum melakukan redirect
                        // setTimeout(() => {
                        // Tampilkan spinner

                        window.location.href = href;

                        // }, 1500);
                        document.getElementById('loading-spinner').style.display = 'none';

                        e.preventDefault(); // Mencegah aksi default tautan
                    });
                });
            });
        </script>
