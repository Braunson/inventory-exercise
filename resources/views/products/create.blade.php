@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Product</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul class="mb-0 mt-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="container">
                        <div class="row">
                           
                            <form method="POST" action="{{ route('products.store') }}" class="w-100" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label for="productName" class="col-md-3 col-form-label">Name</label>
                                    <div class="col-md-9">
                                        <input type="text" name="name" class="form-control" id="productName" placeholder="Product Name" value="{{ old('name') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="productDescription" class="col-md-3 col-form-label">Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" id="productDescription" name="description" placeholder="Product description goes here..">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="productCategory" class="col-md-3 col-form-label">Category</label>
                                    <div class="col-md-9">
                                        <select name="product_category_id" name="productCategory" class="form-control">
                                            @foreach ($categories as $id => $name)
                                                <option value="{{ $id }}" @if (old('product_category_id') && old('product_category_id') == $id)) selected @endif>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="productCost" class="col-md-3 col-form-label">Cost</label>
                                    <div class="col-md-3 input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" step="any" name="cost" class="form-control" id="productCost" placeholder="0.99" value="{{ old('cost') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="productQuantity" class="col-md-3 col-form-label">Quantity Available</label>
                                    <div class="col-md-2">
                                        <input type="number" name="quantity" class="form-control" id="productQuantity" placeholder="1" value="{{ old('quantity', 1) }}" min="1">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="productPhoto" class="col-md-3 col-form-label">Photo</label>
                                    <div class="col-md-9">
                                        <input type="file" name="photo" class="form-control-file" id="productPhoto">
                                    </div>
                                </div>
                                 
                                <div class="form-group row mb-0">
                                    <div class="col-md-9 offset-md-3">
                                        <button type="submit" class="btn btn-primary">Submit Product</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
