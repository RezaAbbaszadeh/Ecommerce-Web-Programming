@extends('layouts.app')

@section('content')

<div class="form-container col-11 col-md-8 col-lg-6 col-xl-4 mx-auto border rounded-lg p-4" style="margin-top: 60px">

    <h2 class=".font-weight-bolder">Add to your products:</h2>
    <div class="container text-right">
        <a class="color-primary h5" href="{{ route('seller.add') }}">clear form</a>
    </div>

    <div class="input-group mt-1 p-1 bg-light border rounded">
        <span class="input-group-text border-0 bg-light" id="basic-addon2"><i class="fa fa-search"></i></span>
        <input id="search" type="text" class="form-control border-0 bg-light h-100 no-focus"
            placeholder="Search for existing products" aria-label="Username" aria-describedby="basic-addon1">
        <span class="input-group-text border-0 text-secondary cursor-pointer bg-light" id="basic-addon2"
            onclick="clearSearch()">
            <i class="fa fa-times"></i>
        </span>
    </div>

    <div id="search-res-container" class="shadow pl-5 col-11 bg-white rounded position-absolute" style="z-index:1000;">
        <div class="d-flex justify-content-center mr-5">
            <div id="search-spinner" class="spinner-border m-2 d-none text-danger" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div id="search-res" class="w-100 row" style="max-height: 280px; overflow-y: scroll;">

        </div>
    </div>

    <form method="POST" class="mt-3" action="{{ route('seller.add') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input id="name-input" class="form-control @error('name') border-dander border-danger @enderror" type="text"
                name="name" placeholder="Enter product name" value="{{ old('name') }}">
            @error('name')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>

        <script>
            var cars = {!! json_encode($depth1)!!};
            var models = {!! json_encode($depth2)!!};
            var configurations = {!! json_encode($depth3)!!};
        </script>
        <div class="form-group mb-4">
            <label for="sel1 col">Select list:</label>

            <div class="row">
                <select class="form-control col mx-3" name="cat1" id="cat1" onchange="updateModels()">
                    <option value="" disabled selected>Choose</option>
                </select>
                <i class="fa fa-arrow-right m-auto"></i>

                <select class="form-control col mx-3" name="cat2" id="cat2" onchange="updateConfigurations()">
                    <option value="" selected>All</option>
                </select>
                <i class="fa fa-arrow-right m-auto"></i>

                <select class="form-control col mx-3" name="cat3" id="cat3">
                    <option value="" selected>All</option>
                </select>
                <script src="{{ asset('js/category.js') }}"></script>
            </div>
            @error('category')
            <span class="error text-danger">{{ $message }}</span>
            @enderror

        </div>

        <div class="form-group">
            <label for="details">Details:</label>
            <textarea class="form-control @error('details') border-dander border-danger @enderror" maxlength="700"
                rows="4" id="details" value="{{ old('details') }}" name="details"></textarea>
            @error('details')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="row">
            <div class="form-group col-12 col-md-6">
                <label for="count">How many/much:</label>
                <input class="form-control @error('count') border-dander border-danger @enderror" type="number"
                    name="count" placeholder="Enter number" value="{{ old('count') }}">
                @error('count')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-12 col-md-6">
                <label for="price">Price:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input class="form-control @error('price') border-dander border-danger @enderror" type="number"
                        step="0.01" name="price" placeholder="Enter number" value="{{ old('price') }}">
                </div>
                @error('price')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="custom-file mt-4">
            <input type="file" name="img" class="custom-file-input" id="customFile">
            <label class=" custom-file-label" for="img">Choose image file (image ration must be 1:1)</label>

            @error('img')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <input type="hidden" value="" name="existing-product" id="existing-product">
        <script>
            $(".custom-file-input").on("change", function () {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        </script>

        <button type="submit" class="btn mt-4" style="width: 100%">Save</button>
    </form>
</div>


<script>
    $(document).ready(function () {
        var s = document.getElementById("search");
        s.addEventListener("change", function () {
            var searchDiv = document.getElementById("search-res");
            var spinner = document.getElementById("search-spinner");
            spinner.classList.remove("d-none");
            searchDiv.innerHTML = "";
            jQuery.ajax({
                url: "{{ route('products.search') }}",
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "name": $('#search').val()
                },
                success: function (result) {
                    setTimeout(function () {
                        spinner.classList.add("d-none");
                        var obj = JSON.parse(result);
                        console.log(obj);
                        obj.forEach(p => {
                            var cat1 = -1, cat2 = -1, cat3 = -1;
                            if (p.cat1 !== undefined)
                                cat1 = p.cat1.id;
                            if (p.cat2 !== undefined)
                                cat2 = p.cat2.id;
                            if (p.cat3 !== undefined)
                                cat3 = p.cat3.id;
                            searchDiv.innerHTML += `
                            <div class='p-2 row w-100 cursor-pointer border-bottom'
                             onclick="selectItem('`+ p.name + "'," + p.id + "," + cat1 + "," + cat2 + "," + cat3 + ",`" + p.details + "`" + `)">
                                <div class='col-2' >
                                    <img class='p w-100 h-auto' src='` + p.img_url + `' />
                                </div>
                                <span class='col-10'>` + p.name + `</span>
                            </div>`;

                        });
                    }, 1000);
                },
                error: function (errors) {
                    spinner.classList.add("d-none");
                    console.log(errors);
                }

            });
        });

    });


    function selectItem(name, id, cat1, cat2, cat3, details) {
        carsSelect.value = cat1;
        updateModels();
        if (cat2 != -1)
            modelsSelect.value = cat2;
        updateConfigurations();
        if (cat3 != -1)
            configurationSelect.value = cat3;

        carsSelect.disabled = true;
        modelsSelect.disabled = true;
        configurationSelect.disabled = true;

        clearSearch()

        var nameInput = document.getElementById("name-input");
        nameInput.value = name;
        nameInput.disabled = true;

        var detailsInput = document.getElementById("details");
        detailsInput.value = details;
        detailsInput.disabled = true;

        var fileInput = document.getElementById("customFile");
        fileInput.disabled = true;

        var ex = document.getElementById("existing-product");
        ex.value = id;
    }

    function clearSearch() {
        var searchDiv = document.getElementById("search-res");
        searchDiv.innerHTML = "";

        var nameInput = document.getElementById("search");
        nameInput.value = "";
    }
</script>


@endsection