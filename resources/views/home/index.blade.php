@extends('layouts.app')

@section('content')

<h1>Popular</h1>
<div class="row">
    @foreach($popular as $product)
    <div class="col-2"">
        <x-product :product=" $product" :price="$product->minPrice()" />
</div>
@endforeach
</div>


@foreach($cats as $cat)
<h1>{{ $cat->name }}</h1>
<div class="row">
    @foreach($cat->products as $product)
    <div class="col-2">
        <x-product :product="$product" :price="$product->minPrice()" />
    </div>
    @endforeach
</div>
@endforeach


@endsection