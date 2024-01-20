<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Interfaces\CustomerInterface;
use App\Http\Interfaces\InvoiceInterface;
use App\Http\Interfaces\ProductInterface;
use App\Http\Repositories\CustomerRepository;
use App\Http\Repositories\InvoiceRepository;
use App\Http\Repositories\ProductRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
       $this->app->bind(CustomerInterface::class , CustomerRepository::class);
       $this->app->bind(ProductInterface::class , ProductRepository::class);
       $this->app->bind(InvoiceInterface::class , InvoiceRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
