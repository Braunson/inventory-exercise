<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    const PAYMENT = 1;
    const DEPOSIT = 2;

    protected $fillable = [
        'name', 
        'slug'
    ];

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class);
    }
}
