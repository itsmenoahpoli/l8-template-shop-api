<?php

namespace App\Repositories;

use App\Services\ModelQueryService;
use App\Models\Products\Product;
use App\Models\Products\ProductImage;
use App\Repositories\Interfaces\IProductRepository;
use App\Repositories\ProductMonitoringRepository;

use Str;
use Storage;
use File;
use DB;

class ProductRepository implements IProductRepository
{
    public $model;
    public $modelRelationships = ['product_category'];
    public $modelQueryService;
    public $productImageModel;
    public $productMonitoringRepository;

    public function __construct(Product $model, ProductImage $productImageModel, ProductMonitoringRepository $productMonitoringRepository)
    {
        $this->model = $model;
        $this->modelQueryService = new ModelQueryService($this->model, $this->modelRelationships);
        $this->productImageModel = $productImageModel;
        $this->productMonitoringRepository = $productMonitoringRepository;
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
            $sku = $this->generateSKU();
            $images = $data['images'];

            unset($data['images']);
            $product = $this->modelQueryService->create(array_merge($data, ['sku' => $sku]));

            if (count($images) > 0)
            {
                foreach ($images as $image)
                {
                    $this->uploadImage($image, $sku, $product->id);
                }
            }

            $this->productMonitoringRepository->create([
                'type' => 'in',
                'product_id' => $product->id
            ]);

            DB::commit();

            return $this->get($product->id);
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

    public function generateSKU()
    {
        return strtoupper('SKU-P'.Str::random(8));
    }

    public function uploadImage($image, $sku, $productId)
    {
        $filename = $sku.'-'.$image->getClientOriginalName();
        $filepath = 'images/products/';

        $this->productImageModel->create([
            'product_id' => $productId,
            'image_path' => env('APP_URL').'storage/'.$filepath.$filename
        ]);

        Storage::disk('public')->put(
            $filepath.$filename,
            File::get($image)
        );
    }
}
