<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Product::create([
            "name"=> "Meja",
            "image"=> "meja.webp",
            "price"=> 350000,
        ]);

        Product::create([
            "name"=> "Kursi",
            "image"=> "kursi.webp",
            "price"=> 300000,
        ]);

        Product::create([
            "name" => "Lampu Meja",
            "image"=> "lampu_meja.webp",
            "price"=> 220000,
        ]);

        Product::create([
            "name"=> "Karpet Besar",
            "image"=> "karpet.webp",
            "price"=> 475000,
        ]);
    }
}
