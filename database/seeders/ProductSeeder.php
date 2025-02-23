<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title' => 'Xlim Pro 2',
            'price' => 4100,
            'quantity' => 5,
            'category_id'=> 1,
            'brand_id'=>1,
            'description'=>'XLIM PRO 2, upgraded with a 1300mAh battery & 2A fast charging, provides more power and quicker charging. Moreover, it showcases a stunning 0.56-inch Ultra-HD color screen, providing an outstanding pro-experience!'
        ]);

        Product::create([
            'title' => 'X6',
            'price' => 450,
            'quantity' => 20,
            'category_id'=> 2,
            'brand_id'=>2,
            'description'=>'Detachable Cartridge. Play Cool · Ergonomic Design. Comfortable Grip · Color-Changing LED · USB-C Charging.'
        ]);

        Product::create([
            'title' => 'Nerdz',
            'price' => 500,
            'quantity' => 3,
            'category_id'=> 3,
            'brand_id'=>3,
            'description'=>'Discover Ultimate Nerd Salts, eco-friendly Nic Salt e-liquids from Manila, PH. Made with top-quality ingredients and free from harmful chemicals.'
        ]);
    }
}
