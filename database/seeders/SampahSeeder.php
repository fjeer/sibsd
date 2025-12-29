<?php

namespace Database\Seeders;

use App\Models\Sampah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'jenis_sampah' => 'Plastik',
                'harga_per_kg' => 3000,
                'deskripsi' => 'Botol plastik, gelas plastik, kemasan plastik',
                'is_active' => true,
            ],
            [
                'jenis_sampah' => 'Kertas',
                'harga_per_kg' => 2000,
                'deskripsi' => 'Koran, kardus, kertas HVS',
                'is_active' => true,
            ],
            [
                'jenis_sampah' => 'Logam',
                'harga_per_kg' => 7000,
                'deskripsi' => 'Besi, aluminium, kaleng',
                'is_active' => true,
            ],
            [
                'jenis_sampah' => 'Kaca',
                'harga_per_kg' => 2500,
                'deskripsi' => 'Botol kaca, pecahan kaca',
                'is_active' => true,
            ],
            [
                'jenis_sampah' => 'Organik',
                'harga_per_kg' => 1000,
                'deskripsi' => 'Sisa makanan, daun, sampah dapur',
                'is_active' => true,
            ],
        ];

        foreach ($data as $item) {
            Sampah::create($item);
        }
    }
}
