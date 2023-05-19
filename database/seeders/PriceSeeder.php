<?php

namespace Database\Seeders;

use App\Models\Price;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::limit(10_000)
            ->pluck('guid')
            ->each(fn ($guid) => Price::insert(
                Price::factory(100)
                    ->make(['product_guid' => $guid])
                    ->toArray()
            ));
    }
}
