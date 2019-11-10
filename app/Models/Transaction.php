<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\TransactionType;
use App\Models\TransactionStatus;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'cost',
        'quantity',
        'user_id',
        'product_id',
        'transaction_type_id',
        'transaction_status_id',
        'transaction_status_details',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function type()
    {
        return $this->hasOne(TransactionType::class);
    }

    public function status()
    {
        return $this->hasOne(TransactionStatus::class);
    }
}