<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductsSizes
 *
 * @property int $id
 * @property int $product_id
 * @property int $size_id
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSizes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSizes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSizes query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSizes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSizes whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSizes whereSizeId($value)
 * @mixin \Eloquent
 */
class ProductsSizes extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'size_id'
    ];
}
