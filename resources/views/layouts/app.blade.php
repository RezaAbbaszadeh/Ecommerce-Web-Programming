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
        <div class="row mt-2 wrapper justify-content-between">
            <div class="col-3 col-md-3 col-xl-2">
                <a id="logo" class="my-2 h2 pl-2" href="{{ route('home') }}">meShop</a>
            </div>
            <div class="col-9 col-md-6 col-xl-4 input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-light" id="basic-addon2"><i class="fa fa-search"></i></span>
                </div>
                <input type="text" class="form-control bg-light h-100" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="col-3 col-md-3 col-xl-2" style="white-space: nowrap;">
                
            </div>
        </div>
        <nav class="navbar navbar-expand-md navbar-light pl-0 pt-2">
            {{-- <a class="navbar-brand" href="#" style="width:100px;">Category</a> --}}
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
                            <a class="dropdown-item" href="{{ route('category', $category) }}">All</a>
                            @foreach($category->subcategory as $subcategory)
                            <a class="dropdown-item" href="{{ route('category', $subcategory) }}">{{ $subcategory->name }}</a>
                            @endforeach
                        </div>
                    </li>

                    @else
                    <li class="nav-item">
                        <a href="{{ route('category', $category) }}" class="nav-link">{{ $category->name }}</a>
                    </li>
                    @endif
                    @endforeach
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"></span>Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}"></span>Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register.seller') }}"></span>Become a seller</a></li>

                @endguest
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ auth()->user()->name }}</a>
                    
                </li>
                <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">

                    @csrf
                    <button class="btn-link nav-link border-0" type="submit" style="margin-right: 1.5rem;" >Logout</button>
                </form>
                </li>
                @endauth
                </ul>
            </div>
        </nav>

    </header>

    @yield('content')
</body>

</html>