<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="alif">
    <meta name="author" content="alif">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ url('favicon/kiosbank.png') }}" type="image/x-icon">
    <title>INVAKIS</title>

    <!-- Custom fonts for this template-->
    <link href={{ asset('template/vendor/fontawesome-free/css/all.min.css') }} rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href={{ asset('template/css/sb-admin-2.min.css') }} rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href={{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }} rel="stylesheet">

    <!-- Library Ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!-- CSS Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />

    <!--sweetalert-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <style>
        /* body{
            color: black;
        } */

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        /* Warna default */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #fff;
        }

        input[type="checkbox"] {
            width: 1.3em;
            height: 1.3em;
        }

        .select2-container {
            width: 100% !important;
            /* Memastikan lebar 100% untuk container */
        }

        .select2-container--default .select2-selection--multiple .select2-selection__placeholder {
            color: #f00000;
            /* Warna placeholder */
        }

        /* Mengubah warna latar belakang pilihan yang dipilih */
        /* .select2-container--default .select2-selection--multiple {
            background-color: #e9ecef;
            border: 1px solid #ced4da;
        } */

        /* Mengubah warna teks pilihan yang dipilih */
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff;
            /* Warna latar belakang pilihan */
            color: white;
            /* Warna teks */
        }

        /* Mengubah warna untuk ikon hapus pada pilihan */
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: white;
            /* Warna untuk ikon hapus */
        }

        /* SMPINNER LOAD ALL PAGE */
        #loading-spinner {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            z-index: 9999;
            /* Pastikan spinner berada di atas elemen lain */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .spinner {
            border: 8px solid #f3f3f3;
            /* Light gray */
            border-top: 8px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .invalid-border {
            box-shadow: 0 0 5px red;
            border: 2px solid red; /* Atur border sesuai kebutuhan */
        }

    </style>
</head>
