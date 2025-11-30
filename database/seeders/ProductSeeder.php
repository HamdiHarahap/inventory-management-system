<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['PRD-000001', '4829175301842', 'Mouse Wireless Logitech', 1, 80000, 120000, 'pcs', 50],
            ['PRD-000002', '7091836249157', 'Keyboard Mechanical RGB', 1, 250000, 350000, 'pcs', 30],
            ['PRD-000003', '8901746253910', 'Sapu Ijuk Premium', 2, 15000, 25000, 'pcs', 100],
            ['PRD-000004', '5719038462159', 'Wajan Anti Lengket 28cm', 2, 60000, 95000, 'pcs', 40],
            ['PRD-000005', '3948126750938', 'Kertas A4 80gsm', 3, 38000, 50000, 'rim', 60],
            ['PRD-000006', '1602487953107', 'Tinta Printer Epson 003', 3, 90000, 120000, 'botol', 25],
            ['PRD-000007', '5409128376503', 'Mie Instan Ayam Goreng', 4, 2200, 3000, 'pcs', 300],
            ['PRD-000008', '7682094315892', 'Kopi Hitam Bubuk 100g', 4, 9000, 15000, 'pcs', 150],
            ['PRD-000009', '8375619024731', 'Kaos Polos Katun', 5, 25000, 45000, 'pcs', 70],
            ['PRD-000010', '1348905726315', 'Topi Baseball Hitam', 5, 18000, 30000, 'pcs', 40],
            ['PRD-000011', '9023468172530', 'Oli Motor 10W-40', 6, 28000, 45000, 'botol', 45],
            ['PRD-000012', '6713482097514', 'Kampas Rem Motor', 6, 15000, 25000, 'set', 35],
            ['PRD-000013', '4829037165401', 'Sabun Mandi Cair 250ml', 7, 9000, 15000, 'botol', 60],
            ['PRD-000014', '7284916302574', 'Sampo Anti Ketombe 170ml', 7, 11000, 20000, 'botol', 50],
            ['PRD-000015', '3197586402145', 'Paku 3cm (1kg)', 8, 12000, 20000, 'kg', 80],
            ['PRD-000016', '9041865273098', 'Cat Tembok 1L Putih', 8, 35000, 55000, 'liter', 25],
            ['PRD-000017', '5723091684521', 'Puzzle 100 Pcs Anak', 9, 9000, 15000, 'pcs', 40],
            ['PRD-000018', '8920651734820', 'Mobil Remote Control Mini', 9, 35000, 60000, 'pcs', 30],
            ['PRD-000019', '6918230471590', 'Besi Hollow 4x4', 10, 45000, 65000, 'batang', 25],
            ['PRD-000020', '7482916058371', 'Triplek 9mm', 10, 55000, 80000, 'lembar', 20],
        ];

        foreach ($products as [$sku, $barcode, $name, $category, $buy, $sell, $unit, $stock]) {
            Product::create([
                'sku' => $sku,
                'barcode' => $barcode,
                'name' => $name,
                'category_id' => $category,
                'price_buy' => $buy,
                'price_sell' => $sell,
                'unit' => $unit,
                'stock' => $stock,
            ]);
        }
    }
}
