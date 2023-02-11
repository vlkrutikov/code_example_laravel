<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrdersProductsColorsSizes
 *
 * @property int $id
 * @property int $order_product_color_id
 * @property int|null $size_id
 * @property int $product_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\OrdersProducts $orderProductColor
 * @property-read \App\Models\Sizes|null $size
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProductsColorsSizes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProductsColorsSizes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProductsColorsSizes query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProductsColorsSizes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProductsColorsSizes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProductsColorsSizes whereOrderProductColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProductsColorsSizes whereProductCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProductsColorsSizes whereSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProductsColorsSizes whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrdersProductsColorsSizes extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_product_color_id', 'size_id', 'product_count', 'created_at', 'updated_at'
    ];

    /**
     * @return mixed
     */
    public function orderProductColor()
    {
        return $this->belongsTo(OrdersProducts::class, 'order_product_id');
    }

    /**
     * @return mixed
     */
    public function size()
    {
        return $this->belongsTo(Sizes::class, 'size_id');
    }
}
