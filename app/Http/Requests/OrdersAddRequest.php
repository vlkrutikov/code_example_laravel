<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class OrdersAddRequest
 *
 * @OA\Schema(
 *      schema="OrdersAddRequest",
 *
 *      @OA\Property(property="products[0][id]", type="integer", example="1"),
 *
 *      @OA\Property(property="products[0][colors][0][color]", type="integer", example="#defaf5"),
 *      @OA\Property(property="products[0][colors][0][sizes][0][id]", type="integer", example="17"),
 *      @OA\Property(property="products[0][colors][0][sizes][0][count]", type="integer", example="5"),
 *
 *      @OA\Property(property="products[0][images][0]", type="string", format="binary"),
 * )
 *
 * @package App\Http\Requests
 */
class OrdersAddRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'products' => ['required', 'array', 'min:1', 'max:1000'],

            'products.*.id' => ['required', 'integer', 'min:1'],

            'products.*.images' => ['required', 'array', 'min:1', 'max:10'],
            'products.*.images.*' => ['required', 'image', 'mimes:jpeg,jpg,png,webp', 'max:20480', 'dimensions:min_width=100,min_height=100'],

            'products.*.colors' => ['required', 'array', 'min:1', 'max:100'],
            'products.*.colors.*.color' => ['required', 'regex:/^(#[abcdefABCDEF0-9]{6})$/i'],

            'products.*.colors.*.sizes' => ['required', 'array', 'min:1', 'max:100'],
            'products.*.colors.*.sizes.*.id' => ['required', 'integer', 'min:1'],
            'products.*.colors.*.sizes.*.count' => ['required', 'integer', 'min:1'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'products.required' => 'Должен быть выбран хотя бы один товар',
            'products.array' => 'Товары должны быть массивом',
            'products.max' => 'Максимальное количество: 1000',

            'products.*.id.required' => 'Не выбран ID товара',
            'products.*.id.integer' => 'ID товара должен быть числом',
            'products.*.id.min' => 'ID товара должен быть числом не меньше 1',

            'products.*.images.required' => 'Должна быть передана хотя бы одна картинка',
            'products.*.images.array' => 'Картинки должны быть массивом',
            'products.*.images.max' => 'Можно передать не более 10 картинок',
            'products.*.images.*.image' => 'Должна быть картинка',
            'products.*.images.*.mimes' => 'Доступные типы изображений: jpeg, jpg, png, webp',
            'products.*.images.*.max' => 'Максимальный размер изображения: 20Мб',
            'products.*.images.*.dimensions' => 'Размер изображения должен быть минимум 100х100',

            'products.*.colors.required' => 'Должен быть выбран хотя бы один цвет',
            'products.*.colors.array' => 'Цвет должен быть массивом',
            'products.*.colors.max' => 'Максимальное количество: 100',

            'products.*.colors.*.color.required' => 'Должен быть выбран цвет',
            'products.*.colors.*.color.regex' => 'Цвет должен быть в HEX-формате',

            'products.*.colors.*.sizes.required' => 'Должен быть выбран хотя бы один размер',
            'products.*.colors.*.sizes.array' => 'Размер должен быть массивом',
            'products.*.colors.*.sizes.max' => 'Максимальное количество: 100',

            'products.*.colors.*.sizes.*.id.required' => 'ID размера обязательно',
            'products.*.colors.*.sizes.*.id.integer' => 'ID должно быть целым числом',
            'products.*.colors.*.sizes.*.id.min' => 'ID должно быть целым числом не менее 1',

            'products.*.colors.*.sizes.*.count.required' => 'Количество обязательно',
            'products.*.colors.*.sizes.*.count.integer' => 'Количество должно быть целым числом',
            'products.*.colors.*.sizes.*.count.min' => 'Количество должно быть целым числом не менее 1',
        ];
    }
}
