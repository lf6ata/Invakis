<div class="modal fade" id="viewImages" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewLabel">View Images</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div align="center">
                    <img id="view_foto" style="max-width: 100%; cursor: cell;" src="" alt="Foto Asset">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        //button view modal edit pegawai and view data
        $('body').on('click', '#fotoAsset', function(e) {

            e.preventDefault();

            let id_foto = $(this).data('id');

            //fetch detail get with ajax
            $.ajax({
                url: `/invakis/barang/foto/${id_foto}`,
                type: "GET",
                cache: false,
                success: function(response) {
                    $('#viewLabel').text(`View ${response.data.no_asset}`);
                    if (response.data.image != 'Not Image') {
                        $('#view_foto').attr('src', '{{ asset('storage') }}/' + response.data.image);    
                    }

                    //open modal
                    $('#viewImages').modal('show');
                },

                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }

            });
        });
    });
</script>
<!-- End View Images -->
