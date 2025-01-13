<!-- Add Merek -->
        <!-- Form Add Merek-->
        <div class="modal fade" id="addMerek" tabindex="-1" role="dialog" aria-labelledby="addLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLabel">Add Merek</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('create.merek') }}" method="POST">

                            @csrf

                            <div class="form-group">
                              <label for="id_merek_label">Id Merek</label>
                              <input type="number" class="form-control" id="id_merek_label" name="id_merek" placeholder="Id Merek" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;">
                            </div>
                            @error('id_merek')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                              <label for="merek_label">Merek</label>
                              <input type="Text" class="form-control" id="merek_label" name="merek" placeholder="Merek">
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