<?php

namespace App\Repositories;

use App\Services\ModelQueryService;
use App\Models\Orders\OrderPayment;
use App\Repositories\Interfaces\IOrderPaymentRepository;
use App\Repositories\OrderRepository;

use Storage;
use File;

class OrderPaymentRepository implements IOrderPaymentRepository
{
    public $model;
    public $modelRelationships = ['user', 'order'];
    public $modelQueryService;
    public $orderRepository;

    public function __construct(OrderPayment $model, OrderRepository $orderRepository)
    {
        $this->model = $model;
        $this->modelQueryService = new ModelQueryService($this->model, $this->modelRelationships);
        $this->orderRepository = $orderRepository;
    }

    public function index($query)
    {
        try
        {
            return $this->modelQueryService->index($query);
        } catch (Exception $e)
        {
            throw $e->getMessage();
        }
    }

    public function create($data)
    {
        try
        {
            $order = $this->orderRepository->get($data['order_id']);

            $this->uploadImage($data['image'], $order, $data['user_id']);

            return 'Payment proof uploaded';
        } catch (Exception $e)
        {
            throw $e->getMessage();
        }
    }

    public function uploadImage($image, $order, $userId)
    {
        $filename = $order->reference_code.'-'.$image->getClientOriginalName();
        $filepath = 'images/payments/';

        $this->modelQueryService->create([
            'user_id' => $userId,
            'order_id' => $order->id,
            'image_path' => env('APP_URL').$filepath.$filename
        ]);

        Storage::disk('public')->put(
            $filepath.$filename,
            File::get($image)
        );
    }
}
