@extends('layouts.app')

@section('content')

<div class="col-12 col-md-11 col-lg-10 mx-auto my-5">

    <div class="d-flex justify-content-start">
        @php $x = $product->category @endphp
        <a class="text-secondary" href="{{ route('category', $x) }}">{{ $x->name }}</a>
        @while ($x->parent_id)
        @php $x = $x->parentCategory @endphp
        <span class="fa fa-chevron-right my-auto mx-2" style="font-size: 12px;"></span>
        <a class="text-secondary" href="{{ route('category', $x) }}">{{ $x->name }}</a>
        @endwhile
    </div>


    <div class="bg-white border row">
        <div class="col-12 col-md-4 border-right">
            <img class="p-4 w-100 h-auto" src="{{ $product->img_url }}" />
        </div>
        <div class="col-12 col-sm-6 col-md-4 p-4">
            <h2>{{ $product->name }}</h2>
            <p class="mt-5">pick a color:
                <span class="color d-inline-block ml-3" style="background-color: #ffeb3b;"></span>
                <span>yellow</span>
            </p>

            <p class="mt-5">pick seller:</p>
            <select class="form-control" name="seller" id="seller" onchange="{ 
                    var price = $('#seller').find(':selected').val();
                    $('#d-price').val(price.substring(price.indexOf('/') + 1)); 
                    $('#product_seller_id_id').val(price.substring(0,price.indexOf('/')));
                    }">
                @foreach($ps as $p)
                <option value="{{ (string)$p->id . '/'. (string)$p->price }}">{{ $p->seller->user->name }}
                </option>
                @endforeach
            </select>

        </div>
        <div class="col-12 col-sm-6 col-md-4 mb-4">
            <h1 id="d-price" class="text-danger mt-4 mx-auto text-center">${{ $ps[0]->price }}</h1>
            

            @if(auth()->user()->isCustomer)
            <form action="{{ route('product.store') }}" method="post" class="mt-5 align-bottom">
                @csrf
                <div class="form-group">
                    <label for="count">How many/much of this product for sale:</label>
                    <input class="form-control @error('count') border-dander border-danger @enderror" type="number"
                        name="count" placeholder="Enter number" value="{{ old('count') }}">
                    @error('count')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button class="btn w-100" type="submit">Add to cart</button>
                <input type="hidden" value="{{ $ps[0]->id }}" name="product_seller_id" id="product_seller_id_id">
            </form>
            @endif
        </div>
    </div>

    <div class="multiline">
        <h1>Details</h1>
        {{ $product->details }}
    </div>

</div>


@endsection