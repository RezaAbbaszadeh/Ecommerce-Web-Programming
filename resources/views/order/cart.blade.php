@extends('layouts.app')

@section('content')

<div class="col-12 col-md-11 col-lg-10 col-xl-9 mx-auto mt-5 row">

    <div class="col-12 col-lg-9">
        @foreach($cart->order_product_sellers as $ops)
        <div class="bg-white border rounded m-2 shadow-sm row">
            <div class="col-12 col-md-5 col-lg-4 col-xl-4 border-right">
                <img class="p-4 w-100 h-auto" src="{{ $ops->product_seller->product->img_url }}" />
            </div>
            <div class="col-12 col-md-3 col-lg-4 col-xl-4 p-4">
                <p>{{ $ops->product_seller->product->name }}</p>
                <p>brand: Apple</p>
                <p class="">color:
                    <span class="color d-inline-block ml-3" style="background-color: #ffeb3b;"></span>
                    <span>yellow</span>
                </p>
                <p>seller: {{ $ops->product_seller->seller->user->name }}</p>
                <p>price: {{ $ops->product_seller->price }}</p>
            </div>
            <div class="col-12 col-md-4 col-lg-4 col-xl-4 p-4">
                <p>number:</p>
                <p class="border rounded p-2 d-inline-block">
                    @if(!$cart->is_done)
                    <i class="fa fa-minus p-2 mr-3 cursor-pointer count-btn"
                        onclick="updateCount({{ $ops->id }},-1, {{ $ops->product_seller->price }})"></i>
                    @endif
                    <span id="{{ $ops->id }}-count">{{ $ops->count }}</span>
                    @if(!$cart->is_done)
                    <i class="fa fa-plus cursor-pointer p-2 ml-3 count-btn"
                        onclick="updateCount({{ $ops->id }},1, {{ $ops->product_seller->price }})"></i>
                    @endif
                </p>
                <p id="number-error" class="error text-danger"></p>

                <br>
                @if(!$cart->is_done)
                <form method="POST" action="{{ route('cart.delete', ['id'=>$ops->id]) }}">
                    @csrf
                    <button class="border border-danger rounded mt-1 d-inline-block px-3 py-2 delete-btn">
                        Delete item
                        <span class="fa fa-trash text-danger p-1 " aria-hidden="true"></span>
                    </button>
                </form>
                @endif
            </div>
        </div>
        @endforeach
    </div>


    <div class="col-12 col-lg-3 p-0">
        <div class="bg-white border rounded my-2 mx-5 mx-md-0 pb-3 shadow-sm">
            <h3 class="text-center mt-4">
                @if(!$cart->is_done) Your cart price @else Order price @endif
            </h3>
            <h2 id="sum" class="text-center mt-4 text-danger">${{ $sum }}</h2>
            @if(!$cart->is_done and $sum != 0)
            <form class="col-12 mt-2 mt-lg-5" action="{{ route('cart', $cart) }}" method="post">
                @csrf
                <button class="btn w-100" type="submit">Submit Order</button>
            </form>
            @endif
        </div>

    </div>
</div>

@if(!$cart->is_done)
<script>
    var isRequestRunning = false;
    function updateCount(id, value, price) {
        if (isRequestRunning == false) {
            isRequestRunning = true;
            $(".count-btn").css('color', '#eeeeee');
            jQuery.ajax({
                url: "{{ route('cart.update') }}",
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "value": value
                },
                success: function (result) {
                    isRequestRunning = false;
                    $('#' + id + '-count').html(result);
                    $('#number-error').html("");
                    $(".count-btn").css('color', '#000000');
                    $("#sum").text(
                        '$' + (parseInt($("#sum").text().substring(1)) + price * value)
                    );
                },
                error: function (errors) {
                    isRequestRunning = false;
                    console.log(errors.responseJSON.error);
                    $('#number-error').html(errors.responseJSON.error);
                    $(".count-btn").css('color', '#000000');
                }

            });
        }
    }
</script>
@endif

@endsection