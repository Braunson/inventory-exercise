<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class LayawayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Save the products to the users layaway.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function save(Product $product)
    {
        $user = auth()->user();

        if ($check = $this->layawayCheck($product, $user)) {
            $product->moveToLayaway($user);
        }

        $class   = $check ? 'success' : 'danger';
        $message = $check ? __('layaway.success', ['product' => $product->name]) : __('layaway.failed');

        return redirect()
                ->route('products.show', $product)
                ->withStatusError($class)
                ->withStatus($message);
    }

    /**
     * Check if the product is accessible to the user
     *
     * @param \App\Models\Product  $product
     * @param \App\Models\User  $user
     * @return boolean
     */
    protected function layawayCheck(Product $product, User $user)
    {
        return (bool) (! $product->isAvailable() || ! $product->isAlreadyOnUsersLayaway($user));
    }
}
