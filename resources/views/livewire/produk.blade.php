<div>
    <div class="container">
        @if ($pilihanMenu=='lihat')
        <h1 class="my-3">Data Produk</h1>
        @endif
        @if($pilihanMenu == 'tambah')
        <h1 class="my-3">Tambah Produk</h1>
        @endif
        @if($pilihanMenu == 'edit')
        <h1 class="my-3">Edit Produk</h1>
        @endif
        <div class="row">
            <div class="col-12">
                @if ($pilihanMenu=='lihat')
                <div class="my-2">
                    <button wire:click="pilihMenu('lihat')" class="btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }}">
                         Semua Produk
                    </button>
                    <button wire:click="pilihMenu('tambah')" class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }}">
                         Tambah Produk
                    </button>
                    <button wire:loading class="btn btn-info">
                         Loading....
                    </button>
                </div>
                <div class="my-3 d-flex">
                    <input type="text" class="form-control mr-2" placeholder="Cari Produk..." wire:model="searchTerm">
                    <button class="btn btn-primary ms-3" wire:click="cariProduk">Cari</button>
                </div>
                <div class="card border-primary" style="width: 175%">
                    <div class="card-header">
                        Semua produk
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Data</th>
                            </thead>
                            <tbody>
                                @foreach ($semuaProduk as $produk)
                                    <tr>
                                        <td>{{ $loop->iteration}}</td>
                                        <td>{{ $produk->kode}}</td>
                                        <td>{{ $produk->nama }}</td>
                                        <td>{{ $produk->harga }}</td>
                                        <td>{{ $produk->stok }}</td>
                                        <td>
                                            <button wire:click="pilihEdit({{ $produk->id }})" class="btn {{ $pilihanMenu == 'edit' ? 'btn-primary' : 'btn-outline-primary' }}">
                                                Edit produk
                                           </button>
                                           <button wire:click="pilihHapus({{ $produk->id }})" class="btn {{ $pilihanMenu == 'hapus' ? 'btn-danger' : 'btn-outline-danger' }}">
                                            Hapus produk
                                       </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @elseif ($pilihanMenu=='tambah') 
                <div class="my-2">
                    <button wire:click="pilihMenu('lihat')" class="btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }}">
                         Semua Produk
                    </button>
                    <button wire:click="pilihMenu('tambah')" class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }}">
                         Tambah Produk
                    </button>
                    <button wire:loading class="btn btn-info">
                         Loading....
                    </button>
                </div>   
                <div class="d-flex justify-content-center align-items-center" style="width: 80vw; height:auto">
                    <div class="card border-primary" style="width:80%" >
                        <div class="card-header">
                            Tambah produk
                        </div>
                        <div class="card-body">
                            <form wire:submit='simpan'>
                                <label>Nama</label>
                                <input type="text" class="form-control" wire:model='nama'/>
                                @error('nama')
                                <span class="text-danger ">{{ $message }}</span>
                                @enderror
                                <br>
                                <label>Kode</label>
                                <input type="text" class="form-control" wire:model='kode'/>
                                @error('kode')
                                <span class="text-danger ">{{ $message }}</span>
                                @enderror
                                <br>
                                <label>Harga</label>
                                <input type="number" class="form-control" wire:model='harga'/>
                                @error('harga')
                                <span class="text-danger "> {{ $message }}</span>
                                @enderror
                                <br>
                                <label>Stok</label>
                                <input type="number" class="form-control" wire:model='stok'/>
                                @error('stok')
                                <span class="text-danger "> {{ $message }}</span>
                                @enderror
                                <br>
                                <button type="submit" class="btn btn-primary mr-4 mt-2">SIMPAN</button>
                            </form>
                        </div>
                    </div>
                </div>
                @elseif ($pilihanMenu=='edit')  
                <div class="d-flex justify-content-center align-items-center" style="width: 80vw; height:auto"> 
                    <div class="card border-primary" style="width:80%">
                        <div class="card-header">
                            Edit produk
                        </div>
                        <div class="card-body">
                            <form wire:submit='simpanEdit'>
                                <label>Nama</label>
                                <input type="text" class="form-control" wire:model='nama'/>
                                @error('nama')
                                <span class="text-danger ">{{ $message }}</span>
                                @enderror
                                <br>
                                <label>Kode</label>
                                <input type="text" class="form-control" wire:model='kode'/>
                                @error('kode')
                                <span class="text-danger ">{{ $message }}</span>
                                @enderror
                                <br>
                                <label>Harga</label>
                                <input type="number" class="form-control" wire:model='harga'/>
                                @error('harga')
                                <span class="text-danger "> {{ $message }}</span>
                                @enderror
                                <br>
                                <label>Stok</label>
                                <input type="number" class="form-control" wire:model='stok'/>
                                @error('stok')
                                <span class="text-danger "> {{ $message }}</span>
                                @enderror
                                <br>
                                <button type="submit" class="btn btn-primary mr-4 mt-2">SIMPAN</button>
                                <button type="button" wire:click='batal' class="btn btn-secondary mr-4 mt-2">BATAL</button>
                            </form>
                        </div>
                    </div>
                </div>
                @elseif ($pilihanMenu=='hapus')   
                <div class="d-flex justify-content-center align-items-center" style="height: 79vh; width: 80vw">
                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white">
                            Hapus produk
                        </div>
                        <div class="card-body">
                            Anda yakin akan menghapus produk ini?
                            <br>
                            Nama : {{ $produkTerpilih->nama}}
                            <br>
                            Kode : {{ $produkTerpilih->kode}}
                            <br>
                            <br>
                            <button class="btn btn-danger" wire:click='hapus'>Hapus</button>
                            <button class="btn btn-secondary" wire:click='batal'>Batal</button>
                        </div>
                    </div> 
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
