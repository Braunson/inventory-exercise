<?php

namespace App\Models;

use App\Models\Layaway;
use App\Models\Transaction;
use App\Models\ProductComment;
use App\Models\TransactionType;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;
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

    public function comments()
    {
        return $this->hasMany(ProductComment::class);
    }

    public function layaway()
    {
        return $this->hasMany(Layaway::class);
    }

    /**
     * Helper to return the full photo path if a photo is set
     */
    public function getPhotoPathAttribute()
    {
        return $this->hasPhoto() ? Storage::url($this->photo) : null;
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
            'view'    => route('products.show', $this),
            'layaway' => route('layaway.save', $this),
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

    /**
     * Check if this product is already on a users layaway list
     * and if it is, is it paid for or pending still
     *
     * @param \App\Models\User  $user
     * @return boolean
     */
    public function isAlreadyOnUsersLayaway(User $user)
    {
        // Should we restrict first?
        if (config('LAYAWAY_RESTRICT_PRODUCT') === FALSE) {
            return false;
        }

        // Check for this product on the user's layaway list
        $layaway = $user->layaway()->whereProductId($this->id)->first();

        // Did we find an entry and is it paid off or not?
        return (bool) (! is_null($layaway) && ! $layaway->isPaidOff());
    }


    /**
     * Helper to put a product on layaway and create a fake deposit transaction
     *
     * @param \App\Models\User  $user
     * @return boolean
     */
    public function moveToLayaway(User $user)
    {
        // Half upfront deposit
        // Realistically we'd take payment of the user's choosing
        // Either full upfront or a deposit and then record it accordingly.
        $deposit = (float) $this->cost / 50;
        $quantity = 1;

        // Create the layway
        $layaway = $this->layaway()->create([
            'user_id' => $user->id,
            'full_cost' => $this->cost,
            'cost_remaining' => $deposit, // Rough mock in
            'quantity' => $quantity, // Rough mock in
            'notes' => 'This is automated test layaway.',
            'expires_on' => now()->addDays(90)->toDateTime()
        ]);

        // @TODO move this to an observer on Layaway
        $layaway->transactions()->create([
            'cost' => $deposit,
            'quantity' => $quantity,
            'product_id' => $this->id,
            'user_id' => $user->id,
            'transaction_type_id' => TransactionType::DEPOSIT,
            'transaction_status_id' => 1 // Successfull - Placeholder
        ]);

        return $layaway;
    }
}
