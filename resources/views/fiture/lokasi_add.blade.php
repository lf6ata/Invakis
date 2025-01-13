<!-- Add Lokasi -->
        <!-- Form Add Lokasi-->
        <div class="modal fade" id="addLokasi" tabindex="-1" role="dialog" aria-labelledby="addLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLabel">Add Lokasi</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('create.lokasi') }}" method="POST">

                            @csrf

                            <div class="form-group">
                              <label for="lokasi_label">Lokasi</label>
                              <input type="Text" class="form-control" id="lokasi_label" name="lokasi" placeholder="Lokasi">
                            </div>
                            @error('lokasi')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror

                            {{-- Button add  --}}
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit">Add</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div> 
    <!-- End Add Button -->