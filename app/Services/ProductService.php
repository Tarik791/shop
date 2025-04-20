<?php
namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Get paginated products.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedProducts(int $perPage = 20)
    {
        return $this->productRepository->getAllProductsWithRelations($perPage);
    }

    public function getProductByUuidWithVariants(string $uuid)
    {
    return $this->productRepository->getProductWithVariants($uuid);
    }

    public function getPaginatedProductsWithVariantsAndImages()
    {
        return $this->productRepository->getAllProductsWithRelationsApi();
    }

    public function getFormattedProductsForApi()
    {
        $products = $this->productRepository->getAllProductsForApi();

        return $products->map(function ($product) {
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
    }
}
?>