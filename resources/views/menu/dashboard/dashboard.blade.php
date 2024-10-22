@extends('index')

@section('title','Dashboard')
@section('content')
{{-- container HTML untuk scanner QR Code --}}
<div id="reader"></div>

.
.
.
{{-- sesuaikan dengan file js HTML5-QRCode --}}
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
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
                    // alert(id_qrcode);
                } else {
                    
                    alert("Data tidak ditemukan");
                    location.reload();
                    
                }
                
            }
        });
        
        

        // membersihkan scan area ketika sudah menjalankan 
        // action diatas
        html5QRCodeScanner.clear();
    }

    // render qr code scannernya
    html5QRCodeScanner.render(onScanSuccess);
</script>
 
@endsection
