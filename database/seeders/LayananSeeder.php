<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('layanan')->insert([
            [
                'nama' => 'Cuci Basah',
                'harga' => 2500,
                'deskripsi' => 'Pakaian kamu akan kami cuci dan langsung diantarkan ke tempatmu!',
                'kategori' => 'kiloan',
                'gambar' => null,
            ],
            [
                'nama' => 'Cuci Kering',
                'harga' => 4000,
                'deskripsi' => 'Pakaian kamu akan kami cuci, dilipat rapih, dan siap kamu gunakan!',
                'kategori' => 'kiloan',
                'gambar' => null,
            ],
            [
                'nama' => 'Cuci Ekspress',
                'harga' => 9000,
                'deskripsi' => 'Pakaian kamu akan kami cuci dengan paket lengkap dan siap dalam sehari!',
                'kategori' => 'kiloan',
                'gambar' => null,
            ],
            [
                'nama' => 'Cuci Kering Setrika',
                'harga' => 6000,
                'deskripsi' => 'Pakaian kamu akan kami cuci dan setrika dan sehingga tidak kusut!',
                'kategori' => 'kiloan',
                'gambar' => null,
            ],
            [
                'nama' => 'Baju Dinas',
                'harga' => 4000,
                'deskripsi' => 'Ayo cuci baju dinasmu!',
                'kategori' => 'satuan',
                'gambar' => null,
            ],
            [
                'nama' => 'Jas / Almamater',
                'harga' => 4000,
                'deskripsi' => 'Ayo cuci jas / almamatermu!',
                'kategori' => 'satuan',
                'gambar' => null,
            ],
            [
                'nama' => 'Seprai',
                'harga' => 4000,
                'deskripsi' => 'Ayo cuci sepraimu!',
                'kategori' => 'satuan',
                'gambar' => null,
            ],
            [
                'nama' => 'Bed Cover',
                'harga' => 4000,
                'deskripsi' => 'Ayo cuci bed covermu!',
                'kategori' => 'satuan',
                'gambar' => null,
            ],
            [
                'nama' => 'Karpet',
                'harga' => 4000,
                'deskripsi' => 'Ayo cuci karpetmu!',
                'kategori' => 'satuan',
                'gambar' => null,
            ],
        ]);
    }
}
