<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends GeneralRepository
{
    protected $model = Product::class;

    protected $product = null;
    public function __construct()
    {
        $this->product = app($this->model);
    }
    public function store($request)
    {
        $product = new $this->product();
        $product->create($request);
    }
    public function update($request, $id)
    {
        $product = $this->product->find($id);
        $product->name = $request['name'];
        $product->reference = $request['reference'];
        $product->price = $request['price'];
        $product->delivery_days = $request['delivery_days'];
        $product->save();
    }
    public function delete($id)
    {
        $product = $this->product->find($id);
        $product->delete();
    }
    public function search($query)
    {
        return $this->product->where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('reference', 'LIKE', '%' . $query . '%')->get();
    }
}
