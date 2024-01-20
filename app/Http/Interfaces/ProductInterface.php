<?php

namespace App\Http\Interfaces ;

interface ProductInterface {
    public function index($dataTable);
    public function store($request);
    public function edit($product);
    public function update($request, $product);
    public function delete($product);
}




?>
