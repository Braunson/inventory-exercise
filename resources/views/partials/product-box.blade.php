<div class="col-md-3 product-box">
    @if ($product->hasPhoto())
        <img src="{{ storage_path($product->photo) }}" class="img-responsive">
    @else
        <img src="//placehold.co/250x250/eeeeee/ffffff&text={{ $product->name }}" class="img-responsive">
    @endif
    <div class="product-title">{{ $product->name }}</div>
    <div class="product-cost">
        <div class="float-right">
            <span class="small mr-3">QTY: {{ number_format($product->quantity) }}</span>
            @if ($product->isAvailable()) 
                <a href="{{ route('product.show', $product) }}" class="btn btn-success btn-sm text-uppercase" role="button">Purchase</a>
            @else
                <a  class="btn btn-danger btn-disabled text-white text-uppercase btn-sm" role="button">Sold Out</a>
            @endif
        </div>
        <div class="product-text">
            ${{ $product->cost }} 
        </div>
    </div>
</div>