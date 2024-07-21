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
            margin-left: 70px;
            margin-top: 50px;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <center>
        <img src="{{ public_path() . '/logo.jpeg' }}" alt="logo" width="270px">
    </center>
    <div class="tableLaporan">
        <table>
            <tbody>
                <tr>
                    <td style="width: 150px">ID</td>
                    <td style="width: 20px">:</td>
                    <td>{{ $hose->id }}</td>
                </tr>
                <tr>
                    <td>Code</td>
                    <td>:</td>
                    <td>{{ $hose->code }}</td>
                </tr>
                <tr>
                    <td>Nama Hose</td>
                    <td>:</td>
                    <td>{{ $hose->name }}</td>
                </tr>
                <tr>
                    <td>Mesin</td>
                    <td>:</td>
                    <td>{{ $hose->Machine->name }}</td>
                </tr>
                <tr>
                    <td>Spesifikasi</td>
                    <td>:</td>
                    <td>{{ $hose->spesifikasi }}</td>
                </tr>
                <tr>
                    <td>Manufacture Date</td>
                    <td>:</td>
                    <td>{{ $hose->date }}</td>
                </tr>
                <tr>
                    <td>Stok</td>
                    <td>:</td>
                    <td>{{ $hose->stock }}</td>
                </tr>
                <tr>
                    <td>Factory</td>
                    <td>:</td>
                    <td>{{ $hose->Gudang->name }}</td>
                </tr>
                <tr>
                    <td>Last Update By</td>
                    <td>:</td>
                    <td>{{ $hose->User->name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
