<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reviews')->insert([
            [
                'user_id' => 3,
                'review' => 'Saya sangat puas dengan layanan laundry ini. Pakaian saya dicuci dengan sangat hati-hati dan hasilnya benar-benar bersih dan harum. Timnya juga sangat ramah dan responsif terhadap permintaan saya. Sangat merekomendasikan laundry ini kepada semua orang!'
            ],
            [
                'user_id' => 4,
                'review' => 'Laundry ini adalah pilihan terbaik bagi saya. Mereka selalu mengambil dan mengantarkan pakaian saya tepat waktu, bahkan dalam situasi darurat. Kualitas pekerjaan mereka sangat tinggi, tidak ada noda atau kerusakan pada pakaian saya. Harga yang terjangkau dan pelayanan pelanggan yang luar biasa membuat saya menjadi pelanggan setia mereka.'
            ],
            [
                'user_id' => 5,
                'review' => 'Saya ingin berterima kasih kepada laundry ini atas pelayanan luar biasa yang mereka berikan. Pakaian saya dicuci, dikeringkan, dan disetrika dengan sempurna. Hasilnya selalu memuaskan dan pakaian saya terlihat seperti baru setelah dicuci di sini. Tim mereka profesional, handal, dan sangat memperhatikan detail. Saya sangat senang menemukan laundry ini dan tidak akan ragu untuk merekomendasikannya kepada orang lain.'
            ],
        ]);
    }
}
