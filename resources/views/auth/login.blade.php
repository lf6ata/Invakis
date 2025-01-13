
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="alif">
    <meta name="author" content="alif">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ url('favicon/kiosbank.png') }}" type="image/x-icon">

    <title>LOGIN INVAKIS</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('') }}template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('template') }}/css/sb-admin-2.min.css" rel="stylesheet">

    <!--sweetalert-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* SMPINNER LOAD ALL PAGE */
        #loading-spinner {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            z-index: 9999; /* Pastikan spinner berada di atas elemen lain */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .spinner {
            border: 8px solid #f3f3f3; /* Light gray */
            border-top: 8px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

</head>

<body class="bg-gradient-primary">
    <div id="loading-spinner" style="display:none;">
        <div class="spinner"></div>
    </div>

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-8 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome to Invakis</h1>
                                    </div>
                                    <form class="user" action="{{ route('auth.login') }}" method="POST">
                                        
                                        @csrf

                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                            id="exampleInputEmail" aria-describedby="emailHelp"
                                            placeholder="Enter Email Address..." value="{{ old('email') }}" autofocus>
                                            <span style="color: red">
                                                    @error('email')
                                                        {{ $message }}
                                                    @enderror
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                            <span style="color: red">
                                                @error('password')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button id="login" type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    {{-- <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
        
        login = document.getElementById('login');
            
        login.addEventListener('click', function(){
        // Tampilkan spinner
        document.getElementById('loading-spinner').style.display = 'flex';

        // Menunggu 1500ms sebelum melakukan redirect untuk memberikan waktu pada spinner
        setTimeout(() => {
        // Menutup spinner
        document.getElementById('loading-spinner').style.display = 'none';
        }, 1000);
        // e.preventDefault(); // Mencegah aksi default tautan
    });                
});

</script>

@if (@session()->has('wrong'))
<script>
    Swal.fire({
    icon: "error",
    title: "Error",
    text: "{{ session('wrong') }}",
    });
</script>
@endif

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('') }}template/vendor/jquery/jquery.min.js"></script>
<script src="{{ asset('') }}template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('') }}template/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="j{{ asset('') }}s/sb-admin-2.min.js"></script>

</body>

</html>