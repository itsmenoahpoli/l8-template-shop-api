<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Repositories\ProductMonitoringRepository;

class ProductMonitoringController extends Controller
{
    protected $productMonitoringRepository;

    public function __construct(ProductMonitoringRepository $productMonitoringRepository)
    {
        $this->productMonitoringRepository = $productMonitoringRepository;
    }

    public function index(Request $request) : JsonResponse
    {
        $query = $request->query();

        return response()->json(
            $this->productMonitoringRepository->index($query),
            200
        );
    }
}
