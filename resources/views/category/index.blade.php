@extends('layouts.app')

@section('content')

<div class="col-12 col-md-11 col-lg-9 row d-flex justify-content-center mx-auto mt-5">
    @foreach ($category->subcategory as $sub)
    <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2 rounded-lg p-0 border position-relative">
        <a class="position-absolute rounded-lg w-100 h-100 align-bottom"
            style="background-color: #333333; opacity: 0.5;" href="{{ route('category', $sub) }}"></a>
        <p class="centered h3 font-weight-bold text-white">{{ $sub->name }}</p>
        <img class="w-100 h-auto rounded-lg" src="{{ $sub->img_url }}">
    </div>
    @endforeach

</div>
<br>

<script>
    $(document).ready(function () {
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function () {
            $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });

        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function () {
            $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function () {
            $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
        });
    });
</script>
<div class="row col-12 wrapper justify-content-center justify-content-xl-start p-0 m-0 mb-5">


    <div class="col-12 col-md-10 col-lg-7 col-xl-3 mt-3">
        <form action="{{ route('category', $category) }}" method="get">
            <div class="row mx-3">
                <h2 class="col-6 align">Filters</h2>
                <button type="submit" class="col-6 btn h3 text-danger bg-light border border-dander p-1"
                    style="font-size: 1.5rem;">Submit</button>
            </div>
            <div class="card bg-white mx-3">
                <div class="card-header p-0 bg-white" id="headingOne">
                    <h2 class="mb-0">
                        <button type="button" class="btn btn-link text-decoration-none w-100 text-left"
                             id="price_btn" data-toggle="collapse" data-target="#collapseOne"><i class="fa fa-plus"></i> Minimum price {{ $min_price }}</button>
                    </h2>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
                    <div class="card-body w-100">
                        <input type="range" id="min_price" name="min_price" class="w-100" min="1" max="1000" value="{{ $min_price }}" />
                    </div>
                </div>
                <script>
                    $('#min_price').on('input', function () {
                        $('#price_btn').html("<i class='fa fa-plus'></i> Minimum price " + $('#min_price').val())
                    });
                </script>
            </div>
            <div class="card bg-white mx-3 mt-3">
                <div class="card-header p-0 bg-white" id="headingTwo">
                    <h2 class="mb-0">
                        <button type="button" class="btn btn-link text-decoration-none w-100 text-left"
                            data-toggle="collapse" data-target="#collapseTwo"><i class="fa fa-plus"></i> Search</button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingOne">
                    <div class="card-body w-100">
                        <div class="input-group mr-sm-2 w-100">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light" id="basic-addon2">
                                    <i class="fa fa-search"></i></span>
                            </div>
                            <input type="text" id="search-temp" class="form-control p-2 bg-light h-100"
                                placeholder="Search in results" name="search_cat" aria-label="Username"
                                aria-describedby="basic-addon1" autocomplete="off" value="{{ $search_cat }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-white mx-3 mt-3">
                <div class="card-header p-0 bg-white" id="headingThree">
                    <h2 class="mb-0">
                        <button type="button" class="btn btn-link text-decoration-none w-100 text-left"
                            data-toggle="collapse" data-target="#collapseThree"><i class="fa fa-plus"></i>
                            Brands</button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse show" aria-labelledby="headingThree">
                    <div class="card-body w-100">
                        <input type="checkbox" class="form-check-input ml-1">
                        <label class="form-check-label ml-4">Samsung</label><br>
                        <input type="checkbox" class="form-check-input ml-1">
                        <label class="form-check-label ml-4">Apple</label><br>
                        <input type="checkbox" class="form-check-input ml-1">
                        <label class="form-check-label ml-4">Huawei</label><br>
                        <input type="checkbox" class="form-check-input ml-1">
                        <label class="form-check-label ml-4">Xiaomi</label><br>
                        <input type="checkbox" class="form-check-input ml-1">
                        <label class="form-check-label ml-4">Nokia</label><br>
                        <input type="checkbox" class="form-check-input ml-1">
                        <label class="form-check-label ml-4">Motorola</label><br>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <div id="producs_container" class="row col-10 col-md-10 col-xl-8 p-0 mt-3">
        <h2 class="col-12 mb-3">Products in category of {{ $category->name }}</h2>
        @foreach ($products as $product)
        <div class="product_item col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 p-0">
            <x-product :product="$product" :price="$product->minPrice()" />
        </div>

        @endforeach
        <div id="pagination" class="col-12 d-flex justify-content-center my-5">
            {{ $products->links() }}
        </div>
    </div>


</div>

<script>
    function filter(value) {
        $(this).closest('form').submit();
    }
</script>
@endsection