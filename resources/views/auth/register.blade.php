@extends('layouts.app')

@section('content')

<div class="form-container col-4 mx-auto border rounded-lg p-4" style="margin-top: 100px">
    <h2 class=".font-weight-bolder">Create Account</h2>
    <form method="post" action="{{ route('register') }}">  
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input class="form-control @error('name') border-dander border-danger @enderror"
             type="text" name="name" placeholder="Enter your name" value="{{ old('name') }}">
            @error('name')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        
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

        <div class="form-group">
            <label for="password_confirmation">Repeat Password:</label>
            <input class="form-control @error('password_confirmation') border-dander border-danger @enderror"
             type="password" name="password_confirmation" placeholder="Repeat your password">
             @error('password_confirmation')
                 <span class="error text-danger">{{ $message }}</span>
             @enderror
        </div>
        <button type="submit" class="btn" style="width: 100%">Register</button>
    </form>
</div>

@endsection