<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Riwayat as Modelriwayat; // Pastikan model Riwayat sudah ada

class Riwayat extends Component
{
    public $riwayats;

    public function mount()
    {
        // Mengambil semua riwayat CRUD
        $this->riwayats = ModelRiwayat::all();
    }

    public function render()
    {
        return view('livewire.riwayat');
    }
}

