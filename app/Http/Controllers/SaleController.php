<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Repositories\SaleRepository;
use Carbon\Carbon;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, SaleRepository $saleRepository)
    {
        if (isset($request->per_page))
            $per_page = $request->per_page;
        else
            $per_page = 20;
        return $saleRepository->withProductsPaginate($per_page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request, SaleRepository $saleRepository)
    {
        $saleRepository->store($request->all());
        return Response()->json(['message' => 'Venda Concluida com sucesso!'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, SaleRepository $saleRepository)
    {
        return $saleRepository->withProductsfind($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaleRequest $request, $id, SaleRepository $saleRepository)
    {
        $saleRepository->update($request->all(), $id);
        return Response()->json('Venda Alterada com sucesso!', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, SaleRepository $saleRepository)
    {
        $saleRepository->delete($id);
        return Response()->json('Venda Excluida com sucesso!', 200);
    }
}
