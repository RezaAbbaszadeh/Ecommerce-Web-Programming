@extends('layouts.app')

@section('content')

<div class="row col-12 col-md-10 col-xl-8 p-0 m-0 mb-5 mx-auto">
    <h4 class="mx-2 mt-5">Popular products</h4>
    <div class="w-100 bg-secondary mb-2" style="height: 1px;"></div>
    <div class="row mx-2">
        @foreach($popular as $product)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 p-0">
            <x-product :product=" $product" :price="$product->minPrice()" />
        </div>
        @endforeach
    </div>


    @foreach($cats as $cat)
    @if(count($cat->products) > 0)
    <a class="h5 text-secondary mx-2 mt-5" href="{{ route('category', $cat) }}">{{ $cat->name }}
        <i style="font-size: 0.9rem;" class="fa fa-chevron-right"></i>
    </a>
    <div class="w-100 bg-secondary mb-2" style="height: 1px;"></div>
    <div class="row mx-2">
        @foreach($cat->products as $product)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 p-0">
            <x-product :product="$product" :price="$product->minPrice()" />
        </div>
        @endforeach
    </div>
    @endif
    @endforeach

</div>


@endsection