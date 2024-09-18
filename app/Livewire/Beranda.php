<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member;
use App\Models\Produk;
use App\Models\User;
use App\Models\Transaksi;

class Beranda extends Component
{
    public $jumlahProduk;
    public $jumlahMember;
    public $jumlahKasir;
    public $jumlahTransaksi;

    public function mount()
    {
        $this->jumlahProduk = Produk::count();
        $this->jumlahMember = Member::count();
        $this->jumlahKasir = User::where('peran', 'kasir')->count();
        $this->jumlahTransaksi = Transaksi::count();
    }

    public function render()
    {
        return view('livewire.beranda');
    }
}
