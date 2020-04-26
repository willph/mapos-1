<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'barcode',
        'purchase_price',
        'sale_price',
        'unit',
        'quantity_in_stock',
        'minimum_quantity_in_stock',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'purchase_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'quantity_in_stock' => 'integer',
        'minimum_quantity_in_stock' => 'integer',
    ];
}
