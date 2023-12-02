<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Product::create([
                'name' => 'Prodotto ' . $i,
                'description' => 'Descrizione del prodotto ' . $i . '. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'price' => rand(10, 100) + (rand(0, 99) / 100), // Prezzo casuale tra 10 e 100 con due decimali
            ]);
        }
    }
}
