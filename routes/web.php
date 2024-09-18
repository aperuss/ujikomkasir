<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Beranda;
use App\Livewire\User;
use App\Livewire\Laporan;
use App\Livewire\Member;
use App\Livewire\Produk;
use App\Livewire\Transaksi;
use App\Livewire\Riwayat;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\PrintOutController;

Route::get('/', function () {
    return view('auth/login');
});
// Route::get('/cetakstruk', function () {
//     return view('cetak-struk'); // Halaman yang menampilkan tampilan cetak struk
// });

Auth::routes(['register' => false]);
Route::get('/home', Beranda::class)->middleware(['auth'])->name('home');
Route::get('/user', User::class)->middleware(['auth'])->name('user');
Route::get('/laporan', Laporan::class)->middleware(['auth'])->name('laporan');
Route::get('/produk', Produk::class)->middleware(['auth'])->name('produk');
Route::get('/transaksi', Transaksi::class)->middleware(['auth'])->name('transaksi');
Route::get('/member', Member::class)->middleware(['auth'])->name('member');
Route::get('/riwayat', Riwayat::class)->middleware(['auth'])->name('riwayat');
Route::get('/cetaktransaksi', ['App\Http\Controllers\HomeController', 'cetaktransaksi']);
Route::get('/cetakmember', ['App\Http\Controllers\HomeController', 'cetakmember']);
Route::get('/cetakpetugas', ['App\Http\Controllers\HomeController', 'cetakpetugas']);
Route::get('/cetakproduk', ['App\Http\Controllers\HomeController', 'cetakproduk']);
// Route::get('/print/out', [PrintOutController::class, 'index'])->name('print.out');
// Route::get('/cetakstruk', ['App\Http\Controllers\HomeController', 'cetakstruk']);