<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['Elektronik', 'Produk seperti gadget, aksesori elektronik, dan perangkat listrik.'],
            ['Peralatan Rumah Tangga', 'Barang kebutuhan rumah seperti perabot, alat bersih-bersih, dan dekorasi.'],
            ['Peralatan Kantor', 'Semua perlengkapan kantor seperti kertas, tinta, dan alat tulis.'],
            ['Makanan & Minuman', 'Produk konsumsi seperti makanan kemasan dan minuman.'],
            ['Fashion & Aksesori', 'Pakaian, sepatu, dan aksesori fashion lainnya.'],
            ['Otomotif', 'Suku cadang kendaraan dan perlengkapannya.'],
            ['Kesehatan & Kecantikan', 'Produk perawatan tubuh, obat bebas, skincare, dan kosmetik.'],
            ['Pertukangan & Bangunan', 'Alat kerja, material bangunan, dan perlengkapan konstruksi.'],
            ['Mainan & Hobi', 'Mainan anak, koleksi, dan perlengkapan hobi.'],
            ['Bahan Mentah / Material', 'Bahan dasar untuk produksi dan industri.'],
        ];

        foreach ($categories as [$name, $description]) {
            Category::create([
                'name' => $name,
                'description' => $description
            ]);
        }
    }
}
