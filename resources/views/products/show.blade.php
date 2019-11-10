@extends('layouts.app')

@section('content')
<div class="container">
    <product-viewer 
        :product="{{ $product->toJson() }}" 
        action="{{ route('product.purchase', $product) }}" />
</div>
@endsection
