<?php

namespace App\Models;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_category_id',
        'name',
        'photo',
        'description'
        'cost',
        'quantity'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
