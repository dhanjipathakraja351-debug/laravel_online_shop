@extends('front.layouts.app')

@section('content')

<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item">
                    <a class="white-text" href="#">My Account</a>
                </li>
                <li class="breadcrumb-item">Settings</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-11">
    <div class="container mt-5">
        <div class="row">

            <div class="col-md-3">
                {{-- ✅ Sidebar with icons --}}
                @include('front.account.includes.account-panel')
            </div>

            <div class="col-md-9">
                <div class="card">

                    <div class="card-header">
                        <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                    </div>

                    <div class="card-body p-4">

                        {{-- SUCCESS MESSAGE --}}
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- ERROR MESSAGE --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif

                      <form method="POST" action="{{ route('profile.update') }}">
    @csrf

    <div class="row">

        <div class="mb-3">
            <label>First Name</label>
            <input type="text"
                   name="first_name"
                   value="{{ old('first_name', auth()->user()->first_name) }}"
                   class="form-control">
            @error('first_name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Last Name</label>
            <input type="text"
                   name="last_name"
                   value="{{ old('last_name', auth()->user()->last_name) }}"
                   class="form-control">
            @error('last_name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email"
                   name="email"
                   value="{{ old('email', auth()->user()->email) }}"
                   class="form-control">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text"
                   name="phone"
                   value="{{ old('phone', auth()->user()->phone) }}"
                   class="form-control">
            @error('phone')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Address</label>
            <textarea name="address"
                      class="form-control">{{ old('address', auth()->user()->address) }}</textarea>
            @error('address')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Apartment</label>
            <input type="text"
                   name="apartment"
                   value="{{ old('apartment', auth()->user()->apartment) }}"
                   class="form-control">
            @error('apartment')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>City</label>
            <input type="text"
                   name="city"
                   value="{{ old('city', auth()->user()->city) }}"
                   class="form-control">
            @error('city')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>State</label>
            <input type="text"
                   name="state"
                   value="{{ old('state', auth()->user()->state) }}"
                   class="form-control">
            @error('state')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Country</label>
            <select name="country" class="form-control">
                <option value="">Select Country</option>

                @php
                    $countries = [
                        'India','USA','UK','Canada','Australia','Germany','France',
                        'Italy','Spain','Netherlands','Brazil','Mexico','Japan',
                        'China','Russia','South Africa','UAE','Saudi Arabia',
                        'Singapore','Malaysia'
                    ];
                @endphp

                @foreach($countries as $country)
                    <option value="{{ $country }}"
                        {{ old('country', auth()->user()->country) == $country ? 'selected' : '' }}>
                        {{ $country }}
                    </option>
                @endforeach

            </select>
            @error('country')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Zip Code</label>
            <input type="text"
                   name="zipcode"
                   value="{{ old('zipcode', auth()->user()->zipcode) }}"
                   class="form-control">
            @error('zipcode')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="d-flex">
            <button class="btn btn-dark">Update</button>
        </div>

    </div>
</form>  

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection