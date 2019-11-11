<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

class Layaway extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'full_cost',
        'cost_remaining',
        'quantity',
        'notes',
        'expires_on'
    ];

    protected $dates = [
        'expires_on'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function transactions()
    {
        return $this->belongsTo(Transaction::class);
    }
    
    /**
     * Helper to return if a layaway is paid off
     *
     * @return bool
     */
    public function isPaidOff()
    {
        return (bool) is_null($this->cost_remaining);
    }
}
