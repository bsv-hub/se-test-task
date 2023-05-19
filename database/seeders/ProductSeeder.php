<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()
            ->count(10_000)
            ->make()
            ->chunk(1000)
            ->each(fn ($chunk) => Product::insert($chunk->toArray()));
    }
}
