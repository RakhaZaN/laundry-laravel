<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama' => 'admin',
                'telepon' => '0897472346823',
                'alamat' => null,
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'peran' => 'admin'
            ],
            [
                'nama' => 'kasir',
                'telepon' => '08293462783423',
                'alamat' => null,
                'email' => 'kasir@gmail.com',
                'password' => Hash::make('kasir123'),
                'peran' => 'kasir'
            ],
            [
                'nama' => 'john',
                'telepon' => '088762346342',
                'alamat' => 'Dijalan hati',
                'email' => 'john@gmail.com',
                'password' => Hash::make('passowrd123'),
                'peran' => 'pelanggan'
            ],
            [
                'nama' => 'raisa',
                'telepon' => '0867234283462',
                'alamat' => 'Jalan pelaku yang paling tersakiti',
                'email' => 'raisa@gmail.com',
                'password' => Hash::make('password123'),
                'peran' => 'pelanggan'
            ],
            [
                'nama' => 'dani',
                'telepon' => '0982346232123',
                'alamat' => 'Jalan in aja dulu',
                'email' => 'dani@gmail.com',
                'password' => Hash::make('password123'),
                'peran' => 'pelanggan'
            ],
        ]);
    }
}
