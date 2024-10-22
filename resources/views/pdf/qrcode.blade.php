{{-- <!-- resources/views/pdf/users.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Data Pengguna</h2>
    {!! QrCode::size(256)->generate('https://google.com') !!}
    
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Umur</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barang as $b)
            <tr>
                <td><img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(256)->generate( $b->nama_kr )) !!} "></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampilan Teks</title>
    <style>
        table {
            /* width: 100%; Menggunakan lebar penuh */
            /* width: 50%; */
            border-collapse: collapse;
            
        }
        td {
            width: 16.66%; /* 6 kolom */
            text-align: center;
            padding: 5px; /* Jarak dalam sel */
        }
    </style>
</head>
<body>
    <table >
        <tr>
            @foreach($barang as $b)
            
                <td>
                    <div;>
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(110)->generate( $b->no_asset )) !!} ">
                        <br>{{ $b->no_asset }}
                    </div>
                </td>
                @if ($loop->iteration % 6 == 0) <tr></tr> @endif
            @endforeach
            {{-- @if ($loop->iteration % 6 == 0) </tr><tr> @endif --}}
        </tr>
    </table>
</body>
</html>

