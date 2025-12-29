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
        // Data Admin
        User::create([
            'username' => 'superadmin',
            'email' => 'superadmin@bsd.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]); 

        // Data Petugas
        $petugas = User::create([
            'username' => 'petugas1',
            'email' => 'petugas@bsd.id',
            'password' => Hash::make('petugas123'),
            'role' => 'petugas',
        ]);

        $petugas->profile()->create([
            'full_name' => 'Petugas Bank Sampah',
            'phone_number' => '081234567890',
            'address' => 'Kantor Bank Sampah',
            'gender' => 'male'
        ]);

        // Data Nasabah
        $nasabah = User::create([
            'username' => 'yuli',
            'email' => 'ningsih98@gmail.com',
            'password' => Hash::make('password')
        ]);

        $nasabah->profile()->create([
            'nin' => '2509240001',
            'full_name' => 'Yulia Ningsih',
            'phone_number' => '089876543210',
            'address' => 'Perumahan BSD',
            'gender' => 'female',
        ]);
    } 
}   