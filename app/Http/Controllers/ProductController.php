<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ProductRepository $productRepository)
    {
        if (isset($request->product_name)) {
            $query = strtoupper($request->product_name);
            return $productRepository->search($query);
        }
        return $productRepository->all();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, ProductRepository $productRepository)
    {
        $productRepository->store($request->all());
        return Response()->json('Produto cadastrado!', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, ProductRepository $productRepository)
    {
        return $productRepository->find($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id, ProductRepository $productRepository)
    {
        $productRepository->update($request->all(), $id);
        return Response()->json('Produto Atualizado!', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, ProductRepository $productRepository)
    {
        $productRepository->delete($id);
        return Response()->json('Produto Excluido!', 200);
    }
}
