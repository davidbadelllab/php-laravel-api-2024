<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\ProductStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Product Controller
 * Laravel 11 + PHP 8.3 Features
 */
class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        // Using typed class constants
        $maxStock = ProductStatus::MAX_STOCK;
        $minPrice = ProductStatus::MIN_PRICE;

        $products = [
            [
                'id' => 1,
                'name' => 'Product 1',
                'price' => 99.99,
                'status' => ProductStatus::ACTIVE->value,
                'max_stock' => $maxStock
            ]
        ];

        return response()->json($products);
    }

    public function store(Request $request): JsonResponse
    {
        // PHP 8.3: json_validate()
        $jsonData = $request->getContent();

        if (!json_validate($jsonData)) {
            return response()->json(['error' => 'Invalid JSON'], 400);
        }

        $data = json_decode($jsonData, true);

        return response()->json([
            'message' => 'Product created',
            'data' => $data
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json([
            'id' => $id,
            'name' => 'Product ' . $id,
            'status' => ProductStatus::ACTIVE->label(),
            'color' => ProductStatus::ACTIVE->color()
        ]);
    }
}

/**
 * Base Controller with #[Override] attribute
 */
abstract class BaseController
{
    protected function respondWithSuccess(mixed $data): JsonResponse
    {
        return response()->json(['data' => $data]);
    }
}

/**
 * Extended Controller using #[\Override]
 */
class ExtendedProductController extends BaseController
{
    // PHP 8.3: #[\Override] attribute
    #[\Override]
    protected function respondWithSuccess(mixed $data): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'timestamp' => now()->toISOString()
        ]);
    }
}
