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
      <!-- Custom fonts for this template-->
    <link href={{ asset("template/vendor/fontawesome-free/css/all.min.css") }} rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href={{ asset("template/css/sb-admin-2.min.css") }} rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href={{ asset("template/vendor/datatables/dataTables.bootstrap4.min.css") }} rel="stylesheet">
    <title>INVAKIS</title>
    <!-- Library Ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--sweetalert-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    {{-- container HTML untuk scanner QR Code --}}
    <div id="reader"></div>
    <!-- Add Btn Categori -->
    <button style="width: 100%"  onclick="javascript:history.back()" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategori">
        <i class="fas fa-back fa-sm nav-link"> Back</i>
    </button>    


    {{-- sesuaikan dengan file js HTML5-QRCode --}}
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    $(document).ready(function(){
        // inisiasi html5QRCodeScanner
        let html5QRCodeScanner = new Html5QrcodeScanner(
            // target id dengan nama reader, lalu sertakan juga 
            // pengaturan untuk qrbox (tinggi, lebar, dll)
            "reader", {
                fps: 10,
                qrbox: {
                    width: 200,
                    height: 200,
                },
            }
        );

        // function yang dieksekusi ketika scanner berhasil
        // membaca suatu QR Code
        function onScanSuccess(decodedText, decodedResult) {
            // redirect ke link hasil scan
            // window.location.href = decodedResult.decodedText;
            // $('#valueqr').val(decodedText);
            // console.log(`Code Match = ${decodedText}`, decodedResult);

            let id_qrcode = decodedText;

            //fetch detail get with ajax
            $.ajax({
                url: `/invakis/sto/scan`,
                type: "POST",
                cache: false,
                data:{
                    _token: $('meta[name="csrf-token"]').attr('content'),  // Laravel CSRF token
                    id_qrcode: id_qrcode
                },
                success:function(response){
                    if (response.status == 200) {
                        window.location.href = `/invakis/sto/edit/${id_qrcode}`;
                    } 
                    else {
             
                        Swal.fire(
                        'Scan',
                        'Data Tidak Ditemukan',
                        'error'
                        );
                        
                        setTimeout(function() {
                            location.reload();
                        }, 1500);   
                    }
                    
                }
            });
            
            

            // membersihkan scan area ketika sudah menjalankan 
            // action diatas
            html5QRCodeScanner.clear();
        }

        // render qr code scannernya
        html5QRCodeScanner.render(onScanSuccess);
    });
</script>
</body>
</html>



