<div>
    <div class="container">
        @if ($pilihanMenu=='lihat')
        <h1 class="my-3">Data Member</h1>
        @endif
        @if($pilihanMenu == 'tambah')
        <h1 class="my-3">Tambah Member</h1>
        @endif
        <div class="row">
            <div class="col-12">
                @if ($pilihanMenu=='lihat')
                <div class="my-3" >
                    <button wire:click="pilihMenu('lihat')" class="btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }}">
                         Semua member
                    </button>
                    <button wire:click="pilihMenu('tambah')" class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }}">
                         Tambah member
                    </button>
                    <button wire:loading class="btn btn-info">
                         Loading....
                    </button>
                </div>
                <div class="my-3 d-flex">
                    <input type="text" class="form-control mr-2" placeholder="Cari Member..." wire:model="searchTerm">
                    <button class="btn btn-primary ms-3" wire:click="cariMember">Cari</button>
                </div>
                <div class="card border-primary" style="width: 175%">
                    <div class="card-header">
                        Data member
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nomor Telepon</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $semuaMember as $member)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $member->nama_member }}</td>
                                        <td>{{ $member->nomortelp }}</td>
                                        
                                        <td>
                                            <button wire:click="pilihHapus( {{ $member->id }} )" class="btn {{ $pilihanMenu == 'hapus' ? 'btn-danger' : 'btn-outline-danger' }}">
                                                Hapus member
                                           </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @elseif($pilihanMenu == 'tambah')
                <div class="my-3" >
                    <button wire:click="pilihMenu('lihat')" class="btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }}">
                         Semua member
                    </button>
                    <button wire:click="pilihMenu('tambah')" class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }}">
                         Tambah member
                    </button>
                    <button wire:loading class="btn btn-info">
                         Loading....
                    </button>
                </div>
                <div class="card border-primary " style="width: 125%; margin: 1rem 13rem">
                    <div class="card-header">
                        Tambah member
                    </div>
                    <div class="card-body">
                        <form wire:submit='simpan'>
                            <label>Nama</label>
                            <input type="text" class="form-control" wire:model='nama'/>
                            @error('nama')
                            <span class="text-danger ">{{ $message }}</span> 
                            @enderror
                            <br>
                            <label>Nomor telepon</label>
                            <input type="text" class="form-control" wire:model='notelp'/>
                            @error('notelp')
                            <span class="text-danger ">{{ $message }}</span>
                            @enderror
                            <br>
                            <button type="submit" class="btn btn-primary mr-4 mt-2">SIMPAN</button>
                        </form>
                    </div>
                </div>
                @elseif($pilihanMenu == 'hapus')
                <div class="d-flex justify-content-center align-items-center" style="height: 79vh; width: 80vw">
                    <div class="card border-danger ">
                        <div class="card-header bg-danger text-white">
                            Hapus Member
                        </div>     
                        <div class="card-body">
                            anda yakin akan menghapus member ini?
                            <p>Nama : {{ $penggunaTerpilih->nama_member }}</p>
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
