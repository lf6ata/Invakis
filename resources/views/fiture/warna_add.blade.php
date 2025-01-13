<!-- Add Warna -->
        <!-- Form Add Warna-->
        <div class="modal fade" id="addWarna" tabindex="-1" role="dialog" aria-labelledby="addLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLabel">Add Warna</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('create.warna') }}" method="POST">

                            @csrf

                            <div class="form-group">
                              <label for="id_warna_label">Id Warna</label>
                              <input type="text" class="form-control" id="id_warna_label" name="id_warna" placeholder="Id Warna" maxlength="2">
                            </div>
                            @error('id_warna')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                              <label for="warna_label">Warna</label>
                              <input type="Text" class="form-control" id="warna_label" name="warna" placeholder="Warna">
                            </div>

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