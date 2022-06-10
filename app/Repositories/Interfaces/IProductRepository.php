<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\IBaseRepository;

interface IProductRepository extends IBaseRepository
{
    public function uploadImage($image, $sku, $productId);

    public function generateSKU();
}
