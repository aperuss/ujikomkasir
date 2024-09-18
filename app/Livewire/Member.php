<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member as ModelMember;

class Member extends Component
{
    public $pilihanMenu = 'lihat';
    public $nama;
    public $notelp;
    public $penggunaTerpilih;
    public $searchTerm = ''; // Variabel untuk pencarian

    public function hapus(){
        $this->penggunaTerpilih->delete();
        $this->reset();
    }

    public function batal(){
        $this->reset();
    }

    public function pilihHapus($id){
        $this->penggunaTerpilih = ModelMember::findOrFail($id);
        $this->pilihanMenu ='hapus';
    }

    public function simpan(){
        $this->validate([
            'nama'=>'required',
            'notelp'=> ['required', 'unique:members,nomortelp']
        ],[
            'nama.required' => 'Nama harus diisi',
            'notelp.required' => 'Nomor telepon harus diisi',
            'notelp.unique' => 'Nomor telepon sudah digunakan'
        ]);
        $simpan = new ModelMember();
        $simpan->nama_member = $this->nama;
        $simpan->nomortelp = $this->notelp;
        $simpan->save();

        $this->reset();
        $this->pilihanMenu = 'lihat';
    }

    public function cariMember()
    {
        return ModelMember::where('nama_member', 'like', '%' . $this->searchTerm . '%')->get();
    }

    public function pilihMenu($menu){
        $this->pilihanMenu = $menu;
    }

    public function render()
    {
        $semuaMember = $this->cariMember(); // Panggil fungsi pencarian

        return view('livewire.member')->with([
            'semuaMember'=> $semuaMember
        ]);
    }
}
