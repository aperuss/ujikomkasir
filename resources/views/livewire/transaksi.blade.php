<div>
    <div class="container mb-5">
        <div class="row mt-2">
            <div class="col-12">
                @if($transaksiAktif)
                    <h1>Transaksi</h1>
                @endif
                @if(!$transaksiAktif)
                    <div class="h5 d-flex w-auto h-auto justify-content-center align-items">
                        Selamat datang di menu transaksi, silahkan tekan tombol Transaksi baru untuk mulai bertransaksi
                    </div>
                    <div class="btn btn-primary" wire:click='transaksiBaru'>Transaksi baru</div>
                @else
                    <div class="btn btn-danger" wire:click='batalTransaksi'>Batal transaksi</div>
                @endif
                <button class="btn btn-info" wire:loading>loading...</button>
            </div>
        </div>
        @if($transaksiAktif)
            <div class=" my-2">
                <!-- Form Verifikasi Member -->
                @if(!$isMemberVerified)
                    <div class="card border-primary">
                        <div class="card-body">
                            <h4 class="card-title">Verifikasi Member</h4>
                            <input type="text" class="form-control" placeholder="Nomor Telepon Member" wire:model.live='nomorTelp'>
                            <button class="btn btn-primary mt-2" wire:click='verifyMember'>Verifikasi</button>
                            @if($errorMessage)
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $errorMessage }}
                                </div>
                            @endif
                        </div>
                    </div>
                @elseif($isMemberVerified)
                    <div class="alert alert-success mt-2" role="alert">
                        Member terverifikasi! Diskon 20% diterapkan.
                    </div>
                @endif
            </div>
            <div style="width: 77rem">  
                <div class="row mt-2">
                    <div class="col-8">
                        <div class="card border-primary">
                            <div class="card-body">
                                <h4 class="card-title">No Invoice: {{ $transaksiAktif->kode }}</h4>
                                <input type="text" class="form-control" placeholder="Kode Barang" wire:model.live='kode'>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($semuaProduk as $produk)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $produk->produk->kode }}</td>
                                                <td>{{ $produk->produk->nama }}</td>
                                                <td>{{ number_format($produk->produk->harga, 2, '.', ',') }}</td> 
                                                <td>
                                                    <button class="btn btn-sm btn-danger" wire:click='kurangiQuantity({{ $produk->id }})'>-</button>
                                                    <button class="btn btn-sm btn-success" wire:click='tambahQuantity({{ $produk->id }})'>+</button>
                                                    <span class="mx-2">{{ $produk->jumlah }}</span>
                                                </td>
                                                <td>{{ number_format($produk->produk->harga * $produk->jumlah, 2, '.', ',') }}</td>
                                                <td>
                                                    <button class="btn btn-danger" wire:click='hapusProduk({{ $produk->id }})'>Hapus</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card border-primary">
                            <div class="card-body">
                                <h4 class="card-title">Total Biaya</h4>
                                <div class="d-flex justify-content-between">
                                    <span>Rp.</span>
                                    <span>{{ number_format($TotalSemuaBelanja * (1 - ($isMemberVerified ? $diskon / 100 : 0)), 2, '.', ',') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card border-primary mt-2">
                            <div class="card-body">
                                <h4 class="card-title">Bayar</h4>
                                <input type="number" class="form-control" placeholder="Bayar" wire:model.live='bayar'>
                            </div>
                        </div>
                        <div class="card border-primary mt-2">
                            <div class="card-body">
                                <h4 class="card-title">Kembalian</h4>
                                <div class="d-flex justify-content-between">
                                    <span>Rp.</span>
                                    <span>{{ number_format($kembalian, 2, '.', ',') }}</span>
                                </div>
                            </div>
                        </div>
                        @if ($bayar)
                            @if($kembalian < 0 )
                                <div class="alert alert-danger mt-2" role="alert">
                                    Uang kurang
                                </div>
                            @elseif ($kembalian >= 0)
                                <button class="btn btn-success mt-2 w-100" wire:click='transaksiSelesai'>Bayar</button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            @if($showReceipt)
            <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background-color: rgba(0,0,0,0.5);">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Struk Transaksi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetTransaction"></button>
                        </div>
                        <div class="modal-body">
                            <h3 class="text-center">Kasir Yahahayuuk</h3>
                            <p class="text-center">Jl. Jahanam Barat No 13, Neraka</p>
                            <p>ID Kasir: {{ Auth::user()->id }}</p>
                            <p>Nama Kasir: {{ Auth::user()->name }}</p>
                            <p>Tanggal: {{ now()->format('Y-m-d H:i:s') }}</p>
                            <hr>
                            <!-- Informasi Member -->
                            @if($isMemberVerified && $transaksiAktif->member)
                            <p>Nama Member: {{ $transaksiAktif->member->nama_member }}</p>
                            {{-- <p>Nomor Telepon: {{ $transaksiAktif->member->nomortelp }}</p> --}}
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
                            <p>Total Harga: Rp. {{ number_format($TotalSemuaBelanja, 2, ',', '.') }}</p>
                            @if($isMemberVerified)
                                <p>Diskon (20%): Rp. {{ number_format($TotalSemuaBelanja * $diskon / 100, 2, ',', '.') }}</p>
                                <p>Total Setelah Diskon: Rp. {{ number_format($TotalSemuaBelanja * (1 - $diskon / 100), 2, ',', '.') }}</p>
                            @endif
                            <p>Uang Dibayar: Rp. {{ number_format($bayar, 2, ',', '.') }}</p>
                            <p>Kembalian: Rp. {{ number_format($kembalian, 2, ',', '.') }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" wire:click="resetTransaction">Selesai</button>
        
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        @endif
    </div>
</div>
