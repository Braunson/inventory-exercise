<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductComments as ProductCommentsResource;
use App\Http\Controllers\Controller;

class ProductApiController extends Controller
{
    /**
     * Get the products comments and serve them
     *
     * @param \App\Models\Product  $product
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getComments(Product $product)
    {
        return ProductCommentsResource::collection($product->comments);
    }

    /**
     * Save the incoming comment to the product
     *
     * @param \Request  $request
     * @param \App\Models\Product  $product
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function saveComment(Request $request, Product $product)
    {
        $comment = $product->comments()->create(
            $request->only(['name', 'message'])
        );

        return (new ProductCommentsResource($comment));
    }
}
