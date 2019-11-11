<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'message'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
