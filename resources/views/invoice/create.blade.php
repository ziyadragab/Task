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

                        </div>

                        <div class="card-body">

                            <form action="{{ route('invoice.store') }}" id="invoiceForm">
                                @csrf
                                <div class="mb-3">
                                    <label class="col-form-label">Date:</label>
                                    <input type="date" name="date" id="date">

                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Customer:</label>
                                    <select class="form-select" name="customer_id" id="customer_id" aria-label="Select a customer">
                                        <option selected disabled>Select a customer</option>
                                        @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Product:</label>
                                    <select class="form-select" name="" id="selectProduct"
                                        aria-label="Select a product">
                                        <option value="">~~SELECT~~</option>
                                        @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            data-url="{{ route('invoice.getProduct', $product) }}" {{
                                            old('product_id')==$product->id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <table class="table table-bordered table-hover table-striped" id="invoice_table">
                                        <thead>
                                            <tr>
                                                <th width="500">
                                                    product
                                                </th>
                                                <th>
                                                    Qty </th>
                                                <th>
                                                    Price
                                                </th>

                                                <th>
                                                    Total
                                                </th>
                                                <th>
                                                    __
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="invoiceBody">
                                            <!-- Existing row for reference -->

                                        </tbody>

                                    </table>
                                </div>
                                <label for="">Sub Total</label>
                                <input type="text" id="sub_total" aria-describedby='sizing-addon1' name='sub_total'>
                                <div class="modal-footer">
                                    <a type="" id="create" class="btn btn-primary">Create</a>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')


@include('invoice.handle_create_invoice')


@endpush
