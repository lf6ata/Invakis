<!-- Add Jenis -->
        <!-- Form Add Jenis-->
        <div class="modal fade" id="addJenis" tabindex="-1" role="dialog" aria-labelledby="addLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLabel">Add Jenis</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('create.jenis') }}" method="POST">

                            @csrf

                            <div class="form-group">
                              <label for="id_jenis_label">Id Jenis</label>
                              <input type="text" class="form-control" id="id_jenis_label" name="id_jenis" placeholder="Id Jenis" maxlength="2">
                            </div>
                            @error('id_jenis')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                              <label for="jenis_label">Jenis</label>
                              <input type="Text" class="form-control" id="jenis_label" name="jenis" placeholder="Jenis">
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