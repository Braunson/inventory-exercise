@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Products</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                            {{-- Loop out the categories --}}
                            @forelse ($categories as $category)
                                <div class="row">
                                    <h1 class="col-md-12">{{ $category->name }}</h1>

                                    {{-- Loop out the category products --}}
                                    @forelse ($category->products as $product)
                                        @include('partials.product-box')
                                    @empty
                                        <p class=>There are no products in this category.</p>
                                    @endforelse
                                </div>

                                @if (! $loop->last)
                                    <hr />
                                @endif
                            @empty
                                <div class="row">
                                    <p>There are no categories in the system.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
