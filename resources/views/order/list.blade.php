@extends('layouts.app')

@section('content')

<div class="col-12 col-md-8 col-xl-7 mx-auto mt-4 row">

    @foreach($orders as $order)
    <div class="w-100 bg-light row mt-3 p-4 bg-white border rounded shadow-sm mx-0">
        <a href="{{ route('cart', $order->id) }}">
            <div class="row">
                <div class="col-12 col-sm-4 col-lg-3 col-xl-3">
                    <p>Date: {{ $order->order_date }}</p>
                    <p class="text-danger">Price: ${{ $order->sum }}</p>
                </div>
                <div class="col-12 col-sm-8 col-lg-9 col-xl-9 row">
                    @foreach($order->order_product_sellers as $ops)
                    <div class="col-4 col-lg-3 col-xl-2">
                        <img class="w-100 h-auto" src="{{ $ops->product_seller->product->img_url }}" />
                    </div>
                    @endforeach
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
@endsection