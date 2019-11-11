<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_category_id' => 'required|integer|exists:product_categories,id',
            'name'                => 'required|string',
            'description'         => 'required|string',
            'cost'                => 'required',
            'quantity'            => 'required|integer|min:1',
            'photo'               => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
