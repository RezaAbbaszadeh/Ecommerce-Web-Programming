@props(['product' => $product, 'price'=>$price])

<div class="shadow-animated product-box card m-1 p-3">
    <a class=" text-decoration-none" href="{{ route('product', ['product'=>$product, 'name'=>$product->name]) }}">
        <img class="card-img-top image w-100 h-auto p-1" src="{{ $product->img_url }}">
        <p class="mt-4 text-nowrap text-truncate text-dark text-decoration-none">{{ $product->name }}</p>
        <p class="mt-4 text-danger h5">${{ $price }}</p>
    </a>
</div>