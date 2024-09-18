<div>
    <div class="container">
        @if ($pilihanMenu=='lihat')
        <h1 class="my-3">Data Petugas</h1>
        @endif
        @if($pilihanMenu == 'tambah')
        <h1 class="my-3">Tambah Petugas</h1>
        @endif
        @if($pilihanMenu == 'edit')
        <h1 class="my-3">Edit Petugas</h1>
        @endif
        <div class="row" >
            <div class="col-12">
                @if ($pilihanMenu=='lihat')
                    <div class="my-3" >
                        <button wire:click="pilihMenu('lihat')" class="btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }}">
                             Semua petugas
                        </button>
                        <button wire:click="pilihMenu('tambah')" class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }}">
                             Tambah petugas
                        </button>
                        <button wire:loading class="btn btn-info">
                             Loading....
                        </button>
                    </div>
                    <div class="my-3 d-flex">
                        <input type="text" class="form-control mr-2" placeholder="Cari Petugas..." wire:model="searchTerm">
                        <button class="btn btn-primary ms-3" wire:click="cariPengguna">Cari</button>
                    </div>
                <div class="card border-primary" style="width: 175%">
                    <div class="card-header">
                        Semua petugas
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Peran</th>
                                <th>Data</th>
                            </thead>
                            <tbody>
                                @foreach ($semuaPengguna as $pengguna)
                                    @if ($pengguna->peran == 'kasir')   
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{ $pengguna->name }}</td>
                                            <td>{{ $pengguna->email }}</td>
                                            <td>{{ $pengguna->peran }}</td>
                                            <td>
                                                <button wire:click="pilihEdit({{ $pengguna->id }})" class="btn {{ $pilihanMenu == 'edit' ? 'btn-primary' : 'btn-outline-primary' }}">
                                                    Edit pengguna
                                                </button>
                                                <button wire:click="pilihHapus({{ $pengguna->id }})" class="btn {{ $pilihanMenu == 'hapus' ? 'btn-danger' : 'btn-outline-danger' }}">
                                                    Hapus pengguna
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @elseif ($pilihanMenu=='tambah')    
                    <div class="my-3" >
                        <button wire:click="pilihMenu('lihat')" class="btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }}">
                             Semua petugas
                        </button>
                        <button wire:click="pilihMenu('tambah')" class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }}">
                             Tambah petugas
                        </button>
                        <button wire:loading class="btn btn-info">
                             Loading....
                        </button>
                    </div>
                <div class="d-flex justify-content-center align-items-center" style="width: 80vw; height:auto">
                    <div class="card border-primary" style="width: 80%">
                        <div class="card-header">
                            Tambah pengguna
                        </div>
                        <div class="card-body">
                            <form wire:submit='simpan'>
                                <label>Nama</label>
                                <input type="text" class="form-control" wire:model='nama'/>
                                @error('nama')
                                <span class="text-danger ">{{ $message }}</span>
                                @enderror
                                <br>
                                <label>Email</label>
                                <input type="email" class="form-control" wire:model='email'/>
                                @error('email')
                                <span class="text-danger ">{{ $message }}</span>
                                @enderror
                                <br>
                                <label>Password</label>
                                <input type="password" class="form-control" wire:model='password'/>
                                @error('password')
                                <span class="text-danger "> {{ $message }}</span>
                                @enderror
                                <br>
                                <label>Peran</label>
                                <select class="form-control" wire:model='peran'>
                                <option>--Pilih peran--</option>
                                <option value="kasir">kasir</option>
                                {{-- <option value="admin">admin</option> --}}
                                </select>
                                @error('peran')
                                <span class="text-danger "> {{ $message }}</span>
                                @enderror
                                <button type="submit" class="btn btn-primary mr-4 mt-2">SIMPAN</button>
                            </form>
                        </div>
                    </div>
                </div>
                @elseif ($pilihanMenu=='edit') 
                <div class="d-flex justify-content-center align-items-center" style="width: 80vw; height:auto">
                    <div class="card border-primary" style="width: 80%">
                        <div class="card-header">
                            Edit pengguna
                        </div>
                        <div class="card-body">
                            <form wire:submit='simpanEdit'>
                                <label>Nama</label>
                                <input type="text" class="form-control" wire:model='nama'/>
                                @error('nama')
                                <span class="text-danger ">{{ $message }}</span>
                                @enderror
                                <br>
                                <label>Email</label>
                                <input type="email" class="form-control" wire:model='email'/>
                                @error('email')
                                <span class="text-danger ">{{ $message }}</span>
                                @enderror
                                <br>
                                <label>Password</label>
                                <input type="password" class="form-control" wire:model='password'/>
                                @error('password')
                                <span class="text-danger "> {{ $message }}</span>
                                @enderror
                                <br>
                                <label>Peran</label>
                                <select class="form-control" wire:model='peran'>
                                <option >--Pilih peran--</option>
                                <option value="kasir">kasir</option>
                                {{-- <option value="admin">admin</option> --}}
                                </select>
                                @error('peran')
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
                            <div class="card-header bg-danger text-white text-center">
                                Hapus pengguna
                            </div>
                            <div class="card-body text-center">
                                <p>Anda yakin akan menghapus pengguna ini?</p>
                                <p>Nama : {{ $penggunaTerpilih->name }}</p>
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
