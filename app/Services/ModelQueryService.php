<?php

namespace App\Services;

use App\Http\Resources\APIResource;

class ModelQueryService
{
    protected $model;
    protected $modelRelationships;

    public function __construct($model, $modelRelationships)
    {
        $this->model = $model;
        $this->modelRelationships = $modelRelationships;
    }

    public function baseModel()
    {
        return $this->model->query()->with($this->modelRelationships);
    }

    public function index($query)
    {
        $data = $this->baseModel()->orderBy('created_at', 'DESC')->get();

        return APIResource::collection($data);
    }

    public function create($data)
    {
        return $this->baseModel()->create($data);
    }

    public function update($id, $data)
    {
        $this->baseModel()->findOrFail($id)->update($data);

        return $this->get($id);
    }

    public function get($id)
    {
        $data = $this->baseModel()->findOrFail($id);

        return new APIResource($data);
    }

    public function destroy($id)
    {
        return $this->baseModel()->findOrFail($id)->delete();
    }
}
