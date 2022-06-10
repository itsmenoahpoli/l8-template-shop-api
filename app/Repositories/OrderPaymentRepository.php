<?php

namespace App\Repositories;

use App\Services\ModelQueryService;
use App\Models\Orders\OrderPayment;
use App\Repositories\Interfaces\IProductCategoryRepository;

class ProductCategoryRepository implements IProductCategoryRepository
{
    public $model;
    public $modelRelationships = ['user', 'order'];
    public $modelQueryService;

    public function __construct(OrderPayment $model)
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
}
