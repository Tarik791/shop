<?php
namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    /**
     * Get all products with relations, paginated.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllProductsWithRelations(int $perPage = 20)
    {
        return Product::with(['variants', 'images'])
            ->paginate($perPage);
    }

    public function getProductWithVariants(string $uuid)
    {
    return Product::with(['variants.image'])
        ->where('uuid', $uuid)
        ->first();
    }

    public function getAllProductsForApi()
    {
        return Product::with(['variants', 'variants.image', 'images'])->cursor();
    }
}
?>