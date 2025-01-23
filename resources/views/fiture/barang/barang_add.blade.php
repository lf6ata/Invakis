<!-- Form Add Barang-->
<div class="modal fade" id="addBarang" tabindex="-1" role="dialog" aria-labelledby="addLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addLabel">Add Barang</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data">
                
                @csrf

                <div class="form-group">
                    <label for="categori_id">Kategori:</label>
                    <select name="categori_id" id="categori_id" class="form-control @error('categori_id') invalid-border @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($get_categori as $c)
                            <option value="{{ $c->id }}" {{ old('categori_id') == $c->id ? 'selected' : '' }}>{{ $c->categori }}</option>
                         @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="jenis_id">Jenis:</label>
                    <select name="jenis_id" id="jenis_id" class="form-control @error('jenis_id') invalid-border @enderror" required>
                        <option value="">-- Pilih Jenis --</option>
                        @foreach($get_jenis as $j)
                            <option value="{{ $j->id }}" {{ old('jenis_id') == $j->id ? 'selected' : '' }}>{{ $j->jenis }}</option>
                         @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="merek_id">Merek:</label>
                    <select name="merek_id" id="merek_id" class="form-control @error('merek_id') invalid-border @enderror" required>
                        <option value="">-- Pilih Merek --</option>
                        @foreach($get_merek as $m)
                            <option value="{{ $m->id}}" {{ old('merek_id') == $m->id ? 'selected' : '' }}>{{ $m->merek }}</option>
                         @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="warna_id">Warna:</label>
                    <select name="warna_id" id="warna_id" class="form-control @error('warna_id') invalid-border @enderror" required>
                        <option value="">-- Pilih Warna --</option>
                        @foreach($get_warna as $w)
                            <option value="{{ $w->id}}" {{ old('warna_id') == $w->id ? 'selected' : '' }}>{{ $w->warna }}</option>
                         @endforeach
                    </select>
                </div>

                {{-- <div class="form-group">
                    <label for="lokasiAdd">Lokasi</label>
                    <input type="Text" class="form-control @error('lokasi_id') invalid-border @enderror" id="lokasi_id" value="{{ old('lokasi_id') }}" name="lokasi_id" placeholder="Lokasi">
                </div> --}}

                <div class="form-group">
                    <label for="lokasi_id">Lokasi:</label>
                    <select name="lokasi_id" id="lokasi_id" class="form-control @error('lokasi_id') invalid-border @enderror" required>
                        <option value="">-- Pilih Lokasi --</option>
                        @foreach($get_zona as $z)
                            <option value="{{ $z->id}}" {{ old('lokasi_id') == $z->id ? 'selected' : '' }}>{{ $z->lokasi }}</option>
                         @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="npk_id">Npk:</label>
                    <select name="npk_id" id="npk_id" class="form-control @error('npk_id') invalid-border @enderror" required>
                        <option value="">-- Pilih Npk --</option>
                        @foreach($get_karyawan as $k)
                            <option value="{{ $k->id}}" {{ old('npk_id') == $k->id ? 'selected' : '' }}>{{ $k->npk }}</option>
                         @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="karyawan_id">Karyawan</label>
                    <input type="Text" class="form-control  @error('karyawan_id') invalid-border @enderror" id="karyawan_id" value="{{ old('karyawan_id') }}" name="karyawan_id" placeholder="Nama Karyawan" readonly>
                </div>

                <div class="form-group">
                    <label for="divisi_id">Divisi</label>
                    <input type="Text" class="form-control @error('divisi_id') invalid-border @enderror" id="divisi_id" value="{{ old('divisi_id') }}" name="divisi_id" placeholder="Divisi" readonly>
                </div>
                

                <div class="form-group">
                    <label for="image">Pilih Gambar atau Ambil Foto:</label>
                    <input type="file" class="form-control @error('image') invalid-border @enderror" name="image" id="image" accept="image/*" capture="camera">
                </div>

                <div class="form-group">
                    <label for="sn_id">Serial Number</label>
                    <input type="Text" class="form-control @error('sn_id') invalid-border @enderror" value="{{ old('sn_id') }}" id="sn_id" name="sn_id" placeholder="Serial Number">
                </div>

                <div class="form-group">
                    <label for="jlicense_id">Jenis License</label>
                    <input type="Text" class="form-control @error('jlicense_id') invalid-border @enderror" value="{{ old('jlicense_id') }}" id="jlicense_id" name="jlicense_id" placeholder="Jenis License">
                </div>

                <div class="form-group">
                    <label for="kdlicense_id">Kode License</label>
                    <input type="Text" class="form-control @error('kdlicense_id') invalid-border @enderror" value="{{ old('kdlicense_id') }}" id="kdlicense_id" name="kdlicense_id" placeholder="Kode License">
                </div>

                <div class="form-group">
                    <label for="tanggal">Tangggal Masuk:</label>
                    <input type="text" class="form-control @error('tanggal_masuk') invalid-border @enderror" value="{{ old('tanggal_masuk') }}" id="datepicker" name="tanggal_masuk" placeholder="Pilih tanggal" required>
                </div>

                    {{-- @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        
                        <img src="{{ asset('storage/images/' . session('image')) }}" alt="Uploaded Image" style="max-width: 200px;">
                    @endif
        
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif --}}

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
        
    </div>
</div>
</div> 
<!-- End Add Button -->