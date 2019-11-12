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
        $user = auth()->user();

        // Check product quantity
        if (! $product->isAvailable()) {
            return redirect()
                    ->route('home')
                    ->withStatusError('warning')
                    ->withStatus('Layaway could not be completed due to in-availabilty');
        }

        // Is the product already on the user's layaway?
        // For our online store rules, they can only have one layaway at a time
        // This may differe depending on other "store" scopes. :)
        if ($product->isAlreadyOnUsersLayaway($user)) {
            return redirect()
                    ->route('products.show', $product)
                    ->withStatusError('danger')
                    ->withStatus('Could not add to layaway, you already have this product on layaway.');
        }

        // Put the product on layway
        $product->moveToLayaway($user);

        // Redirect the user back
        return redirect()
                ->route('products.show', $product)
                ->withStatus('Success! The product "' . $product->name . '" has been put on your layaway');
    }
}
