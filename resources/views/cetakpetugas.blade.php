<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Petugas</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
<body onload="print()">
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card border-primary">
                    <div class="card-body">
                        <div class="card-title">Laporan petugas</div>
                        <table class="table table-bordered">
                            <thead>
                                <th>No</th>
                                <th>username</th>
                                <th>Email</th>
                                <th>Peran</th>
                                <th>Tanggal mendaftar</th>
                            </thead>
                            <tbody>
                                @foreach ($laporanPetugas as $petugas)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $petugas->name }}</td>
                                    <td>{{ $petugas->email }}</td>
                                    <td>{{ $petugas->peran }}</td>
                                    <td>{{ $petugas->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>