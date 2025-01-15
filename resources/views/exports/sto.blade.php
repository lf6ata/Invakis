<!-- resources/views/exports/users.blade.php -->

<table>
    <thead>
        <tr>
            <th colspan="7" style="text-align:center; padding:50px;">Rekap Stok Opname</th>
        </tr>
        <tr>
            <th>No</th>
            <th>No Asset</th>
            <th>Nama Barang</th>
            <th>Lokasi</th>
            <th>User</th>
            <th>Status</th>
            <th>Tanggal Sto</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sto_export as $no => $sto)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td>{{ $sto->no_asset }}</td>
                <td>{{ $sto->tbBarang[0]->tbCategori[0]->categori }}</td>
                <td>{{ $sto->tbBarang[0]->tbZona[0]->lokasi }}</td>
                <td>{{ $sto->user }}</td>
                <td>{{ $sto->status }}</td>
                <td>{{ $sto->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
