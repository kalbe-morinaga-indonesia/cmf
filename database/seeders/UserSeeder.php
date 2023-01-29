<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'nik' => '19874321',
            'name' => 'Budi Setiawan',
            'email' => 'budi.setiawan112001@gmail.com',
            'password' => Hash::make('Kalbemorinaga'),
            'department_id' => 1
        ]);
    }
}
