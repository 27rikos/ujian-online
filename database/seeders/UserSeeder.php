<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'administrator',
                'email' => 'admin@gmail.com',
                'nim' => '00',
                'password' => Hash::make('admin1234',),
                'role' => 'admin',

            ],
            [
                'name' => 'dosen',
                'email' => 'dosen@gmail.com',
                'nim' => '2205200118',
                'password' => Hash::make('dosen1234',),
                'role' => 'dosen',

            ],
            [
                'name' => 'budi',
                'email' => 'budi@gmail.com',
                'nim' => '220520001',
                'password' => Hash::make('budi1234',),
                'role' => 'mahasiswa',

            ]
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}