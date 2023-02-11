<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrdersAddRequest;
use App\Services\OrdersService;

class OrdersController extends Controller
{
    /**
     * @var OrdersService
     */
    private $service;

    /**
     * OrdersController constructor.
     *
     * @param OrdersService $service
     */
    public function __construct(OrdersService $service)
    {
        $this->service = $service;
    }

    /**
     * @param OrdersAddRequest $request
     *
     * @OA\Post(
     *     path="/api/orders",
     *     summary="Создание заказа",
     *     description="Создание заказа",
     *     operationId="ordersAdd",
     *     tags={"orders"},
     *     @OA\RequestBody(
     *         request="Product",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/OrdersAddRequest")
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="X-Requested-With",
     *         in="header",
     *         example="XMLHttpRequest",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешно"
     *     ),
     *     @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *     ),
     * )
     *
     * @return mixed
     * @throws \Exception
     */
    public function add(OrdersAddRequest $request)
    {
        return $this->service->addOrder($request);
    }
}
