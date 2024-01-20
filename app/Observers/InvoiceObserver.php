<?php

namespace App\Observers;

use App\Models\Invoice;
use App\Models\InvoiceProduct;

class InvoiceObserver
{
    /**
     * Handle the Invoice "created" event.
     */
    public function created(Invoice $invoice): void
    {
        $products = request()->input('invoice_products');

        foreach ($products as $product) {
            InvoiceProduct::create([
                'quantity'    => $product['quantity'],
                'total_price' => $product['subtotal'],
                'product_id'  => $product['product_id'],
                'invoice_id'  => $invoice->id,
            ]);
        }
    }

    /**
     * Handle the Invoice "updated" event.
     */
    public function updated(Invoice $invoice): void
    {
        //
    }

    /**
     * Handle the Invoice "deleted" event.
     */
    public function deleted(Invoice $invoice): void
    {
        //
    }

    /**
     * Handle the Invoice "restored" event.
     */
    public function restored(Invoice $invoice): void
    {
        //
    }

    /**
     * Handle the Invoice "force deleted" event.
     */
    public function forceDeleted(Invoice $invoice): void
    {
        //
    }
}
