@extends('layouts.master')

@section('title','Invoice')
@section('content')

<div class="main-content" style="width: 80%; margin: auto; margin-top: 50px ">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="text-center">
                                Invoices
                            </div>
                            <a href="{{ route('invoice.create') }}" class="btn btn-outline-primary" >
                                Create New
                            </a>
                        </div>

                        <div class="card-body">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer</th>
                                        <th>Products</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->id }}</td>
                                            <td>{{ $invoice->customer->name }}</td>
                                            <td>
                                               
                                                    @foreach ($invoice->products as $product)
                                                        {{ $product->product->name }} ({{ $product->quantity }}) 
                                                        ($ {{ $product->total_price }}) 
                                                    <br>

                                                    @endforeach
                                              
                                            </td>
                                            <td>$ {{ $invoice->sub_total }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
