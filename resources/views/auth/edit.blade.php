@extends('layouts.app')

@section('content')

<div class="form-container col-11 col-sm-10 col-md-8 col-lg-6 col-xl-4 mx-auto border rounded-lg p-4"
    style="margin-top: 100px">
    <h2 class=".font-weight-bolder">Create Account</h2>
    <form method="post" action="{{ route('profile.edit') }}">
        @csrf
        @if(auth()->user()->isSeller)
        <div class="row">
            <div class="form-group col-12 col-md-6">
                <label for="name">Name:</label>
                <input class="form-control @error('name') border-dander border-danger @enderror"
                 type="text" name="name"
                    placeholder="Enter your shop name" value="{{ auth()->user()->name }}">
                @error('name')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-12 col-md-6">
                <label for="owner">Owner:</label>
                <input class="form-control @error('owner') border-dander border-danger @enderror"
                 type="text" name="owner"
                    placeholder="Enter owner name" value="{{ auth()->user()->profile->owner_name }}">
                @error('owner')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        @else
        <div class="form-group">
            <label for="name">Name:</label>
            <input class="form-control @error('name') border-dander border-danger @enderror" type="text" name="name"
                placeholder="Enter your name" value="{{ auth()->user()->name }}">
            @error('name')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        @endif


        <div class="form-group">
            <label for="email">Email:</label>
            <input class="form-control @error('name') border-dander border-danger @enderror" type="text" name="email"
                placeholder="Enter your Email address" disabled="true" value="{{ auth()->user()->email }}">
            @error('email')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>

        @if(auth()->user()->isCustomer)
        <div class="row">
            <div class="form-group col-12 col-md-6">
                <label for="birthday">Birthday:</label>
                <input class="form-control @error('birthday') border-dander border-danger @enderror" type="date"
                    value="{{ auth()->user()->profile->birthday }}" id="birthday" name="birthday">
                @error('birthday')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-12 col-md-6">
                <label for="national_id">National ID:</label>
                <input class="form-control @error('national_id') border-dander border-danger @enderror" type="text"
                    name="national_id" maxlength="10" placeholder="Enter your national id"
                    value="{{ auth()->user()->profile->national_id }}">
                @error('national_id')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        @endif

        <div class="form-group">
            <label for="address">Address:</label>
            <input class="form-control @error('address') border-dander border-danger @enderror" type="text"
                name="address" placeholder="Enter your address" value="{{ auth()->user()->address }}">
            @error('address')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone_number">Phone number:</label>
            <input class="form-control @error('phone_number') border-dander border-danger @enderror" type="text"
                maxlength="11" name="phone_number" placeholder="Enter your phone number"
                value="{{ auth()->user()->phone_number }}">
            @error('phone_number')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn" style="width: 100%">Save changes</button>
    </form>
</div>

@endsection