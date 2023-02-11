<?php
declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\OrdersAddRequest;
use App\Models\Orders;
use App\Models\OrdersProducts;
use App\Models\OrdersProductsColors;
use App\Models\OrdersProductsColorsSizes;
use App\Models\Products;
use App\Repositories\OrdersRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Validation\ValidationException;

final class OrdersService
{
    public const MIN_COUNT_IN_COLOR = 5;

    private $repository;

    /**
     * OrdersService constructor.
     *
     * @param OrdersRepository $repository
     */
    public function __construct(OrdersRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param OrdersAddRequest $request
     * @return mixed
     * @throws \Exception
     */
    public function addOrder(OrdersAddRequest $request)
    {
        $products = $request->get('products');

        // подсчитываем количество товаров для одного цвета
        foreach ($products as $prod_idx => $product) {
            foreach ($product['colors'] as $color_idx => $color) {
                $count_all_sizes = 0;
                foreach ($color['sizes'] as $size) {
                    $count_all_sizes += (int)$size['count'];
                }
                if ($count_all_sizes < self::MIN_COUNT_IN_COLOR) {
                    throw ValidationException::withMessages([
                        'products.'.$prod_idx.'.colors.'.$color_idx.'.sizes' => 'Минимальное количество для одного цвета: ' . self::MIN_COUNT_IN_COLOR
                    ]);
                }
            }
        }

        // новый заказ
        $order = new Orders();
        $order->user_id = 1;
        $order->save();

        foreach ($products as $prod_idx => $product) {

            // проверяем есть ли такой товар
            $real_product = Products::whereId($product['id'])->first();
            if (!$real_product) {
                $order->delete();

                throw ValidationException::withMessages([
                    'product' => 'Товара с данным ID не существует'
                ]);
            }

            // добавляем товары в заказ
            $order_product = new OrdersProducts();
            $order_product->order_id = $order->id;
            $order_product->product_id = $product['id'];
            try {
                $order_product->save();
            }
            catch (\Exception $e) {
                // что-то пошло не так, удаляем заказ
                $order->delete();

                throw ValidationException::withMessages([
                    'product' => 'Ошибка добавления товара в заказ'
                ]);
            }

            // добавляем картинки к товару
            try {
                foreach ($request->allFiles()['products'][$prod_idx]['images'] as $image) {
                    $filename = sprintf('%s.%s', \Str::random(), $image->getClientOriginalExtension());
                    $order_product->addMedia($image)->usingFileName($filename)->toMediaCollection('images');
                }
            }
            catch (\Exception $e) {
                // что-то пошло не так, удаляем заказ
                $order->delete();

                throw ValidationException::withMessages([
                    'product' => 'Ошибка прикрепления картинки к товару'
                ]);
            }

            // добавляем цвета к товару
            foreach ($product['colors'] as $color) {
                try {
                    $order_product_color = new OrdersProductsColors();
                    $order_product_color->order_product_id = $order_product->id;
                    $order_product_color->color = $color['color'];
                    $order_product_color->product_price = $real_product->price;
                    $order_product_color->save();
                }
                catch (\Exception $e) {
                    // что-то пошло не так, удаляем заказ
                    $order->delete();

                    throw ValidationException::withMessages([
                        'product' => 'Ошибка прикрепления цвета к товару'
                    ]);
                }

                // добавляем размеры к цветам
                foreach ($color['sizes'] as $size) {
                    try {
                        $order_product_color_size = new OrdersProductsColorsSizes();
                        $order_product_color_size->order_product_color_id = $order_product_color->id;
                        $order_product_color_size->size_id = $size['id'];
                        $order_product_color_size->product_count = $size['count'];
                        $order_product_color_size->save();
                    }
                    catch (\Exception $e) {
                        // что-то пошло не так, удаляем заказ
                        $order->delete();

                        throw ValidationException::withMessages([
                            'product' => 'Ошибка прикрепления размера к цвету'
                        ]);
                    }
                }
            }
        }

        //foreach ($order_product->getMedia('images') as $mediaImage) {
        //    dd($mediaImage->getUrl());
        //}

        return $request->get('products');
    }
}
