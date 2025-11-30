<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [1, 'PT Sumber Elektronik', '081234567890', 'supplier1@sumber.com', 'Jakarta, Indonesia'],
            [2, 'CV Mitra Sejati', '081298765432', 'info@mitrasejati.com', 'Bandung, Indonesia'],
            [3, 'Global Office Tools', '082233445566', 'sales@gotools.com', 'Surabaya, Indonesia'],
            [4, 'Fresh Food Ltd', '081355667788', 'contact@freshfood.com', 'Medan, Indonesia'],
            [5, 'Clean & Home Supplier', '081399887766', 'support@cleanhome.com', 'Bali, Indonesia'],
        ];

        foreach ($suppliers as [$id, $name, $phone, $email, $address]) {
            Supplier::create([
                'id' => $id,
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'address' => $address
            ]);
        }
    }
}
