<?php

namespace App\Repositories;

use App\Services\ModelQueryService;
use App\Models\Orders\Order;
use App\Repositories\Interfaces\IOrderRepository;
use App\Repositories\ProductMonitoringRepository;

use Str;
use DB;

class OrderRepository implements IOrderRepository
{
    public $model;
    public $modelRelationships = ['user', 'order_payment'];
    public $modelQueryService;
    public $productMonitoringModel;

    public function __construct(Order $model, ProductMonitoringRepository $productMonitoringModel)
    {
        $this->model = $model;
        $this->modelQueryService = new ModelQueryService($this->model, $this->modelRelationships);
        $this->productMonitoringModel = $productMonitoringModel;
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
        DB::beginTransaction();
        try
        {

            $referenceCode = $this->generateReferenceCode();
            $totalShippingFee = $data['total_amount'] + 200;
            $itemIds = json_decode($data['item_ids']);
            json_decode($data['items']);

            $order = $this->modelQueryService->create(array_merge($data, [
                'reference_code' => $referenceCode,
                'total_shipping_fee' => $totalShippingFee,
            ]));

            foreach ($itemIds as $itemId)
            {
                $this->productMonitoringModel->create([
                    'type' => 'SOLD',
                    'order_id' => $order->id,
                    'product_id' => $itemId
                ]);
            }

            DB::commit();

            return $order;
        } catch (Exception $e)
        {
            DB::rollback();
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
