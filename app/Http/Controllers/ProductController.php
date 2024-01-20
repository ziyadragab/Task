<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Interfaces\ProductInterface;


class ProductController extends Controller
{
  
    private $productInterface;

    public function __construct(ProductInterface $product)
    {
        $this->productInterface = $product;
    }
    public function index(ProductDataTable $dataTable)
    {
        return $this->productInterface->index($dataTable);
        
    }

    public function store(ProductRequest $request)
    {
        return $this->productInterface->store($request);
        
    }

    public function edit(Product $product)
    {
        return $this->productInterface->edit($product);
    }

    public function update(ProductRequest $request, Product $product)
    {
        return $this->productInterface->update($request, $product);
    }

    public function delete(Product $product)
    {
        return $this->productInterface->delete($product);
    }
}
