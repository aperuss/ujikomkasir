<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Member</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
<body onload="print()">
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card border-primary">
                    <div class="card border-primary" >
                        <div class="card-body">
                            <div class="card-title">Laporan member</div>
                            <table class="table table-bordered">
                                <thead>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nomor telepon.</th>
                                    <th>Tanggal mendaftar</th>
                                </thead>
                                <tbody>
                                    @foreach ($laporanMember as $member)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $member->nama_member }}</td>
                                        <td>{{ $member->nomortelp }}</td>
                                        <td>{{ $member->created_at}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>