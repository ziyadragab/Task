<?php

namespace App\Http\Interfaces ;

interface InvoiceInterface {
    public function index();
    public function create();
    public function store($request);
    public function getProduct($product);


}




?>
