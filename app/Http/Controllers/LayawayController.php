<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class LayawayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function save(Product $product)
    {
        // Check product quantity
        if (! $product->isAvailable()) {
            return redirect()
                    ->route('home')
                    ->withStatus('Layaway could not be completed due to in-availabilty');
        }

        // Put the product on layway
        $product->putOnLayaway(auth()->user());

        // Redirect the user back
        return redirect()
                ->route('products.show', $product)
                ->withStatus('Product has been put on your layaway');
    }
}
