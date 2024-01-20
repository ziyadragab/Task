<?php

namespace App\Http\Repositories;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;
use App\Models\InvoiceProduct;
use App\Http\Interfaces\InvoiceInterface;

class InvoiceRepository implements InvoiceInterface
{
    public function index()
    {
        $invoices = Invoice::with('products')->get();
        return view('invoice.index',compact('invoices'));
    }

    public function create()
    {
        $customers = Customer::get();
        $products = Product::get();

        return view('invoice.create', compact('customers', 'products'));
    }
    public function store($request)
    {

        Invoice::create(
            [
              'date'=>$request->date,
              'customer_id'=>$request->customer_id,
              'sub_total'=>$request->sub_total
            ]
            );

            return response()->json(['message'=>'Invoice Created Successfully']);
    }
    
    public function getProduct($product)
    {
        $name=$product->getTranslation('name' , app()->getLocale());

        return response()->json([ 'id'=>$product->id,'name'=>$name,'price'=>$product->price]);
    }
}
