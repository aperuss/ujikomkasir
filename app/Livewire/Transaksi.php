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
