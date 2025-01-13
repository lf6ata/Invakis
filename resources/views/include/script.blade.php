    <!-- Bootstrap core JavaScript-->
    <script src={{asset("template/vendor/jquery/jquery.min.js")}}></script>
    <script src={{asset("template/vendor/bootstrap/js/bootstrap.bundle.min.js")}}></script>

    <!-- Core plugin JavaScript-->
    <script src={{asset("template/vendor/jquery-easing/jquery.easing.min.js")}}></script>

    <!-- Custom scripts for all pages-->
    <script src={{asset("template/js/sb-admin-2.min.js")}}></script>

    <!-- Page level plugins -->
    <script src={{ asset("template/vendor/datatables/jquery.dataTables.min.js")}}></script>
    <script src={{ asset("template/vendor/datatables/dataTables.bootstrap4.min.js")}}></script>
    
    <!-- Page level custom scripts -->
    <script src={{ asset("template/js/demo/datatables-demo.js")}}></script>
    
    {{-- Script Inisialisasi Table Jquery --}}
    <script>
    $(document).ready(function() {
        $('#dataTable-Categori').DataTable();
        $('#dataTable-Jenis').DataTable();
        $('#dataTable-Merek').DataTable();
        $('#dataTable-Warna').DataTable();
        $('#dataTable-Lokasi').DataTable();
        $('#dataTable-Divisi').DataTable();

        // Membuat motif bari table belang belang
        $('#myTable tbody tr:even').css('background-color', '#f2f2f2'); // Baris genap
        $('#myTable tbody tr:odd').css('background-color', '#fff');     // Baris ganjil
    });
    </script>

    <!-- PLUGIN DATEPICKER JS UNTUK PEMILIHAN TANGGAL -->
    
    <!-- Bootstrap JS penyebab konflik-->
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> --}}
    
    <!-- Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <!-- JS Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>

    {{-- <script>
        // Tampilkan spinner
        document.getElementById('loading-spinner').style.display = 'flex';

        // Menunggu 500ms sebelum melakukan redirect untuk memberikan waktu pada spinner
        setTimeout(() => {
            document.getElementById('loading-spinner').style.display = 'none';
        }, 1500);
    </script> --}}
    
