<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Sizes
 *
 * @property int $id
 * @property string $name
 * @property int $order_num
 * @method static \Illuminate\Database\Eloquent\Builder|Sizes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sizes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sizes query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sizes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sizes whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sizes whereOrderNum($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Products[] $products
 * @property-read int|null $products_count
 * @property int|null $category_id
 * @method static \Illuminate\Database\Eloquent\Builder|Sizes whereCategoryId($value)
 */
class Sizes extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'order_num'
    ];

    /**
     * @return mixed
     */
    public function products()
    {
        return $this->belongsToMany(Products::class, 'products_sizes');
    }
}
