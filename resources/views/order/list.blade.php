@extends('layouts.app')

@section('content')

<div class="col-12 col-md-8 col-xl-7 mx-auto mt-4 row">

    @foreach($orders as $order)
    <a href="{{ route('cart', $order->id) }}">
        <div class="w-100 bg-light row mt-3 p-4 bg-white border rounded shadow-sm mx-0">
            <div class="col-12 col-sm-4 col-lg-3 col-xl-2">
                <p>{{ $order->order_date }}</p>
                <p class="text-danger">${{ $order->sum }}</p>
            </div>
            <div class="col-12 col-sm-8 col-lg-9 col-xl-10 row">
                @foreach($order->order_product_sellers as $ops)
                <div class="col-4 col-lg-3 col-xl-2">
                    <img class="w-100 h-auto" src="{{ $ops->product_seller->product->img_url }}" />
                </div>
                @endforeach
            </div>
        </div>
    </a>
    @endforeach
</div>
@endsection