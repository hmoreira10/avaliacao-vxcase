<?php

namespace App\Repositories;

use App\Http\Requests\SaleRequest;
use App\Models\Sale;
use Carbon\Carbon;

class SaleRepository extends GeneralRepository
{
    protected $model = Sale::class;
    protected $sale = null;
    public function __construct()
    {
        $this->sale = app($this->model);
    }

    public function withProductsPaginate($pages)
    {
        return $this->sale->with('products:name,delivery_days')->paginate($pages);
    }
    public function withProductsfind($id)
    {
        return $this->sale->with('products:name,delivery_days')->find($id);
    }
    public function store($request)
    {
        $sale = new $this->sale();
        $sale->purchase_at = Carbon::parse($request['purchase_at']);
        $sale->amount = $request['amount'];
        $sale->delivery_days = $request['delivery_days'];
        $sale->save();
        $sale->products()->sync($request['products']);
    }
    public function update($request, $id)
    {
        $sale = $this->sale->find($id);
        $sale->purchase_at = Carbon::parse($request['purchase_at']);
        $sale->save();
        $sale->products()->sync($request['products']);
    }
    public function delete($id)
    {
        $sale = $this->sale->find($id);
        $sale->products()->detach();
        $sale->delete();
    }
}
