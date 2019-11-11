@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <product-viewer 
        :product="{{ $product->toJson() }}" 
        action="{{ route('product.purchase', $product) }}"></product-viewer>
    <hr />
    <product-comments product_id="{{ $product->id }}"></product-comments>
</div>
@endsection
