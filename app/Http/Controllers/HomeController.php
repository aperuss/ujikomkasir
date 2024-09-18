<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Member;
use App\Models\User;
use App\Models\Produk;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function cetaktransaksi(){
        $laporanTransaksi = Transaksi::where('status', 'selesai')->get();
        return view('cetaktransaksi')->with([
            'laporanTransaksi' => $laporanTransaksi 
        ]);
    }
    public function cetakmember(){
        $laporanMember = Member::all();
        return view('cetakmember')->with([
            'laporanMember' => $laporanMember
        ]);
    }
    public function cetakpetugas(){
        $laporanPetugas = User::where('peran', 'kasir')->get();
        return view('cetakpetugas')->with([
            'laporanPetugas' => $laporanPetugas
        ]);
    }
    public function cetakproduk(){
        $laporanProduk = Produk::all();
        return view('cetakproduk')->with([
            'laporanProduk' => $laporanProduk
        ]);
    }
    public function cetakstruk(){
        $semuaProduk = Produk::all();
        return view('cetak-struk')->with([
            'semuaProduk' => $semuaProduk
        ]);
    }
    
}
