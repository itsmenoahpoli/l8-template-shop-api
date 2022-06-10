<?php

namespace App\Repositories;

use App\Services\ModelQueryService;
use App\Models\Orders\Order;
use App\Repositories\Interfaces\IOrderRepository;

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
            return $this->modelQueryService->create($data);
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
}
