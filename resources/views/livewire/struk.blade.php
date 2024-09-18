<!-- resources/views/livewire/struk.blade.php -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Kasir Jahanam</h2>
                    <p class="text-center">Jl. Jahanam Barat No 13, Neraka</p>
                    <p class="text-center">ID Kasir: {{ Auth::user()->id }}</p>
                    <p class="text-center">Nama Kasir: {{ Auth::user()->name }}</p>
                    <p class="text-center">Tanggal Transaksi: {{ date('d-m-Y H:i:s') }}</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semuaProduk as $produk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $produk->produk->nama }}</td>
                                <td>{{ $produk->jumlah }}</td>
                                <td>{{ number_format($produk->produk->harga * $produk->jumlah, 2, '.', ',') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">Total Harga</td>
                                <td>{{ number_format($TotalSemuaBelanja * (1 - ($isMemberVerified ? $diskon / 100 : 0)), 2, '.', ',') }}</td>
                            </tr>
                            <tr>
                                <td colspan="3">Uang yang Dibayar</td>
                                <td>{{ number_format($bayar, 2, '.', ',') }}</td>
                            </tr>
                            <tr>
                                <td colspan="3">Kembalian</td>
                                <td>{{ number_format($kembalian, 2, '.', ',') }}</td>
                            </tr>
                            @if ($isMemberVerified)
                            <tr>
                                <td colspan="3">Diskon</td>
                                <td>{{ $diskon }}%</td>
                            </tr>
                            @endif
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>