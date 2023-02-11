<?php

namespace App\Repositories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ProductsRepository
 * @package App\Repositories
 */
class ProductsRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getQueryAll(): Builder
    {
        return Products::query()
            ->where('hidden', '=', 0);
    }

    /**
     * @param int $id
     * @return Products|null
     */
    public function getProductById(int $id): ?Products
    {
        return Products::query()
            ->where('id', '=', $id)
            ->where('hidden', '=', 0)
            ->first();
    }
}
