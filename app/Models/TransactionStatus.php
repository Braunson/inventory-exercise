<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

class TransactionStatus extends Model
{
    protected $fillable = [
        'name', 
        'slug'
    ];

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class);
    }
}
