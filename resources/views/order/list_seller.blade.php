@extends('layouts.app')

@section('content')

<div class="col-12 col-md-8 col-xl-7 mx-auto mt-4 row">

    @foreach($productSellers as $productSeller)

    <div class="col-6 col-md-4 col-xl-3">
        <div class="w-100 bg-light row mt-3 p-4 bg-white border rounded shadow-animated mx-2">
            <a class="text-decoration-none" href="{{ route('product', [$productSeller->product, $productSeller->product->name]) }}">
                <img class="w-100 h-auto" src="{{ $productSeller->product->img_url }}" />
                <p class="mt-3">{{ $productSeller->product->name }}</p>
                <p class="text-danger">Price: ${{ $productSeller->price }}</p>
                <p>Sold number: {{ $productSeller->sum }}</p>

            </a>
        </div>

    </div>
    @endforeach
</div>
@endsection