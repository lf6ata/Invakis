<!DOCTYPE html>
<html lang="en">

    {{-- Head --}}
    @include('include.style')

<body id="page-top">

    <div id="loading-spinner" >
        <div class="spinner"></div>
    </div>

    <!-- Page Wrapper -->
    <div id="wrapper">

    {{-- Sidebar --}}
    @include('layout.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('layout.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-3">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard  @if(View::hasSection('title') && trim($__env->yieldContent('title')) == 'Dashboard') @else / @yield('title') @endif  </h1>
                    </div>


                    <!-- Content Row -->

                    
                    
                    @yield('content')    

                    


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('layout.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    {{-- <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    
                    <form  action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary"> Logout </button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    @include('include.script')

</body>

</html>