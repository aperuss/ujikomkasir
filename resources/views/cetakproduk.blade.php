<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Produk</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
<body onload="print()">
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card border-primary">
                    <div class="card-body">
                        <div class="card-title">Laporan produk</div>
                        <table class="table table-bordered">
                            <thead>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Tanggal penambahan</th>
                            </thead>
                            <tbody>
                                @foreach ($laporanProduk as $produk)
                                <tr>
                                   <td>{{ $loop->iteration }}</td>
                                   <td>{{ $produk->kode }}</td>
                                   <td>{{ $produk->nama }}</td>
                                   <td>{{ $produk->harga }}</td>
                                   <td>{{ $produk->stok }}</td>
                                   <td>{{ $produk->created_at }}</td>
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