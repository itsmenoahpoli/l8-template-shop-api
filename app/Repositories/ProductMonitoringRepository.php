<?php

namespace App\Repositories;

use App\Services\ModelQueryService;
use App\Models\Products\ProductMonitoring;
use App\Repositories\Interfaces\IProductMonitoringRepository;

class ProductMonitoringRepository implements IProductMonitoringRepository
{
    public $model;
    public $modelRelationships = ['product'];
    public $modelQueryService;

    public function __construct(ProductMonitoring $model)
    {
        $this->model = $model;
        $this->modelQueryService = new ModelQueryService($this->model, $this->modelRelationships);
    }

    public function index($query)
    {
        return $this->modelQueryService->index($query);
    }

    public function create($data)
    {
        return $this->modelQueryService->create($data);
    }
}
