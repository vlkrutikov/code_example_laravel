<?php

namespace App\Repositories;

use App\Models\Orders;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class OrdersRepository
 * @package App\Repositories
 */
class OrdersRepository
{
    /**
     * @param int $id
     * @return Orders|null
     */
    public function getOrderById(int $id): ?Orders
    {
        return Orders::whereId($id)->first();
    }
}
