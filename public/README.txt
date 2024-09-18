composer self-update //update versi composer
composer create-project laravel/laravel name_project 
composer require laravel/ui	
composer require livewire/livewire
php artisan ui:auth yes
php artisan make:seeder Dataawal
php artisan migrate:fresh --seed
npm i -D bootstrap @popperjs/core sass //install bootstrap 5
resources->sass->app.scss @import 'bootstrap/scss/bootstrap';
	 ->js->app.js import * as bootstrap from 'bootstrap';
@vite(['resources/sass/app.scss', 'resources/js/app.js'])
php artisan livewire:layout
php artisan make:livewire Beranda 
php artisan make:model Produk -m
php artisan make:migration create_ add_

DELIMITER $$

CREATE TRIGGER before_user_insert
BEFORE INSERT ON users FOR EACH ROW
BEGIN
  INSERT INTO riwayats (user, action, table_name, data, created_at)
  VALUES (NEW.name, 'CREATE', 'users', JSON_OBJECT('name', NEW.name, 'email', NEW.email), NOW());
END $$

CREATE TRIGGER before_user_delete
BEFORE DELETE ON users FOR EACH ROW
BEGIN
  INSERT INTO riwayats (user, action, table_name, data, created_at)
  VALUES (OLD.name, 'DELETE', 'users', JSON_OBJECT('name', OLD.name, 'email', OLD.email), NOW());
END $$

DELIMITER ;


DELIMITER $$

CREATE TRIGGER before_produk_insert
BEFORE INSERT ON produks FOR EACH ROW
BEGIN
  INSERT INTO riwayats (user, action, table_name, data, created_at)
  VALUES (NEW.nama, 'CREATE', 'produks', JSON_OBJECT('nama', NEW.nama, 'harga', NEW.harga), NOW());
END $$

CREATE TRIGGER before_produk_update
BEFORE UPDATE ON produks FOR EACH ROW
BEGIN
  INSERT INTO riwayats (user, action, table_name, data, created_at)
  VALUES (NEW.nama, 'UPDATE', 'produks', JSON_OBJECT('old_nama', OLD.nama, 'new_nama', NEW.nama), NOW());
END $$

CREATE TRIGGER before_produk_delete
BEFORE DELETE ON produks FOR EACH ROW
BEGIN
  INSERT INTO riwayats (user, action, table_name, data, created_at)
  VALUES (OLD.nama, 'DELETE', 'produks', JSON_OBJECT('nama', OLD.nama, 'harga', OLD.harga), NOW());
END $$

DELIMITER ;


DELIMITER $$

CREATE TRIGGER before_member_insert
BEFORE INSERT ON members FOR EACH ROW
BEGIN
  INSERT INTO riwayats (user, action, table_name, data, created_at)
  VALUES (NEW.nama_member, 'CREATE', 'members', JSON_OBJECT('nama_member', NEW.nama_member, 'nomortelp', NEW.nomortelp), NOW());
END $$

CREATE TRIGGER before_member_update
BEFORE UPDATE ON members FOR EACH ROW
BEGIN
  INSERT INTO riwayats (user, action, table_name, data, created_at)
  VALUES (NEW.nama_member, 'UPDATE', 'members', JSON_OBJECT('old_nama_member', OLD.nama_member, 'new_nama_member', NEW.nama_member), NOW());
END $$

CREATE TRIGGER before_member_delete
BEFORE DELETE ON members FOR EACH ROW
BEGIN
  INSERT INTO riwayats (user, action, table_name, data, created_at)
  VALUES (OLD.nama_member, 'DELETE', 'members', JSON_OBJECT('nama_member', OLD.nama_member, 'nomortelp', OLD.nomortelp), NOW());
END $$

DELIMITER ;

DELIMITER //
CREATE TRIGGER `kurangi_stok_produk_insert` 
AFTER INSERT ON `detil_transaksis`
FOR EACH ROW 
BEGIN
    UPDATE produks 
    SET stok = stok - NEW.jumlah
    WHERE id = NEW.produk_id;
END//
DELIMITER ;


DELIMITER //
CREATE TRIGGER `kurangi_stok_produk_update` 
AFTER UPDATE ON `detil_transaksis`
FOR EACH ROW 
BEGIN
    DECLARE diff INT;
    SET diff = NEW.jumlah - OLD.jumlah;
    UPDATE produks 
    SET stok = stok - diff
    WHERE id = NEW.produk_id;
END//
DELIMITER ;






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
                                            <td>{{ number_format($produk->produk->harga * $produk->jumlah, 2, '.', ',') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            <p>Total Harga: Rp. {{ number_format($TotalSemuaBelanja, 2, '.', ',') }}</p>
                            @if($isMemberVerified)
                                <p>Diskon (20%): Rp. {{ number_format($TotalSemuaBelanja * $diskon / 100, 2, '.', ',') }}</p>
                                <p>Total Setelah Diskon: Rp. {{ number_format($TotalSemuaBelanja * (1 - $diskon / 100), 2, '.', ',') }}</p>
                            @endif
                            <p>Uang Dibayar: Rp. {{ number_format($bayar, 2, '.', ',') }}</p>
                            <p>Kembalian: Rp. {{ number_format($kembalian, 2, '.', ',') }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" wire:click="resetTransaction">Selesai</button>
                            <button type="button" class="btn btn-primary" onclick="window.open('{{ url('/cetakstruk') }}', '_blank')">Cetak</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        @endif
    </div>
</div>







<?php 

namespace App\Livewire;

use App\Models\DetilTransaksi;
use App\Models\Produk;
use App\Models\Member;
use App\Models\Transaksi as ModelsTransaksi;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Transaksi extends Component
{
    public $kode, $total, $kembalian, $TotalSemuaBelanja;
    public $bayar = 0;
    public $transaksiAktif;
    public $nomorTelp, $isMemberVerified = false, $diskon = 0, $errorMessage = '';
    public $showReceipt = false; // Variabel untuk kontrol struk


    public function cetakStruk()
    {
    // Ambil data yang diperlukan
    $transaksiAktif = $this->transaksiAktif;
    $isMemberVerified = $this->isMemberVerified; // Pastikan variabel ini ada

    // Jika ingin mengarahkan ke halaman cetak
    return view('cetak-struk', [
        'transaksiAktif' => $transaksiAktif,
        'isMemberVerified' => $isMemberVerified, // Kirim ke view
    ]);
    }

    public function mount(){
        if (Auth::user()->peran != 'kasir'){
            abort(403);
        }
    }

    public function transaksiBaru(){
        $this->transaksiAktif = new ModelsTransaksi();
        $this->transaksiAktif->kode = 'INV/' . date('YmdHis');
        $this->transaksiAktif->total = 0;
        $this->transaksiAktif->status = 'pending';
        $this->transaksiAktif->save();
    }

    public function verifyMember(){
        $member = Member::where('nomortelp', $this->nomorTelp)->first();
        if($member){
            $this->isMemberVerified = true;
            $this->diskon = 20; // Diskon 20%
            $this->transaksiAktif->member_id = $member->id;
            $this->transaksiAktif->save();
    
            // Tambahkan ini untuk memastikan member terkait disimpan di transaksi
            $this->transaksiAktif->load('member'); // Pastikan relasi 'member' terambil
    
            $this->errorMessage = ''; // Kosongkan error message jika member terverifikasi
        } else {
            $this->errorMessage = 'Nomor tidak terdaftar'; // Set error message jika member tidak ditemukan
        }
    }
    

    public function hapusProduk($id){
        $detil = DetilTransaksi::find($id);
        if($detil) {
            $detil->delete();
        }
    }
    public function transaksiSelesai(){
        $totalBelanja = $this->TotalSemuaBelanja;
        if($this->isMemberVerified){
            $totalBelanja *= (1 - $this->diskon / 100); // Diskon 20% 
        }
        $this->transaksiAktif->total = $totalBelanja;
        $this->transaksiAktif->status = 'selesai';
        $this->transaksiAktif->save();

        $this->showReceipt = true; // Munculkan struk setelah transaksi selesai
        
    }

    public function batalTransaksi(){
        if($this->transaksiAktif){
            $detilTransaksi = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)->get();
            foreach ($detilTransaksi as $detil){
                $detil->delete();
            }
            $this->transaksiAktif->delete();
        }
        $this->reset();
    }


    public function updatedKode(){
        $produk = Produk::where('kode', $this->kode)->first();
        if($produk && $produk->stok > 0){
            $detil = DetilTransaksi::firstOrNew([
                'transaksi_id' => $this->transaksiAktif->id,
                'produk_id' => $produk->id
            ],[
                'jumlah' => 0
            ]);
            $detil->jumlah+=1;
            $detil->save();
            $this->reset('kode');
        }
    }

    public function updatedBayar(){
        if($this->bayar > 0){
            $totalBelanja = $this->TotalSemuaBelanja;
            if($this->isMemberVerified){
                $totalBelanja *= (1 - $this->diskon / 100); // Diskon 20%
            }
            $this->kembalian = $this->bayar - $totalBelanja;
        }
    }

    public function tambahQuantity($id){
        $detil = DetilTransaksi::find($id);
        if($detil && $detil->produk->stok > 0) {
            $detil->jumlah += 1;
            $detil->save();
        }
    }

    public function kurangiQuantity($id){
        $detil = DetilTransaksi::find($id);
        if($detil && $detil->jumlah > 1) {
            $detil->jumlah -= 1;
            $detil->save();
        }
    }

    public function render()
    {
        if($this->transaksiAktif){
            $semuaProduk = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)->get();
            $this->TotalSemuaBelanja = $semuaProduk->sum(function($detil){
                return $detil->produk->harga * $detil->jumlah;
            });
        }else{
            $semuaProduk = [];
        }

        return view('livewire.transaksi')->with([
            'semuaProduk' => $semuaProduk,
            'showReceipt' => $this->showReceipt, // Passing variable to view
        ]);
    }

    public function resetTransaction()
    {
        $this->resetInputFields();
        $this->transaksiAktif = null;
        $this->showReceipt = false;
    }
    
    private function resetInputFields()
    {
        $this->kode = '';
        $this->total = 0;
        $this->kembalian = 0;
        $this->TotalSemuaBelanja = 0;
        $this->bayar = 0;
        $this->nomorTelp = '';
        $this->isMemberVerified = false;
        $this->diskon = 0;
        $this->errorMessage = '';
    }
     
    

}


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('transaksis', function (Blueprint $table) {
        $table->unsignedBigInteger('member_id')->nullable()->after('id');
        $table->foreign('member_id')->references('id')->on('members')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('transaksis', function (Blueprint $table) {
        $table->dropForeign(['member_id']);
        $table->dropColumn('member_id');
    });
}

};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riwayats', function (Blueprint $table) {
            $table->id();
            $table->string('user');
            $table->string('action');
            $table->string('table_name');
            $table->json('data')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayats');
    }
};

