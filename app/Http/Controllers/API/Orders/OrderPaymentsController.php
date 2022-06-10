<?php

namespace App\Http\Controllers\API\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Repositories\OrderPaymentRepository;

class OrdersController extends Controller
{
    protected $orderPaymentRepository;

    public function __construct(OrderPaymentRepository $orderPaymentRepository)
    {
        $this->orderPaymentRepository = $orderPaymentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) : JsonResponse
    {
        $query = $request->query();

        return response()->json(
            $this->orderPaymentRepository->index($query),
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : JsonResponse
    {
        return response()->json(
            $this->orderPaymentRepository->create($request->all()),
            200
        );
    }
}
