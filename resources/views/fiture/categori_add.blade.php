<!-- Add Categori -->
        <!-- Form Add Barang-->
        <div class="modal fade" id="addCategori" tabindex="-1" role="dialog" aria-labelledby="addLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLabel">Add Categori</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('create.categori') }}" method="POST">

                            @csrf

                            <div class="form-group">
                              <label for="idcategoriLabel">Id Categori</label>
                              <input type="Text" class="form-control" id="idcategoriLabel" name="id_categori" placeholder="Id Categori">
                            </div>
                                @error('id_categori')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror

                            <div class="form-group">
                              <label for="categoriLabel">Categori</label>
                              <input type="Text" class="form-control" id="categoriLabel" name="categori" placeholder="Categori">
                            </div>

                            {{-- Button add  --}}
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit">Save</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div> 
    <!-- End Add Button -->