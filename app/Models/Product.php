<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['id', 'name', 'price'];
    public $translatable = ['name'];

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'invoice_products');
    }
}
