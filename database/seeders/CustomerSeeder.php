<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            [1, 'John Store', '082145678900', 'john.store@mail.com', 'Jakarta Selatan'],
            [2, 'Toko Maju Bersama', '081234558899', 'majubersama@gmail.com', 'Bandung'],
            [3, 'Warung Sumber Rezeki', '082233441122', 'sumberrezeki@mail.com', 'Surabaya'],
            [4, 'Minimarket Jaya', '081311229988', 'jaya@minimarket.com', 'Semarang'],
            [5, 'AutoPart Garage', '081366778822', 'garageautopart@mail.com', 'Medan'],
        ];

        foreach ($customers as [$id, $name, $phone, $email, $address]) {
            Customer::create([
                'id' => $id,
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'address' => $address
            ]);
        }
    }
}
