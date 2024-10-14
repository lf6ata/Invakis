<!-- resources/views/exports/users.blade.php -->

    <table>
        <thead>
            <tr>
                <th colspan="13" style="text-align:center; padding:50px;">Inventaris Barang</th>
            </tr>
            <tr>
                <th>No</th>
                <th>No Asset</th>
                <th>Categori</th> 
                <th>Jenis</th> 
                <th>Merek</th>
                <th>Lokasi</th>
                <th>Npk</th>
                <th>Karyawan</th>
                <th>Divisi</th>
                <th>S/N</th>
                <th>Jenis License</th>
                <th>Kode License</th>
                <th>Tanggal Masuk</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barang as $no=>$bar)
            <tr>
                <td>{{ $no+1 }}</td>
                <td>{{ $bar->no_asset }}</td>
                <td>{{ $bar->tbCategori[0]->categori }}</td>
                <td>{{ $bar->tbJenis[0]->jenis }}</td>
                <td>{{ $bar->tbMerek[0]->merek }}</td>
                <td>{{ $bar->lokasi }}</td>
                <td>{{ $bar->tbKaryawan[0]->npk }}</td>
                <td>{{ $bar->nama_kr }}</td>
                <td>{{ $bar->divisi }}</td>
                <td>{{ $bar->serial_number }}</td>
                <td>{{ $bar->jenis_license }}</td>
                <td>{{ $bar->kode_license }}</td>
                <td>{{ $bar->tanggal_masuk }}</td>


                
    
            </tr>
            @endforeach
        </tbody>
    </table>