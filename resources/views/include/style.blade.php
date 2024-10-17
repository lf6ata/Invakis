<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>INVAKIS</title>

    <!-- Custom fonts for this template-->
    <link href={{ asset("template/vendor/fontawesome-free/css/all.min.css") }} rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href={{ asset("template/css/sb-admin-2.min.css") }} rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href={{ asset("template/vendor/datatables/dataTables.bootstrap4.min.css") }} rel="stylesheet">
    
    <!-- Library Ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

     <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!-- CSS Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
    
    <style>
        
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
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

        input[type="checkbox"]{
            width: 1.3em; 
            height: 1.3em;
        }

        .select2-container {
            width: 100% !important; /* Memastikan lebar 100% untuk container */
        }

        .select2-container--default .select2-selection--multiple .select2-selection__placeholder {
            color: #f00000; /* Warna placeholder */
        }

        /* Mengubah warna latar belakang pilihan yang dipilih */
        /* .select2-container--default .select2-selection--multiple {
            background-color: #e9ecef; 
            border: 1px solid #ced4da; 
        } */

        /* Mengubah warna teks pilihan yang dipilih */
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff; /* Warna latar belakang pilihan */
            color: white; /* Warna teks */
        }

        /* Mengubah warna untuk ikon hapus pada pilihan */
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: white; /* Warna untuk ikon hapus */
        }

    </style>
</head>


</head>