@extends('layouts.app')

@section('content')

<div class="col-12 col-md-11 col-lg-10 mx-auto mt-5">

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
        <div class="col-4 border-right">
            <img class="p-5 w-100 h-auto" src="{{ $product->img_url }}" />
        </div>
        <div class="col-4 p-4">
            <p>brand: Apple</p>
            <p class="mt-5">pick a color:
                <span class="color d-inline-block ml-3" style="background-color: #ffeb3b;"></span>
                <span>yellow</span>
            </p>

            <p class="mt-5">pick seller:</p>
            <select class="form-control" name="seller" id="seller" onchange="{ 
                    var price = $('#seller').find(':selected').val();
                    $('#p').text(price.substring(price.indexOf('/') + 1)); 
                    }">
                @foreach($ps as $p)
                <option value="{{ (string)$p->seller->id . '/'. (string)$p->price }}">{{ $p->seller->user->name }}
                </option>
                @endforeach
            </select>

        </div>
        <div class="col-4">
            <h1 id="d-price" class="text-danger mt-4 mx-auto text-center"></h1>
            <script>
                $('#d-price').text('$' + {{ $ps[0]-> price }}); 
            </script>

            <form action="" method="post" class="mt-5 align-bottom">
                <button class="btn w-100" type="submit">Add to cart</button>
            </form>
        </div>
    </div>

</div>


@endsection