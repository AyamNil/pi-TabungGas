<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['name' => 'LPG Gas 3kg', 'price' => 50000],
            ['name' => 'LPG Gas 5kg', 'price' => 75000],
            ['name' => 'LPG Gas 12kg', 'price' => 150000],
            ['name' => 'LPG Gas 15kg', 'price' => 200000],
            ['name' => 'LPG Gas 18kg', 'price' => 250000],
            ['name' => 'LPG Gas 21kg', 'price' => 300000],
            ['name' => 'LPG Gas 24kg', 'price' => 350000],
            ['name' => 'LPG Gas 27kg', 'price' => 400000],
            ['name' => 'LPG Gas 30kg', 'price' => 450000],
            ['name' => 'LPG Gas 33kg', 'price' => 500000],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
