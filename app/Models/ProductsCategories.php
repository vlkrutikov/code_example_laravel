<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductsCategories
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $name
 * @property string $slug
 * @property int $order_num
 * @property int $hidden
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsCategories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsCategories newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsCategories query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsCategories whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsCategories whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsCategories whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsCategories whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsCategories whereOrderNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsCategories whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsCategories whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsCategories whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|ProductsCategories[] $childCategories
 * @property-read int|null $child_categories_count
 * @property-read ProductsCategories|null $parentCategory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Products[] $products
 * @property-read int|null $products_count
 */
class ProductsCategories extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'name', 'slug', 'order_num', 'hidden', 'created_at', 'updated_at',
    ];

    /**
     * @return mixed
     */
    public function parentCategory()
    {
        return $this->belongsTo(ProductsCategories::class, 'parent_id');
    }

    /**
     * @return mixed
     */
    public function childCategories()
    {
        return $this->hasMany(ProductsCategories::class, 'parent_id');
    }

    /**
     * @return mixed
     */
    public function products()
    {
        return $this->hasMany(Products::class, 'category_id');
    }
}
