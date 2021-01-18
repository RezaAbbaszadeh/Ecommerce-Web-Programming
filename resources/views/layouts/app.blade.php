<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>

    <header class="container-fluid bg-white">
        <div class="mt-2 d-flex justify-content-between">
            <div class="row" style="width: 100%;">
                <div class="ml-3" style="width:100px;">
                    <a id="logo" class="my-2">meShop</a>
                </div>
                <div class="col-8 col-sm-7 col-lg-5 col-xl-4 m-2 input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-light" id="basic-addon2"><i class="fa fa-search"></i></span>
                    </div>
                    <input type="text" class="form-control bg-light" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="float-right my-auto" style="white-space: nowrap;">
                @guest  
                    <a href="{{ route('login') }}">Login</a>
                    <span>/ </span>
                    <a style="margin-right: 1.5rem;" href="{{ route('register') }}">Register</a>
                @endguest
                @auth
                    <form action="{{ route('logout') }}" method="POST">

                        <a href="#">{{ auth()->user()->name }}</a>
                        @csrf
                        <button class="btn btn-link" type="submit" style="margin-right: 1.5rem;" >Logout</button>
                    </form>
                @endauth
            </div>
        </div>
        <nav class="navbar navbar-expand-md navbar-light pl-0 pt-2">
            <a class="navbar-brand" href="#" style="width:100px;">Category</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navb">
                <ul class="navbar-nav  mr-auto">
                    @foreach($categories as $category)

                    @if ($category->subcategory->count() > 0)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown" href="#">
                            {{ $category->name }}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ $category->slug }}">All</a>
                            @foreach($category->subcategory as $subcategory)
                            <a class="dropdown-item" href="{{ $subcategory->slug }}">{{ $subcategory->name }}</a>
                            @endforeach
                        </div>
                    </li>

                    @else
                    <li class="nav-item">
                        <a href="{{ $category->slug }}" class="nav-link">{{ $category->name }}</a>
                    </li>
                    @endif
                    @endforeach
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item"><a class="nav-link" href="#"></span>About us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"></span>Q&A</a></li>
                </ul>
            </div>
        </nav>

    </header>

    @yield('content')
</body>

</html>