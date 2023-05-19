<?php

namespace App\Services;

use App\Models\Price;
use App\Models\Product;
use App\SimpleResult;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PriceService
{
    public function updatePrices(array $newPrices, Product $product): SimpleResult
    {
        $currentPrices = $product->prices()
            ->get()
            ->keyBy('guid');
        $newPrices = Collection::make($newPrices)
            ->keyBy('guid');
        [$pricesToUpdate, $pricesToCreate] = $newPrices->partition(
            fn ($newPrice) => $currentPrices->has($newPrice['guid'])
        );
        $pricesToSoftDelete = $currentPrices->filter(fn ($price) => ! $newPrices->has($price->guid));

        DB::beginTransaction();
        try {
            $pricesToCreate->each(fn ($newPrice) => Price::create([
                'guid' => $newPrice['guid'],
                'value' => $newPrice['price'],
                'product_guid' => $product->guid,
            ]));
            $pricesToUpdate->each(function ($newPrice) use ($currentPrices) {
                $guid = $newPrice['guid'];
                $currentPrices[$guid]->value = $newPrice['price'];
                $currentPrices[$guid]->save();
            });
            $pricesToSoftDelete->each(fn ($price) => $price->delete());
            DB::commit();
        } catch (Exception $e) {
            // TODO: Можно ловить несколько более специфичных типов исключений
            DB::rollBack();
            Log::error($e->getMessage());
            return SimpleResult::failure($e->getMessage());
        }

        return SimpleResult::success();
    }
}
