<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi;
use App\Models\Member;
use App\Models\User;
use App\Models\Produk;

class Laporan extends Component
{
    public $pilihanMenu = 'kosong';

    public function pilihMenu($menu){
        $this->pilihanMenu = $menu;
    }
    public function render()
    {
    $laporanTransaksi = Transaksi::where('status', 'selesai')->get();
    $laporanMember = Member::all(); 
    $laporanProduk = Produk::all();
    $laporanPetugas = User::where('peran', 'kasir')->get();
    
    return view('livewire.laporan')->with([
        'laporanTransaksi' => $laporanTransaksi,
        'laporanMember' => $laporanMember,
        'laporanProduk' => $laporanProduk,
        'laporanPetugas' => $laporanPetugas
    ]);
    }
}
