<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DevUsersSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['email'=>'admin@local'],[
          'name'=>'Admin','password'=>Hash::make('admin123'),'role'=>'ADMIN'
        ]);
        User::updateOrCreate(['email'=>'medico@local'],[
          'name'=>'Dra. Teste','password'=>Hash::make('medico123'),'role'=>'MEDICO'
        ]);
    }
}


