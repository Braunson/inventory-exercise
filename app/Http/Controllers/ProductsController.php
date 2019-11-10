<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionType;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')
                ->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductCategory::with(['products' => function ($query) {
            $query->orderBy('name', 'desc');
        }])->orderBy('name', 'desc')->get();

        return view('products.index')->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get the product catgories alphabetically
        $categories = ProductCategory::orderBy('name', 'asc')->pluck('name', 'id');

        return view('products.create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show')->withProduct($product);
    }

    /**
     * Log the purchase editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
     public function purchase(Request $request, Product $product)
     {
        if (! $product->isAvailable()) {
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
