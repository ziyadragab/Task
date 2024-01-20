<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ProductInterface;
use App\Models\Product;

class ProductRepository implements ProductInterface
{
    public function index($dataTable)
    {
        return $dataTable->render('product.index');
    }


    public function store($request)
    {
        Product::create(
            [
                'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
                'price' => $request->price
            ]
        );
        return response()->json(['message' => 'Product Created Successfully']);
    }
    public function edit($product)
    {
        return view('product.edit', compact('product'));
    }
    public function update($request, $product)
    {
        $product->update(
            [
                'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
                'price' => $request->price
            ]
        );
        toast('Product Updated Successfully', 'success');
        return redirect(route('product.index'));
    }
    public function delete($product)
    {

        $product->delete();
        return response()->json(['message' => 'Product Deleted Successfully']);
    }
}
