<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
