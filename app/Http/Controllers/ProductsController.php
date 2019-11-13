<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionType;
use App\Models\ProductCategory;
use App\Http\Requests\Product\CreateProductFormRequest;

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
     * @param App\Http\Requests\Product\CreateProductFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductFormRequest $request)
    {
        // Upload the image
        $imagePath = $request->file('photo')->storeAs(
            'images/products', time() . '.' . $request->photo->extension(), 'public'
        );

        // Create the product
        $product = Product::create(
            array_merge($request->except('_csrf'), ['photo' => $imagePath])
        );

        // Redirect the4 user
        return redirect()
            ->route('products.index')
            ->withStatus('Product ' . $product->name . ' was successfully created!');
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

}
