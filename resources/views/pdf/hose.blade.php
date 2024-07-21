<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Hose</title>
    <style>
        .titleLaporan {
            margin-left: 385px;
        }

        .tableLaporan {
            margin-left: 25px;
        }

        table {
            border-collapse: collapse;
        }

        td {
            border: black 1x solid;
            padding: 5px;
            margin: 0px;
        }

        th {
            border: black 1x solid;
            padding: 5px;
            margin: 0px;
        }
    </style>
</head>

<body>
    <center>
        <img src="{{ public_path() . '/logo.jpeg' }}" alt="logo" width="270px">
    </center>
    <div class="titleLaporan">
        <h3>Laporan Data Management Hose</h3>
    </div>
    <center>
        <p>{{ $tanggalAwal }} - {{ $tanggalAkhir }}</p>
    </center>
    <div class="tableLaporan">
        @if ($hose == '[]')
            <center>
                <p>Data Tidak Ditemukan!</p>
            </center>
        @else
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Nama Hose</th>
                        <th>Mesin</th>
                        <th>Spesifikasi</th>
                        <th>Manufacture Date</th>
                        <th>Stok</th>
                        <th>Factory</th>
                        <th>Last Update By</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hose as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->code }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->Machine->name }}</td>
                            <td style="width: 150px">{{ $value->spesifikasi }}</td>
                            <td>{{ $value->date }}</td>
                            <td>{{ $value->stock }}</td>
                            <td>{{ $value->Gudang->name }}</td>
                            <td>{{ $value->User->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>

</html>
