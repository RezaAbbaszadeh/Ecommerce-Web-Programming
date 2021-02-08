@extends('layouts.app')

@section('content')

<div class="form-container col-4 mx-auto border rounded-lg p-4" style="margin-top: 100px">


    @if (session('status'))
    <div class="alert alert-warning" role="alert">{{ session('status') }}</div>
    @endif

    <h2 class=".font-weight-bolder">Login to your account</h2>
    <form method="post" action="{{ route('login') }}">  
        @csrf
        
        <div class="form-group">
            <label for="email">Name:</label>
            <input class="form-control @error('name') border-dander border-danger @enderror"
             type="text" name="email" placeholder="Enter your Email address" value="{{ old('email') }}">
            @error('email')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input class="form-control @error('password') border-dander border-danger @enderror"
             type="password" name="password" placeholder="Choose a password">
             @error('password')
                 <span class="error text-danger">{{ $message }}</span>
             @enderror
        </div>
        <div class="form-group row mx-0">
            <label for="captcha" class="col-auto font-italic font-weight-bold bg-dark text-white p-2 rounded mt-2">{{ $captcha }}</label>
            <input class="col ml-3 my-auto form-control @error('captcha') border-dander border-danger @enderror"
             type="text" maxlength="11" name="captcha"
                placeholder="Enter captcha" value="{{ old('captcha') }}" required>
            @error('captcha')
            <span class="col-12 pl-0 error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-check">
            <input type="checkbox" name="remember" checked class="form-check-input">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>
        <button type="submit" class="btn" style="width: 100%">Login</button>
    </form>
</div>

@endsection