<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Price;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PriceControllerTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    public function test_index()
    {
        Product::factory()
            ->has(Price::factory()->count(10))
            ->count(10)
            ->create();

        $response = $this->get(route('prices.index'));
        $responseOriginalContent = $response->getOriginalContent();
        $responseData = $responseOriginalContent['data'] ?? [];
        $firstElement = $responseData[0] ?? [];

        $response->assertOk();
        $this->assertNotEmpty($responseData);
        $this->assertArrayHasKey('guid', $firstElement);
        $this->assertArrayHasKey('value', $firstElement);
        $this->assertArrayHasKey('product_guid', $firstElement);
    }

    public function test_update()
    {
        $product = Product::factory()
            ->has(Price::factory()->count(2))
            ->create();
        $priceToUpdate = $product->prices()->first();
        $priceToDelete = $product->prices()->skip(1)->first();
        $newPriceGuid = $this->faker->uuid;
        $newPriceValue = 123.45;
        $priceValueToUpdate = 543.21;
        $url = route('prices.update', ['product' => $product->guid]);

        $response = $this->patch(
            $url,
            [
                'prices' => [
                    ['guid' => $newPriceGuid, 'price' => $newPriceValue],
                    ['guid' => $priceToUpdate->guid, 'price' => $priceValueToUpdate]
                ]
            ]
        );

        $response->assertOk();
        $response->assertJson(['success' => true]);
        $this->assertDatabaseHas('prices', ['guid' => $newPriceGuid, 'value' => $newPriceValue]);
        $this->assertDatabaseHas('prices', ['guid' => $priceToUpdate->guid, 'value' => $priceValueToUpdate]);
        $this->assertSoftDeleted('prices', ['guid' => $priceToDelete->guid]);
    }
}
