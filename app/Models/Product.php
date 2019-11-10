<?php

namespace App\Models;

use App\Models\Transaction;
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
        'description',
        'cost',
        'quantity'
    ];

    protected $appends = [
        'photo_path',
        'stock_text',
        'routes'
    ];

    public function transaction()
    {
        return $this->belongsToMany(Transaction::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    /**
     * Helper to return the full photo path if a photo is set
     */
    public function getPhotoPathAttribute()
    {
        return $this->hasPhoto() ? storage_path($this->photo) : null;
    }

    /**
     * Helper to return the stock text (for the Vue componenbt)
     */
    public function getStockTextAttribute()
    {
        return $this->stockText();
    }

    /**
     * Helper to return URL routes for this product (for the Vue componenbt)
     */
    public function getRoutesAttribute()
    {
        return [
            'view'    => route('product.show', $this),
            'layaway' => route('layaway.show', $this),
        ];
    }

    /**
     * Helper to determine if the product has a photo set
     */
    public function hasPhoto()
    {
        return (bool) ! is_null($this->photo);
    }

    /**
     * Helper to determine if the product is available to purchase based on quantity
     */
    public function isAvailable()
    {
        return (bool) ($this->quantity > 0);
    }

    /**
     * Blade helper to return formatted stock text
     */
    public function stockText()
    {
        return (string) $this->isAvailable() ?  number_format($this->quantity) . ' ' . __('In Stock') : __('Out Of Stock');
    }
}
