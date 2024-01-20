@extends('layouts.master')

@section('title','Edit Customer')
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
                                Edit Customer
                            </div>

                        </div>

                        <div class="card-body">
                            <form id="" action="{{ route('customer.update', $customer) }}" method="POST">
                                @method("PUT")
                                @csrf
                                <div class="mb-3">
                                    <label class="col-form-label">Name(English):</label>
                                    <input type="text" name='name_en'
                                        class="form-control @error('name_en') is-invalid @enderror"
                                        value="{{ $customer->getTranslation('name','en') }}">
                                    @error('name_en')
                                    <span class="text-danger">{{ $message }}</span>

                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label class="col-form-label">Name(Arabic):</label>
                                    <input type="text" name='name_ar'
                                        class="form-control @error('name_ar') is-invalid @enderror"
                                        value="{{ $customer->getTranslation('name','ar') }}">
                                    @error('name_ar')
                                    <span class="text-danger">{{ $message }}</span>

                                    @enderror
                                </div>

                                <div class="modal-footer">

                                    <button class='btn btn-primary me-2' href='$editUrl'>
                                        <i class='fas fa-pencil-alt'></i>
                                    </button>
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
