@extends('layouts.app')

@section('content')

<div class="col-12 col-md-6 mx-auto mt-5">
    <form class="wrapper" action="{{ route('seller.add') }}" method="get">
        <button class="btn w-100" type="submit">Add new products</button>
    </form>
</div>

<div class="row col-10 col-md-10 col-lg-9 mx-auto p-0 mt-5">
    <h1 class="col-12 h1 mb-3">Your products</h1>
    @foreach ($products as $product)
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 p-3 border">
        <img class="image w-100 h-auto" src="{{ $product->img_url }}">
        <p class="mt-4">{{ $product->name }}</p>
        <p class="mt-4">${{ $product->price }}</p>
    </div>

    @endforeach
    

</div>

@endsection