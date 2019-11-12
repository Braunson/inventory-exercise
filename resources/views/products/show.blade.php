@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="row justify-content-center">
            <div class="alert alert-{{ session('status_error') ?? 'success' }} col-md-9" role="alert">
                {{ session('status') }}
            </div>
        </div>
    @endif

    <product-viewer 
        :product="{{ $product->toJson() }}" 
        action="{{ route('product.purchase', $product) }}"></product-viewer>
    <hr />
    <product-comments product_id="{{ $product->id }}"></product-comments>
</div>
@endsection
