<?php

namespace App\Observers;

use App\Models\Transaction;

class TransactionObserver
{
    /**
     * Handle the transaction "created" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        if ($transaction->status->id == 1) { // Successful
            $purchased = $transaction->quantity;
            $transaction->product()->decrement('quantity', $purchased);
        }
    }
}
