<?php

namespace App\Repositories\Interfaces;

interface IOrderRepository
{
    public function index($query);

    public function create($data);

    public function get($id);

    public function update($id, $data);

    public function calculateTotalAmount($orders);

    public function generateReferenceCode();
}
