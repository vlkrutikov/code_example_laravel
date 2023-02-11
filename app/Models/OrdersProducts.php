<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;


/**
 * App\Models\OrdersProducts
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Orders $order
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrdersProductsColors[] $orderProductsColors
 * @property-read int|null $order_products_colors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrdersProductsImages[] $orderProductsImages
 * @property-read int|null $order_products_images_count
 * @property-read \App\Models\Products $product
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProducts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProducts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProducts query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProducts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProducts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProducts whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProducts whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProducts whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrdersProducts extends Model implements HasMedia
{
    use HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'product_id', 'created_at', 'updated_at'
    ];

    public function registerMediaCollections()
    {
        $this->addMediaCollection('images');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('main')
            ->width(1200)
            ->quality(90);
    }

    /**
     * @return mixed
     */
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    /**
     * @return mixed
     */
    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }

    /**
     * @return mixed
     */
    public function orderProductsColors()
    {
        return $this->hasMany(OrdersProductsColors::class, 'order_product_id');
    }
}
