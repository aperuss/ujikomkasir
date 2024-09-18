<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produk as ModelProduk;
use Illuminate\Support\Facades\Auth;

class Produk extends Component
{
    public $pilihanMenu= 'lihat';
    public $nama;
    public $kode;
    public $harga;
    public $stok;
    public $produkTerpilih;
    public $searchTerm = '';
    public $semuaProduk;

    public function mount(){
        if (Auth::user()->peran != 'admin'){
            abort(403);
        }
       
        $this->semuaProduk = ModelProduk::all();
    }

    public function cariProduk()
    {
        $this->semuaProduk = ModelProduk::where('nama', 'like', '%' . $this->searchTerm . '%')->get();
    }

    public function pilihEdit($id){
        $this->produkTerpilih = ModelProduk::findOrFail($id); 
        $this->nama = $this->produkTerpilih->nama;
        $this->kode = $this->produkTerpilih->kode;
        $this->harga = $this->produkTerpilih->harga;
        $this->stok = $this->produkTerpilih->stok;
        $this->pilihanMenu = 'edit';
    }

    public function simpanEdit(){
        $this->validate([
            'nama' => 'required',
            'kode' => ['required', 'unique:produks,kode,'.$this->produkTerpilih->id],
            'harga' => 'required',
            'stok' => 'required'
        ],[
            'nama.required' => 'Nama Harus Diisi',
            'kode.required' => 'Kode Harus Diisi',
            'kode.unique' => 'Kode Telah Digunakan',
            'harga.required' => 'Harga Harus Diisi',
            'stok.required' => 'Stok Harus Diisi'
        ]);

        $simpan = $this->produkTerpilih;
        $simpan->nama = $this->nama;
        $simpan->kode = $this->kode;
        $simpan->stok = $this->stok;
        $simpan->harga = $this->harga; 
        $simpan->save();

        $this->reset(); 
        $this->pilihanMenu = 'lihat';
    }

    public function pilihHapus($id){
        $this->produkTerpilih = ModelProduk::findOrFail($id); 
        $this->pilihanMenu = 'hapus';
    }

    public function hapus(){
        $this->produkTerpilih->delete();
        $this->reset();
    }

    public function batal(){
        $this->reset();
    }

    public function simpan(){
        $this->validate([
            'nama' => 'required',
            'kode' => ['required', 'unique:produks,kode'],
            'harga' => 'required',
            'stok' => 'required'
        ],[
            'nama.required' => 'Nama Harus Diisi',
            'kode.required' => 'Kode Harus Diisi',
            'kode.unique' => 'Kode Telah Digunakan',
            'harga.required' => 'Harga Harus Diisi',
            'stok.required' => 'Stok Harus Diisi'
        ]);

        $simpan = new ModelProduk();
        $simpan->nama = $this->nama;
        $simpan->kode = $this->kode;
        $simpan->stok = $this->stok;
        $simpan->harga = $this->harga; 
        $simpan->save();

        $this->reset();
        $this->pilihanMenu = 'lihat';
    } 

    public function pilihMenu($menu){
        $this->pilihanMenu = $menu;
    }

    public function render()
    {
        $semuaProduk = $this->cariProduk();
        return view('livewire.produk')->with([
            'semuaProduk' => $semuaProduk
        ]);
    }
}
