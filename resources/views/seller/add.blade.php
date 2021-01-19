@extends('layouts.app')

@section('content')

<div class="form-container col-11 col-md-8 col-lg-6 col-xl-4 mx-auto border rounded-lg p-4" style="margin-top: 100px">
    <h2 class=".font-weight-bolder">Add to your products:</h2>

    <div class="input-group mt-3 p-1 bg-light border rounded">
        <span class="input-group-text border-0 bg-light" id="basic-addon2"><i class="fa fa-search"></i></span>
        <input type="text" class="form-control border-0 bg-light h-100 no-focus"
            placeholder="Search for existing products" aria-label="Username" aria-describedby="basic-addon1">
    </div>

    <form method="POST" class="mt-3" action="{{ route('seller.add') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input class="form-control @error('name') border-dander border-danger @enderror" type="text" name="name"
                placeholder="Enter your name" value="{{ old('name') }}">
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
            <label for="count">How many/much of this product for sale:</label>
            <input class="form-control @error('count') border-dander border-danger @enderror" type="number" name="count"
                placeholder="Enter number" value="{{ old('count') }}">
            @error('count')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
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

        <div class="custom-file mt-4">
            <input type="file" name="img" class="custom-file-input" id="customFile"">
            <label class=" custom-file-label" for="img">Choose image file (image ration must be 1:1)</label>

            @error('img')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <script>
            $(".custom-file-input").on("change", function () {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        </script>

        <button type="submit" class="btn mt-4" style="width: 100%">Register</button>
    </form>
</div>

@endsection