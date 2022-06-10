<?php

namespace App\Repositories\Interfaces;

interface IProductMonitoringRepository
{
    public function index($query);

    public function create($data);
}
