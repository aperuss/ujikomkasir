<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User as ModelUser;
use Illuminate\Support\Facades\Auth;

class User extends Component
{
    public $pilihanMenu = 'lihat';
    public $nama;
    public $email;
    public $peran;
    public $password;
    public $penggunaTerpilih;
    public $searchTerm = ''; // Variabel untuk pencarian

    public function mount(){
        if (Auth::user()->peran != 'admin'){
            abort(403);
        }
    }

    public function cariPengguna(){
        return ModelUser::where('name', 'like', '%' . $this->searchTerm . '%')->where('peran', 'kasir')->get();
    }

    public function pilihEdit($id){
        $this->penggunaTerpilih = ModelUser::findOrFail($id); 
        $this->nama = $this->penggunaTerpilih->name;
        $this->email = $this->penggunaTerpilih->email;
        $this->peran = $this->penggunaTerpilih->peran;
        $this->pilihanMenu = 'edit';
    }

    public function pilihHapus($id){
        $this->penggunaTerpilih = ModelUser::findOrFail($id); 
        $this->pilihanMenu = 'hapus';
    }

    public function hapus(){
        $this->penggunaTerpilih->delete();
        $this->reset();
    }

    public function batal(){
        $this->reset();                                     
    }

    public function simpanEdit(){
        $this->validate([
            'nama' => 'required',
            'email' => ['required', 'email', 'unique:users,email,' . $this->penggunaTerpilih->id],
            'peran' => 'required',
        ],[
            'nama.required' => 'Nama Harus Diisi',
            'email.required' => 'Email Harus Diisi',
            'email.email' => 'Format Harus Email',
            'email.unique' => 'Email Telah Digunakan',
            'peran.required' => 'Peran Harus Dipilih',
        ]);

        $simpan = $this->penggunaTerpilih;
        $simpan->name = $this->nama;
        $simpan->email = $this->email;
        if($this->password){
            $simpan->password = bcrypt($this->password);
        }
        $simpan->peran = $this->peran; 
        $simpan->save();

        $this->reset();
        $this->pilihanMenu = 'lihat';
    }

    public function simpan(){
        $this->validate([
            'nama' => 'required', //nama dari wire model
            'email' => ['required', 'email', 'unique:users,email'],
            'peran' => 'required',
            'password' => 'required'
        ],[
            'nama.required' => 'Nama Harus Diisi',
            'email.required' => 'Email Harus Diisi',
            'email.email' => 'Format Harus Email',
            'email.unique' => 'Email Telah Digunakan',
            'peran.required' => 'Peran Harus Dipilih',
            'password.required' => 'Password Harus Diisi'
        ]); 

        $simpan = new ModelUser();
        $simpan->name = $this->nama;
        $simpan->email = $this->email;
        $simpan->password = bcrypt($this->password);
        $simpan->peran = $this->peran; 
        $simpan->save();

        $this->reset();
        $this->pilihanMenu = 'lihat';
    }

    public function pilihMenu($menu){
        $this->pilihanMenu = $menu;
    }

    public function render()
    {
        $semuaPengguna = $this->cariPengguna(); // Panggil fungsi pencarian
        
        return view('livewire.user')->with([
            'semuaPengguna' => $semuaPengguna
        ]);
    }
}
