@extends('layouts.app')

@section('content')

<div class="form-container col-4 mx-auto border rounded-lg p-4" style="margin-top: 100px">
    <h2 class=".font-weight-bolder">Create Your Shop</h2>
    <form method="post" action="{{ route('register.seller') }}">
        @csrf
        <div class="row">
            <div class="form-group col-12 col-md-6">
                <label for="name">Name:</label>
                <input class="form-control @error('name') border-dander border-danger @enderror"
                 type="text" name="name"
                    placeholder="Enter your shop name" value="{{ old('name') }}">
                @error('name')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-12 col-md-6">
                <label for="owner">Owner:</label>
                <input class="form-control @error('owner') border-dander border-danger @enderror"
                 type="text" name="owner"
                    placeholder="Enter owner name" value="{{ old('owner') }}">
                @error('owner')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input class="form-control @error('name') border-dander border-danger @enderror" type="text" name="email"
                placeholder="Enter your Email address" value="{{ old('email') }}">
            @error('email')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input class="form-control @error('address') border-dander border-danger @enderror" type="text"
                name="address" placeholder="Enter your address" value="{{ old('address') }}">
            @error('address')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone_number">Phone number:</label>
            <input class="form-control @error('phone_number') border-dander border-danger @enderror" type="text"
                maxlength="11" name="phone_number" placeholder="Enter your phone number"
                value="{{ old('phone_number') }}">
            @error('phone_number')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <div class="form-group col-12 col-md-6">
                <label for="password">Password:</label>
                <input class="form-control @error('password') border-dander border-danger @enderror" type="password"
                    name="password" placeholder="Choose a password">
                @error('password')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-12 col-md-6">
                <label for="password_confirmation">Repeat Password:</label>
                <input class="form-control @error('password_confirmation') border-dander border-danger @enderror"
                    type="password" name="password_confirmation" placeholder="Repeat your password">
                @error('password_confirmation')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn" style="width: 100%">Register</button>
    </form>
</div>

@endsection