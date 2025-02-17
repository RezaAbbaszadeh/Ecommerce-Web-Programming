@extends('layouts.app')

@section('content')

<div class="col-12 col-md-6 mx-auto mt-5">
    <form class="wrapper" action="{{ route('seller.add') }}" method="get">
        <button class="btn w-100" type="submit">Add new products</button>
    </form>
</div>

<div class="row col-10 col-md-10 col-lg-9 mx-auto p-0 my-5">
    <h1 class="col-12 h1 mb-3">Your products</h1>
    @foreach ($productSellers as $ps)
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 p-0">
        <x-product :product="$ps->product" :price="$ps->price" />
    </div>
    @endforeach

    <div id="pagination" class="col-12 d-flex justify-content-center my-5">
        {{ $productSellers->links() }}
    </div>
</div>

@endsection