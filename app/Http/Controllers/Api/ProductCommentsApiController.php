<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductCommentFormRequest;
use App\Http\Resources\ProductComments as ProductCommentsResource;

class ProductCommentsApiController extends Controller
{
    /**
     * Get the products comments and serve them
     *
     * @param \App\Models\Product  $product
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function retrieve(Product $product)
    {
        return ProductCommentsResource::collection($product->comments);
    }

    /**
     * Save the incoming comment to the product
     *
     * @param \App\Http\Requests\Product\CreateProductCommentFormRequest  $request
     * @param \App\Models\Product  $product
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function save(CreateProductCommentFormRequest $request, Product $product)
    {
        $comment = $product->comments()->create(
            $request->only(['name', 'message'])
        );

        return (new ProductCommentsResource($comment));
    }
}
