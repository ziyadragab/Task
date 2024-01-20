<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use App\DataTables\InvoiceDataTable;
use App\Http\Requests\InvoiceRequest;
use App\Http\Interfaces\InvoiceInterface;

class InvoiceController extends Controller
{
    private $invoiceInterface;

    public function __construct(InvoiceInterface $invoice)
    {
        $this->invoiceInterface = $invoice;
    }
    public function index()
    {
        return $this->invoiceInterface->index();

    }
    public function create()
    {
        return $this->invoiceInterface->create();

    }

    public function store(InvoiceRequest $request)
    {
        return $this->invoiceInterface->store($request);

    }
    public function getProduct(Product $product)
    {
        return $this->invoiceInterface->getProduct($product);
    }

}
