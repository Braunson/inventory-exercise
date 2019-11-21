<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Product\PurchaseProductFormRequest;
use App\Http\Resources\ProductComments as ProductCommentsResource;

class ProductApiController extends Controller
{
    /**
     * Log the purchase editing the specified resource.
     *
     * @param  \App\Http\Requests\Product\PurchaseProductFormRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
     public function purchase(PurchaseProductFormRequest $request, Product $product)
     {
        if (Gate::denies('product-is-available', $product)) {
            return response('Not available', 400);
        }

        // Create the product transaction
        Transaction::create([
            'cost' => $product->cost,
            'quantity' => $request->quantity,
            'user_id' => auth()->user()->id,
            'product_id'=> $product->id,
            'transaction_type_id' => TransactionType::PAYMENT,
            'transaction_status_id' => 1 // Successfull - Placeholder
        ]);

        // Reload since the observer updated the qty
        $product->refresh();

        // Success
        return response()->json($product);
     }
}
