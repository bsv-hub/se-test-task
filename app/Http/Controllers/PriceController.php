<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePriceRequest;
use App\Models\Price;
use App\Models\Product;
use App\Services\PriceService;
use Illuminate\Http\JsonResponse;

class PriceController extends Controller
{
    public function index(): JsonResponse
    {
        $pageNum = request()->query->get('page');
        $pricesPage = Price::paginate(1000, ['*'], 'page', $pageNum);
        return new JsonResponse([
            'data' => $pricesPage->items(),
            'perPage' => $pricesPage->perPage(),
            'currentPage' => $pricesPage->currentPage(),
            'total' => $pricesPage->total(),
            'lastPage' => $pricesPage->lastPage(),
        ]);
    }

    public function update(UpdatePriceRequest $request, Product $product): JsonResponse
    {
        $result = (new PriceService())->updatePrices(
            $request->validated('prices'),
            $product
        );
        $responseStatusCode = $result->isSuccess() ? JsonResponse::HTTP_OK : JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
        return new JsonResponse($result->toArray(), $responseStatusCode);
    }
}
