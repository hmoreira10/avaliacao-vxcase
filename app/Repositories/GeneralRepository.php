<?php

namespace App\Repositories;

class GeneralRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }
    protected function resolveModel()
    {
        return app($this->model);
    }
    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
    public function new()
    {
        return new $this->model();
    }
}
