<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrdersProductsColors
 *
 * @property int $id
 * @property int $order_product_id
 * @property string $color
 * @property string|null $product_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\OrdersProducts $orderProduct
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProductsColors newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProductsColors newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProductsColors query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProductsColors whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProductsColors whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProductsColors whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProductsColors whereOrderProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProductsColors whereProductPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProductsColors whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrdersProductsColorsSizes[] $orderProductsColorsSizes
 * @property-read int|null $order_products_colors_sizes_count
 */
class OrdersProductsColors extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_product_id', 'color', 'product_price', 'created_at', 'updated_at'
    ];

    /**
     * @return mixed
     */
    public function orderProduct()
    {
        return $this->belongsTo(OrdersProducts::class, 'order_product_id');
    }

    /**
     * @return mixed
     */
    public function orderProductsColorsSizes()
    {
        return $this->hasMany(OrdersProductsColorsSizes::class, 'order_product_color_id');
    }
}
