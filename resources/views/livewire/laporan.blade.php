<div>
   <div class="container">
        @if ($pilihanMenu=='kosong')
        <h1 class="my-3">Pilih laporan</h1>
        @endif
        @if ($pilihanMenu=='lihattransaksi')
        <h1 class="my-3">Laporan Transaksi</h1>
        @endif
        @if($pilihanMenu == 'lihatmember')
        <h1 class="my-3">Laporan Member</h1>
        @endif
        @if($pilihanMenu == 'lihatproduk')
        <h1 class="my-3">Laporan Produk</h1>
        @endif
        @if($pilihanMenu== 'lihatpetugas')
        <h1 class="my-3">Laporan Petugas</h1>
        @endif
        <div class="row" >
            <div class="col-12 my-3" >
                <button wire:click="pilihMenu('lihattransaksi')" class="btn {{ $pilihanMenu == 'lihattransaksi' ? 'btn-primary' : 'btn-outline-primary' }}">
                     laporan transaksi
                </button>
                <button wire:click="pilihMenu('lihatmember')" class="btn {{ $pilihanMenu == 'lihatmember' ? 'btn-primary' : 'btn-outline-primary' }}">
                     laporan member
                </button>
                <button wire:click="pilihMenu('lihatproduk')" class="btn {{ $pilihanMenu == 'lihatproduk' ? 'btn-primary' : 'btn-outline-primary' }}">
                     laporan produk
                </button>
                @if (Auth::user()->peran == 'admin')
                    <button wire:click="pilihMenu('lihatpetugas')" class="btn {{ $pilihanMenu == 'lihatpetugas' ? 'btn-primary' : 'btn-outline-primary' }}">
                         laporan petugas
                    </button>
                @endif
            </div>
        </div>
    <div class="row mt-3">
        <div class="col-12">
            @if ($pilihanMenu=='lihattransaksi')
            <div class="card border-primary mb-4" style="width: 175%">
                <div class="card-body">
                    <div class="card-title">Laporan transaksi</div>
                    <a href="{{ url('/cetaktransaksi') }}" target="_blank">Cetak</a>
                    <table class="table table-bordered">
                        <thead>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>No inv.</th>
                            <th>Id member</th>
                            <th>Total</th>
                        </thead>
                        <tbody>
                            @foreach ($laporanTransaksi as $transaksi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaksi->created_at }}</td>
                                <td>{{ $transaksi->kode }}</td>
                                <td>{{ $transaksi->member_id }}</td>
                                <td>Rp. {{ number_format($transaksi->total,2,'.',',') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @elseif ($pilihanMenu=='lihatmember')
            <div class="card border-primary" style="width: 175%">
                <div class="card-body">
                    <div class="card-title">Laporan member</div>
                    <a href="{{ url('/cetakmember') }}" target="_blank">Cetak</a>
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
            @elseif ($pilihanMenu=='lihatproduk')
            <div class="card border-primary" style="width: 175%">
                <div class="card-body">
                    <div class="card-title">Laporan produk</div>
                    <a href="{{ url('/cetakproduk') }}" target="_blank">Cetak</a>
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
            @elseif ($pilihanMenu=='lihatpetugas')
            <div class="card border-primary" style="width: 175%">
                <div class="card-body">
                    <div class="card-title">Laporan petugas</div>
                    <a href="{{ url('/cetakpetugas') }}" target="_blank">Cetak</a>
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
            @endif
        </div>
    </div>
   </div>
</div>
