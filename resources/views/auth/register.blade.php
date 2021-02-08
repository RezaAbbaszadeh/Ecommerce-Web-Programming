@extends('layouts.app')

@section('content')

<div class="form-container col-11 col-sm-10 col-md-8 col-lg-6 col-xl-4 mx-auto border rounded-lg p-4" style="margin-top: 70px">
    <h2 class=".font-weight-bolder">Create Account</h2>
    <form method="post" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input class="form-control @error('name') border-dander border-danger @enderror" type="text" name="name"
                placeholder="Enter your name" value="{{ old('name') }}">
            @error('name')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input class="form-control @error('name') border-dander border-danger @enderror" type="text" name="email"
                placeholder="Enter your Email address" value="{{ old('email') }}">
            @error('email')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <div class="form-group col-12 col-md-6">
                <label for="birthday">Birthday:</label>
                <input class="form-control @error('birthday') border-dander border-danger @enderror" type="date"
                    value="{{ old('birthday') }}" id="birthday" name="birthday">
                @error('birthday')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-12 col-md-6">
                <label for="national_id">National ID:</label>
                <input class="form-control @error('national_id') border-dander border-danger @enderror" type="text"
                    name="national_id" maxlength="10" placeholder="Enter your national id" value="{{ old('national_id') }}">
                @error('national_id')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input class="form-control @error('address') border-dander border-danger @enderror"
             type="text" name="address"
                placeholder="Enter your address" value="{{ old('address') }}">
            @error('address')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone_number">Phone number:</label>
            <input class="form-control @error('phone_number') border-dander border-danger @enderror"
             type="text" maxlength="11" name="phone_number"
                placeholder="Enter your phone number" value="{{ old('phone_number') }}">
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
        <div class="form-group row mx-0">
            <label for="captcha" class="col-auto font-italic font-weight-bold bg-dark text-white p-2 rounded mt-2">{{ $captcha }}</label>
            <input class="col ml-3 my-auto form-control @error('captcha') border-dander border-danger @enderror"
             type="text" maxlength="11" name="captcha"
                placeholder="Enter captcha" value="{{ old('captcha') }}" required>
            @error('captcha')
            <span class="col-12 pl-0 error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn" style="width: 100%">Register</button>
    </form>
</div>

@endsection