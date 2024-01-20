<?php

namespace App\Http\Interfaces;

interface CustomerInterface {
    public function index($dataTable);
    public function store($request);
    public function edit($customer);
    public function update( $request, $customer);
    public function delete($customer);
}




?>
