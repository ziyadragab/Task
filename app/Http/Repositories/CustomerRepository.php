<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\CustomerInterface;
use App\Models\Customer;

class CustomerRepository implements CustomerInterface
{
    public function index($dataTable)
    {
        return $dataTable->render('customer.index');
     }

    public function create()
    {
    }
    public function store($request)
    {
        Customer::create(
            [
                'name'=>['en'=>$request->name_en , 'ar'=>$request->name_ar]
            ]
        );
        return response()->json(['message'=>'Customer Created Successfully']);
    }
    public function edit($customer)
    {
        return view('customer.edit',compact('customer'));
    }
    public function update($request, $customer)
    {
        $customer->update(
            [
                'name'=>['en'=>$request->name_en , 'ar'=>$request->name_ar]
            ]
        );
        toast('Customer Updated Successfully','success');
        return redirect(route('customer.index'));
    }
    public function delete($customer)
    {
     
        $customer->delete();
        return response()->json(['message'=>'Customer Deleted Successfully']);
    }
}
