@extends('layouts.master')

@section('title','Customer')
@section('content')

<div class="main-content" style="width: 80%; margin: auto; margin-top: 50px ">

    <div class="page-content" >
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="text-center">
                                customers
                            </div>
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#customer" data-bs-whatever="@fat">
                                Create New
                            </button>
                        </div>

                        <div class="card-body">
                            <div class="modal fade" id="customer" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add New customer</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="customerForm">
                                                <div class="mb-3">
                                                    <label class="col-form-label">Name(English):</label>
                                                    <input type="text" name='name_en' class="form-control" id="">
                                                    <span id="nameEnglishError" class="text-danger errorMessage"></span>
                                                </div>


                                                <div class="mb-3">
                                                    <label class="col-form-label">Name(Arabic):</label>
                                                    <input type="text" name='name_ar' class="form-control" id="">
                                                    <span id="nameArabicError" class="text-danger errorMessage"></span>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" id="create"
                                                        class="btn btn-primary">Create</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{ $dataTable->table(['class' => 'table table-dark table-striped', 'id' =>
                            'customer-table']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
{{ $dataTable->scripts() }}
<script>
    $(document).ready(function() {

            $('#create').click(function() {
                $('.errorMessage').html('');
                let form = $('#customerForm');
                let formData = new FormData(form[0]);
                console.log(formData);
                $.ajax({
                    type: "POST",
                    url: "{{ route('customer.store') }}",
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: function(response) {
                        $('#customer').modal('hide');
                        form[0].reset();
                        Swal.fire('Success!', response.message, 'success');
                        reloadDataTable();
                    },
                    error: function(error) {
                        if (error) {
                            $('#nameEnglishError').html(error.responseJSON.errors.name_en);
                            $('#nameArabicError').html(error.responseJSON.errors.name_ar);

                        }
                    }
                });
            });

            function reloadDataTable() {
                var dataTable = $('#customer-table').DataTable();
                dataTable.ajax.reload(null, false);
            }
            $(document).on('click', '#delete', function() {
                let customerId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Perform AJAX request for deletion
                        $.ajax({
                            url: "{{ route('customer.delete', ['customer' => '__customerId']) }}".replace('__customerId', customerId),
                            method: 'DELETE',
                            success: function(response) {
                                Swal.fire('Deleted!', response.message, 'success');
                                $('#customer-table').DataTable().ajax.reload();
                            },
                            error: function(xhr, status, error) {
                                Swal.fire('Error!', 'Failed to delete the ad.', 'error');
                            }
                        });
                    }
                });
            });
        });


</script>
@endpush
