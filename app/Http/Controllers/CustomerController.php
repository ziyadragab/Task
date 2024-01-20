<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CustomerDataTable;
use App\Http\Requests\CustomerRequest;
use App\Http\Interfaces\CustomerInterface;
use App\Models\Customer;

class CustomerController extends Controller
{

    private $customerInterface;

    public function __construct(CustomerInterface $customer)
    {
        $this->customerInterface = $customer;
    }

    public function index(CustomerDataTable $dataTable)
    {
        return $this->customerInterface->index($dataTable);
    }

    public function store(CustomerRequest $request)
    {
        return $this->customerInterface->store($request);
    }
    public function edit(Customer $customer)
    {
        return $this->customerInterface->edit($customer);
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        return $this->customerInterface->update($request, $customer);
    }

    public function delete(Customer $customer)
    {
        return $this->customerInterface->delete($customer);
    }
}
