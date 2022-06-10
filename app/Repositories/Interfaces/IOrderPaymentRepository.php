<?php

namespace App\Repositories\Interfaces;

interface IOrderPaymentRepository
{
    public function index($query);

    public function create($data);
}
