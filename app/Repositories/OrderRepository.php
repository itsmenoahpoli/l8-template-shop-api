<?php

namespace App\Repositories;

use App\Services\ModelQueryService;
use App\Models\Orders\Order;
use App\Repositories\Interfaces\IOrderRepository;

use Str;

class OrderRepository implements IOrderRepository
{
    public $model;
    public $modelRelationships = ['user'];
    public $modelQueryService;

    public function __construct(Order $model)
    {
        $this->model = $model;
        $this->modelQueryService = new ModelQueryService($this->model, $this->modelRelationships);
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
            $referenceCode = $this->generateReferenceCode();
            $totalShippingFee = 200;
            $totalAmount = 0;

            return $this->modelQueryService->create(array_merge($data, [
                'reference_code' => $referenceCode,
                'total_shipping_fee' => $totalShippingFee,
                'total_amount' => $totalAmount,
            ]));
        } catch (Exception $e)
        {
            throw $e->getMessage();
        }
    }

    public function update($id, $data)
    {
        try
        {
            return $this->modelQueryService->update($id, $data);
        } catch (Exception $e)
        {
            throw $e->getMessage();
        }
    }

    public function get($id)
    {
        try
        {
            return $this->modelQueryService->get($id);
        } catch (Exception $e)
        {
            throw $e->getMessage();
        }
    }

    public function generateReferenceCode()
    {
        return strtoupper('OD-'.Str::random(10));
    }
}
