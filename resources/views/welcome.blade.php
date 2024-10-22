<!DOCTYPE html>
<html>
  <head>
    <title>Instascan</title>
    <script type="text/javascript" src="https://lf6ata.github.io/scan-qrcode/instascan.min.js"></script>
    {{-- <script src="{{ asset('plugin/scan_qrcode/instascan.min.js') }}"></script> --}}
    
  </head>
  <body>
    <h1>QR Code Scanner</h1>
    <video id="preview" width="400" height="300"></video>
    <div id="result"></div>

    <script>
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            const scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

            scanner.addListener('scan', function(content) {
                document.getElementById('result').innerText = 'QR Code Content: ' + content;
            });

            Instascan.Camera.getCameras()
                .then(cameras => {
                    if (cameras.length > 0) {
                        scanner.start(cameras[0])
                            .catch(error => {
                                console.error('Error starting scanner:', error);
                            });
                    } else {
                        console.error('No cameras found.');
                    }
                })
                .catch(error => {
                    console.error('Error getting cameras:', error);
                });
        } else {
            console.error('MediaDevices API not supported in this browser.');
        }
    </script>
    {{-- <script>
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            alert('MediaDevices API is supported!');
        } else {
            alert('MediaDevices API is NOT supported in this browser.');
        }
    </script> --}}
  </body>
</html>