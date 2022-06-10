<?php

namespace App\Repositories;

use App\Services\ModelQueryService;
use App\Models\Products\ProductCategory;
use App\Repositories\Interfaces\IProductCategoryRepository;

class ProductCategoryRepository implements IProductCategoryRepository
{
    public $model;
    public $modelRelationships = ['products'];
    public $modelQueryService;

    public function __construct(ProductCategory $model)
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

    public function destroy($id)
    {
        try
        {
            return $this->modelQueryService->destroy($id);
        } catch (Exception $e)
        {
            throw $e->getMessage();
        }
    }
}
