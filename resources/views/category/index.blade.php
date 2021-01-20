@extends('layouts.app')

@section('content')

<div class="w-75 row d-flex justify-content-center mx-auto mt-5">
    @foreach ($category->subcategory as $sub)
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 p-3 border">
        <a href="{{ route('category', $sub) }}">{{ $sub->name }}</a>
    </div>
    @endforeach

</div>

<div class="row col-10 col-md-10 col-lg-9 mx-auto p-0 mt-3">
    <h2 class="col-12 mb-3">Products in category of {{ $category->name }}</h2>
    @foreach ($products as $product)
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 p-3 border">
        <x-product :product="$product" :price="$product->minPrice()"/>
    </div>

    @endforeach
    <div class="col-12 d-flex justify-content-center mt-5">
        {{ $products->links() }}
    </div>
</div>

@endsection