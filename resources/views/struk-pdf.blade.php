<h3 class="text-center">Kasir Yahahayuuk</h3>
<p class="text-center">Jl. Jahanam Barat No 13, Neraka</p>
<p>ID Kasir: {{ Auth::user()->id }}</p>
<p>Nama Kasir: {{ Auth::user()->name }}</p>
<p>Tanggal: {{ now()->format('Y-m-d H:i:s') }}</p>
<hr>

<!-- Informasi Member -->
@if($isMemberVerified && $transaksi->member)
<p>Nama Member: {{ $transaksi->member->nama_member }}</p>
{{-- <p>Nomor Telepon: {{ $transaksi->member->nomortelp }}</p> --}}
<hr>
@endif

<!-- Daftar Produk -->
<table class="table table-sm">
    <thead>
        <tr>
            <th>Produk</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($semuaProduk as $produk)
            <tr>
                <td>{{ $produk->produk->nama }}</td>
                <td>{{ $produk->jumlah }}</td>
                <td>{{ number_format($produk->produk->harga * $produk->jumlah, 2, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<hr>

<p>Total Harga: Rp. {{ number_format($transaksi->total, 2, ',', '.') }}</p>
@if($isMemberVerified)
    <p>Diskon (20%): Rp. {{ number_format($transaksi->total * $diskon / 100, 2, ',', '.') }}</p>
    <p>Total Setelah Diskon: Rp. {{ number_format($transaksi->total * (1 - $diskon / 100), 2, ',', '.') }}</p>
@endif
<p>Uang Dibayar: Rp. {{ number_format($bayar, 2, ',', '.') }}</p>
<p>Kembalian: Rp. {{ number_format($kembalian, 2, ',', '.') }}</p>