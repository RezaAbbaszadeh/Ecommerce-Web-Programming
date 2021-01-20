@props(['product' => $product, 'price'=>$price])

<img class="image w-100 h-auto" src="{{ $product->img_url }}">
<p class="mt-4">{{ $product->name }}</p>
<p class="mt-4">${{ $price }}</p>