<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use App\Services\ProductsService;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * App\Models\Products
 *
 * @property int $id
 * @property int|null $category_id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property int $quality
 * @property string|null $price
 * @property int $order_num
 * @property int $hidden
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Products newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products query()
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereOrderNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereQuality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\ProductsCategories|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sizes[] $sizes
 * @property-read int|null $sizes_count
 */
class Products extends Model implements HasMedia
{
    use HasMediaTrait;

    const QUALITY_TYPES = [
        '0' => 'Среднее',
        '1' => 'Хорошее',
    ];

    public $image;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'name', 'description', 'quality', 'price', 'order_num', 'hidden', 'created_at', 'updated_at'
    ];

    public function registerMediaCollections()
    {
        $this->addMediaCollection('image')->singleFile();
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
    public function category()
    {
        return $this->belongsTo(ProductsCategories::class, 'category_id');
    }

    /**
     * @return mixed
     */
    public function sizes()
    {
        return $this->belongsToMany(Sizes::class, 'products_sizes', 'product_id', 'size_id');
    }

    /**
     *  Generate slug
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(static function (self $model) {
            if ($model->name && true === \is_string($model->name)) {
                $model->slug = ProductsService::slug('slug', $model->name);
            }
        });
    }
}
