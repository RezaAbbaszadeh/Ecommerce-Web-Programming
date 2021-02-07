
<div class="product-box card m-1 p-3">
    <a href="{{ route('product', ['product'=>$product, 'name'=>$product->name]) }}">
        <img class="card-img-top image w-100 h-auto p-1" src="{{ $product->img_url }}">
        <p class="mt-4">{{ $product->name }}</p>
        <p class="mt-4">${{ $price }}</p>
    </a>
</div>