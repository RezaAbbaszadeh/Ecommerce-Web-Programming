@extends('layouts.app')

@section('content')

<div class="col-12 col-md-11 col-lg-10 col-xl-8 mx-auto mt-5">


    @foreach($cart->order_product_sellers as $ops)
    <div class="bg-white border rounded m-2 shadow-sm row">
        <div class="col-12 col-md-6 col-lg-4 col-xl-3 border-right">
            <img class="p-5 w-100 h-auto" src="{{ $ops->product_seller->product->img_url }}" />
        </div>
        <div class="col-12 col-md-3 col-lg-4 col-xl-4 p-4">
            <p>{{ $ops->product_seller->product->name }}</p>
            <p>brand: Apple</p>

            <p>seller: {{ $ops->product_seller->seller->user->name }}</p>
        </div>
        <div class="col-12 col-md-3 col-lg-4 col-xl-4 p-4">
            <p class="">color:
                <span class="color d-inline-block ml-3" style="background-color: #ffeb3b;"></span>
                <span>yellow</span>
            </p>

            <p>number: {{ $ops->count }}</p>

            <p>price: {{ $ops->product_seller->price }}</p>
        </div>
    </div>
    @endforeach

    <p></p>
    <form action="{{ route('cart', $cart) }}" method="post">
        @csrf
        <button class="btn w-100" type="submit">Order</button>
    </form>

</div>

@endsection