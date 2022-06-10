<?php

namespace App\Repositories\Interfaces;

interface IBaseRepository
{
    public function index($query);

    public function create($data);

    public function update($id, $data);

    public function get($id);

    public function destroy($id);

}
