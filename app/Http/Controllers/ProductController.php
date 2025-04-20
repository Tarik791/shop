<?php
namespace App\Http\Controllers;

use App\Services\ProductService;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getPaginatedProducts();
        return view('welcome', [
            'products' => $products
        ]);
    }
    
    public function show($uuid)
    {
        $product = $this->productService->getProductByUuidWithVariants($uuid);
        return view('ProductDetails', [
            'product' => $product,
        ]);
    }

    public function apiProducts()
    {
        $products = $this->productService->getPaginatedProductsWithVariantsAndImages();

        $formatted = $products->map(function ($product) {
            return [
                'uid' => $product->uuid,
                'title' => $product->title,
                'handle' => $product->handle,
                'price' => $product->price,
                'created_at' => $product->created_at->toIso8601String(),
                'updated_at' => $product->updated_at->toIso8601String(),
                'variants' => $product->variants->map(function ($variant) {
                    return [
                        'uid' => $variant->uuid,
                        'product_id' => $variant->product_id,
                        'price' => $variant->price,
                        'handle' => $variant->handle,
                        'image_id' => $variant->image_id,
                        'created_at' => $variant->created_at->toIso8601String(),
                        'updated_at' => $variant->updated_at->toIso8601String(),
                    ];
                }),
                'images' => $product->images->map(function ($image) {
                    return [
                        'uid' => $image->uuid,
                        'url' => $image->url,
                        'created_at' => $image->created_at->toIso8601String(),
                        'updated_at' => $image->updated_at->toIso8601String(),
                    ];
                }),
            ];
        });

        return response()->json([
            'products' => $formatted,
        ]);
    }
}

?>