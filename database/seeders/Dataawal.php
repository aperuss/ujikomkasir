<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use PhpParser\Node\Expr\New_;

class Dataawal extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = New User();
        $user->name = 'admin';
        $user->email = 'admin@kasir.com';
        $user->password = bcrypt('adminkasir');
        $user->peran = 'admin';
        $user->save();
    }
}
