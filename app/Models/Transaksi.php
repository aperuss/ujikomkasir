<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetilTransaksi;

class Transaksi extends Model
{
    protected $fillable = ['kode','total','status'];

    public function detilTransaksi(){
        return $this->hasMany(DetilTransaksi::class); //untuk relasi agar di laporan berjalan
    }
    public function member(){
        return $this->belongsTo(Member::class);
    }

}
